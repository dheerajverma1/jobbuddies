<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\TransactionMail;
use Illuminate\Http\Request;
use App\Models\Cart;
use Firebase\JWT\JWT;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use Stripe\Webhook;
use App\Models\OrderInvoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use GuzzleHttp\Client;


class CheckoutController extends Controller
{
    public $client;
    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;
    public $successStatus = 200;
    public $validateStatus = 400;
    public $failedRequest = 501;
    public $notFound = 501;
    public $jwt;

    public function __construct()
    {
        $this->client = new Client();
        $this->jwt = $this->generateZoomToken();
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function checkout(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $customerId = $this->createStripeCustomer($user);
        $totalAmount  = $request->price;
        //-------   stripe payment gateway ------------//
        Stripe::setApiKey(config('services.stripe.secret'));
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $totalAmount * 100,  // Amount in cents
                'currency' => 'usd',
                'receipt_email' => $user ? $user->email : $request->email,
                'customer' => $customerId,
                'description' => 'Test payment from your application',
                'shipping' => [
                    'name' => $user ? $user->email : $request->email,
                    'address' => [
                        'line1' => "testing address",
                        'line2' => "testing address",
                        'postal_code' => "826001",
                        'city' => "dhanbad",
                        'state' => "jharkhand",
                        'country' => "india",
                    ],
                ],
            ]);
            $data['paymentIntent'] = $paymentIntent;
            session()->put($paymentIntent->id,['userInfo' => $user ?? [] ,'requestInfo' => $request->all()]);
            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);
            // return response()->json(['http_code' => 200, 'status' => 'success', 'message' => 'Order Created.', 'data' => $data], $this->successStatus);
        } catch (\Exception $e) {
            return response()->json(['http_code' => $this->validateStatus, 'status' => 'error', 'message' => $e->getMessage(), 'data' => null], $this->successStatus);
        }
    }

    public function createStripeCustomer($user)
    {
        if ($user && $user->stripe_customer_id) {
            $customerId = $user->stripe_customer_id;
        } else {
            $customer = \Stripe\Customer::create([
                'email' => $user->email,
                'name' => $user->name,
            ]);
            $customerId = $customer->id;
            if ($user) {
                $user->stripe_id = $customerId;
                $user->save();
            }
        }
        return $customerId;
    }

    public function paymentTransaction(Request $request)
    {
        $intent = $request->get('payment_intent');

        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $paymentIntent = PaymentIntent::retrieve($intent);
            $sessionInfo = session()->get($paymentIntent->id);
            if(isset($sessionInfo['requestInfo']['meetingDates']) && !empty($sessionInfo['requestInfo']['meetingDates'])){
                foreach($sessionInfo['requestInfo']['meetingDates'] as $meetingDate){
                    if(empty($meetingDate['starttime']) || empty($meetingDate['endtime'])){
                        continue;
                    }
                    $ts1 = strtotime(str_replace('/', '-', $meetingDate['date'].' '.$meetingDate['starttime']));
                    $ts2 = strtotime(str_replace('/', '-', $meetingDate['date'].' '.$meetingDate['endtime']));
                    $diff = abs($ts1 - $ts2) / 3600; 
                    $dateTime = $meetingDate['date'].' '.$meetingDate['starttime'].':00';
                    $data['topic'] = "Mock Interview";
                    $data['start_time'] = date('Y-m-d\TH:i:s\Z', strtotime($meetingDate['date'].' '.$meetingDate['starttime'].':00'));
                    $data['duration'] = $diff;
                    $response = $this->create($data,true);
                    dd($response);
                }
            }
            dd('okkkk');
            $email = $paymentIntent->receipt_email;
            $user = User::where('email', $email)->first();
            $transaction = "test";
            Mail::to($user->email)->send(new TransactionMail($user, $transaction));
            if ($paymentIntent->status === 'succeeded') {
                return redirect()->route('success-transaction');
            } else {
                return redirect()->route('failed-transaction');
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function successTransaction(){
        return view('superadmin.transaction.success');
    }

    public function failedTransaction(){
        return view('superadmin.transaction.failed');
    }

    private function retrieveZoomUrl()
    {
        return env('ZOOM_API_URL', '');
    }

    public function create($data,$flag = false)
    {
        $path = 'users/me/meetings';
        $url = $this->retrieveZoomUrl();
        $body = [
            'headers' => [
                'Authorization' => 'Bearer ' .$this->jwt,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ],
            'body' => json_encode([
                'topic' => $data['topic'],
                'type' => self::MEETING_TYPE_SCHEDULE,
                'start_time' => $data['start_time'],
                'duration' => $data['duration'],
                'agenda' => (!empty($data['agenda'])) ? $data['agenda'] : null,
                'timezone' => 'Asia/Kolkata',
                'settings' => [
                    'host_video' =>  true,
                    'participant_video' => true,    
                    'waiting_room' => true,
                ],
            ]),
        ];
        $response = $this->client->post($url . $path, $body);

        return [
            'success' => $response->getStatusCode() === 201,
            'data' => json_decode($response->getBody(), true),
        ];
    }

    public function generateZoomToken()
    {
        $key = env('ZOOM_API_KEY', '');
        $secret = env('ZOOM_API_SECRET', '');
    
        // Check if key and secret are provided
        if (empty($key) || empty($secret)) {
            Log::error('Zoom API key or secret is not set.');
            return null; // Or throw an exception or handle the error appropriately
        }
    
        // Set expiration time to 1 hour from now
        $expirationTime = time() + 3600;
    
        $payload = [
            'iss' => $key,
            'exp' => $expirationTime,
        ];
    
        try {
            return JWT::encode($payload, $secret, 'HS256');
        } catch (\Exception $e) {
            Log::error('Error encoding JWT: ' . $e->getMessage());
            return null; // Or throw an exception or handle the error appropriately
        }
    }
}
