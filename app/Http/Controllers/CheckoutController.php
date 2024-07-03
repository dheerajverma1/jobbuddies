<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class CheckoutController extends Controller
{
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
        $user = User::where('email','=',$request->email)->first();  
        $customerId = $this->createStripeCustomer($user);
        $totalAmount  = $request->price;
        //-------   stripe payment gateway ------------//
        Stripe::setApiKey(config('services.stripe.secret'));
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $totalAmount * 100,  // Amount in cents
                'currency' => 'usd',
                'customer' => $customerId,
                'description' => 'Test payment from your application',
                'shipping' => [
                    'name' => $user->name,
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
    public function handleWebhook(Request $request)
    {
        // testing
        // $Qendpoint_secret = 'whsec_gVRpa32OfiDusToT01jTpMUxpfF2oJL0';
        // LIVE
        $endpoint_secret = 'whsec_y20f9hF5fvizU2ZNQy9SkssDNa4R7fQo';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.amount_capturable_updated':
                $paymentIntent = $event->data->object;
                $paymentStatus = $paymentIntent->status;
                $paymentid = $paymentIntent->id;
                Transaction::where('payment_intent_id', $paymentid)->update(['status' => $paymentStatus]);
                break;
            case 'payment_intent.canceled':
                $paymentIntent = $event->data->object;
                $paymentStatus = $paymentIntent->status;
                $paymentid = $paymentIntent->id;
                Transaction::where('payment_intent_id', $paymentid)->update(['status' => $paymentStatus]);
                break;
            case 'payment_intent.partially_funded':
                $paymentIntent = $event->data->object;
                $paymentStatus = $paymentIntent->status;
                $paymentid = $paymentIntent->id;
                Transaction::where('payment_intent_id', $paymentid)->update(['status' => $paymentStatus]);
                break;
            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                $paymentStatus = $paymentIntent->status;
                $paymentid = $paymentIntent->id;
                Transaction::where('payment_intent_id', $paymentid)->update(['status' => $paymentStatus]);
                $transaction = Transaction::where('payment_intent_id', $paymentid)->first();
                $order_id = $transaction->order_id;
                Order::where('id', $order_id)->update(['status' => 'cancelled']);
                break;
            case 'payment_intent.processing':
                $paymentIntent = $event->data->object;
                $paymentStatus = $paymentIntent->status;
                $paymentid = $paymentIntent->id;
                Transaction::where('payment_intent_id', $paymentid)->update(['status' => $paymentStatus]);
                break;
            case 'payment_intent.requires_action':
                $paymentIntent = $event->data->object;
                $paymentStatus = $paymentIntent->status;
                $paymentid = $paymentIntent->id;
                Transaction::where('payment_intent_id', $paymentid)->update(['status' => $paymentStatus]);
                break;
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $paymentStatus = $paymentIntent->status;
                $paymentid = $paymentIntent->id;
                Transaction::where('payment_intent_id', $paymentid)->update(['status' => $paymentStatus]);
                Log::info($paymentid);
                $transaction = Transaction::where('payment_intent_id', $paymentid)->first();
                $order_id = $transaction->order_id;
                Log::info($transaction);
                $order = Order::with('orderItems')->where('id', $order_id)->first();

                $cartIds = $order->orderItems->pluck('cart_id')->toArray();
                Cart::whereIn('id', $cartIds)->delete();

                // $invoice_id = generateUniqueID(new OrderInvoice);
                //  $invoice = OrderInvoice::create([
                //     'order_id'        => $order_id,
                //     'invoice_number'  => $invoice_id,
                //     'total_amount'    => $transaction->total_amount,
                //     'transaction_id'  =>  $paymentid,
                //     'payment_obj'     =>  json_encode($paymentIntent),
                //     'status'          => 'success'
                // ]);

                // $trackingNumber = Str::upper(Str::random(7));
                // OrderTracking::create(['order_id' =>$order_id,'order_tracking_number' => $trackingNumber ]);

                // foreach ($cartItems as $cartItem) {
                //     $cartItem->delete();
                // }
                break;

                // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        http_response_code(200);
    }

}
