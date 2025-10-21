<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\ProductResource;
use Carbon\Carbon;
use App\Models\CheckoutData;
use Illuminate\Support\Facades\Validator;
use App\Mail\OrderMail;
use App\Models\order;
use App\Models\networks;
use Illuminate\Support\Str;
use Stripe;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function index()
    {

        return response()->json([
            'status' => "success",
        ], 200);
    }

    public function storeOrder(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($request->all(), [
            'orders' => 'required',
            'total' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'failed', 'message' => $validator->errors()->first()], 422);
        }

        $order = new order();


        $order['user_id'] = auth()->user()->id;
        $order['order_number'] = Str::upper('SB-' . Str::random(8));
        //$order['product_id']= auth()->user->id;
        //  $order['group_products_id']= auth()->user->id;
        //$order['sub_total']=$request->total ;
        $order['total_amount'] = $request->total;
        $order['user_name'] = auth()->user()->name;
        $order['email'] = auth()->user()->email;
        $order['address'] = auth()->user()->address;
        $order['phone'] = $request->phone;
        $order['condition'] = 'pending';
        $order['payment_status'] = 'unpaid';

        //$order['quantity'] = $request->qty;
        $status = $order->save();
        $totalItems = @count((array) $params["orders"]);

        if ($totalItems > 0) {
            foreach ($params["orders"] as $item) {
                $gop_id[] = $item["id"];
                $qty = $item["quantity"];
                //return $qty;
                $order->gproduct()->attach($gproduct, ['qty' => $qty]);
            }


            $payload = [
                'user_id' => auth()->user()->id,
                'order_data' => $params['orders'],
                'total' => $params['total'],
                'order_id' => $order['order_number'],
                'created_at' => date('y-m-d h:i:s')
            ];
            if ($status && $checkoutModel->store($payload)) {


                return response()->json([
                    'status' => "success",
                    'message' => 'Order placed, proceed to payment',
                    'order_id' => $order['order_number'],
                ], 200);
            } else {
                return response()->json(['status' => "failed", "message" => "something went wrong"], 422);
            }
        } else {
            return response()->json(['status' => "failed", "message" => "invalid order"], 422);
        }
    }


    public function pendingPayment(Request $request)
    {
        $order_id = $request->query("order_id");
        if (empty($order_id)) {
            exit;
        }

        $checkoutModel = new CheckoutData();
        $userModel = new User();
        $conditions = [
            ["order_id", $order_id]
        ];
        $result = $checkoutModel->fetch($conditions);
        if (!$result) {
            exit;
        }
        $user = $userModel->find($result->user_id);


        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $paymentIntent = Stripe\PaymentIntent::create([
            'amount' => $result->total * 100,
            'currency' => 'aed',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
            'description' => 'ORDER #: ' . $order_id,
            'metadata' => [
                'name' => $user->name,
                'email' =>  $user->email,
                'reference' => $order_id,
            ],
        ]);


        return view('frontend.inapp.pending', ["order" => $result, 'client_secret' => $paymentIntent->client_secret, "email" => $user->email, "name" => $user->name, 'key' => env('STRIPE_KEY')]);
    }

    public function pay(Request $request)
    {
        $order_id = $request->query("order_id");
        if (empty($order_id)) {
            return Redirect::to('https:/SahaSave.com/inapp/checkout/pending-payment?order_id=' . $order_id);
        }

        $checkoutModel = new CheckoutData();
        $conditions = [
            ["order_id", $order_id]
        ];
        $result = $checkoutModel->fetch($conditions);
        if (!$result) {
            return Redirect::to('https://SahaSave.com/inapp/checkout/pending-payment?order_id=' . $order_id);
        }
        dd($result);
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
                'price' => $result->total * 100,
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' =>  'https://SahaSave.com/inapp/checkout/stripe?success=true',
            'cancel_url' => 'https://SahaSave.com/inapp/checkout/pending-payment?order_id=' . $order_id . '&canceled=true',
        ]);

        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);
    }


    public function shareProduct(Request $request, $slug)
    {

        $ref = $request->query("ref");
        $userModel = new User();
        $user = $userModel->where("referral_code", $ref)->first();
        $referral_code = '';
        if ($user) {
            $referral_code = $user->referral_code;
        }
        //dd($product);
        if (!$product) {
            return Redirect::to('https://SahaSave.com');
        }
        return view('frontend.user.share', compact(['product', 'referral_code']));
    }
}
