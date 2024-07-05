<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\TransactionMail;
use App\Mail\ZoomMeetingMail;
use Illuminate\Http\Request;
use App\Models\Cart;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use Stripe\Webhook;
use App\Models\OrderInvoice;
use App\Models\User;
use App\Traits\ZoomMeetingTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class CheckoutController extends Controller
{
    use  ZoomMeetingTrait;
    public $successStatus = 200;
    public $validateStatus = 400;
    public $failedRequest = 501;
    public $notFound = 501;

    public function __construct()
    {
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
                'receipt_email' => $user->email,
                'customer' => $customerId,
                'description' => 'Test payment from your application',
                'shipping' => [
                    'name' => $user->email,
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
        $meetingUrl = $this->create($request);
        $intent = $request->get('payment_intent');
        try {
            // Set your Stripe secret key
            Stripe::setApiKey(config('services.stripe.secret'));
            // Retrieve the payment intent
            $paymentIntent = PaymentIntent::retrieve($intent);
            $email = $paymentIntent->receipt_email;
            $user = User::where('email', $email)->first();
            $transaction = "test";
            // Mail::to($user->email)->send(new TransactionMail($user, $transaction));
            // Mail::to($user->email)->send(new ZoomMeetingMail($user, $transaction));
            // Check the payment status
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
}
