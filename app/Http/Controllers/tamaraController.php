<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\Auth;

// use tamarastamara\Configuration;




use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderMail;
use App\Models\order;
use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\Category;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Maree\Tamara\Tamara;

// include('');
// use Tamara\HttpClient\ClientInterface;
// use tamara\config\tamara;
// use tamara\Client;
// use tamara\Model\Order\Order;
// use tamara\Model\Money;
// use tamara\Model\Order\Address;
// use tamara\Model\Order\Consumer;
// use tamara\Model\Order\MerchantUrl;
// use tamara\Model\Order\OrderItemCollection;
// use tamara\Model\Order\OrderItem;
// use tamara\Model\Order\Discount;
// use tamara\Request\Checkout\CreateCheckoutRequest;






class tamaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tamara(Request $request)
    {
        $user = Auth::user();
        $categorys = Category::where(['status' => 'active'])->with('gproducts')->orderBy('id', 'DESC')->get();

        if ($user) {
            foreach (Cart::instance('shopping')->content() as $item) {
                $cart_array[] = $item->id;
            }
            $totale = Cart::subtotal();
            $totale = (float) str_replace(',', '', Cart::subtotal());


            // $value = \Config::get('values.myvalue')

            $apiUrl = \Config::get('value.apiUrl');

            $apiToken = \Config::get('value.apiToken');

            $apiRequestTimeout = \Config::get('value.apiRequestTimeout');

            $transport = \Config::get('value.transport');


            foreach (Cart::instance('shopping')->content() as $item) {
                $cart_array[] = $item->id;
            }
            $totale = Cart::subtotal();
            $totale = (float) str_replace(',', '', Cart::subtotal());
            $user = Auth::user();
            $qty  = $request->qty;


            $order = new order();


            $order['user_id'] = auth()->user()->id;
            $order['order_number'] = Str::upper('SB-' . Str::random(8));
            $order['total_amount'] = $totale;
            $order['user_name'] = auth()->user()->name;
            $order['email'] = auth()->user()->email;
            $order['address'] = auth()->user()->address;
            $order['phone'] =  auth()->user()->phone;
            $order['condition'] = 'complete';
            $order['payment_status'] = 'paid';
            $order['payment_method'] = 'visa';
            $order['product_type'] = '0';
            $order['empid'] = $request->empid;


            $status = $order->save();
            foreach (Cart::instance('shopping')->content() as $item) {
                $gop_id[] = $item->id;
                $qty = $item->qty;
                //return $qty;
                $order->gproduct()->attach($gproduct, ['qty' => $qty]);





                // $order       = ['order_num' => '123', 'total' => 500,'notes' => 'notes ', 'discount_name' => 'discount coupon','discount_amount' => 50,'vat_amount' => 50,'shipping_amount' => 0];
                $products[0] = ['id' => '123', 'type' => 'mobiles', 'name' => 'iphone', 'sku' => 'SA-12436', 'image_url' => 'https://example.com/image.png', 'quantity' => 1, 'unit_price' => 50, 'discount_amount' => 5, 'tax_amount' => 10, 'total' => 70];
                $products[1] = ['id' => '345', 'type' => 'labtops', 'name' => 'macbook air', 'sku' => 'SA-789', 'image_url' => 'https://example.com/image.png', 'quantity' => 1, 'unit_price' => 200, 'discount_amount' => 50, 'tax_amount' => 100, 'total' => 300];
                $consumer    = ['first_name' => 'mohamed', 'last_name' => 'maree', 'phone' => '01234567890', 'email' => 'm7mdmaree26@gmail.com'];
                $billing_address  = ['first_name' => 'mohamed', 'last_name' => 'maree', 'line1' => 'mehalla', 'city' => 'mehalla', 'phone' => '01234567890'];
                $shipping_address = ['first_name' => 'mohamed', 'last_name' => 'maree', 'line1' => 'mehalla', 'city' => 'mehalla', 'phone' => '01234567890'];
                $urls = ['success' => 'http://yoursite/success', 'failure' => 'http://yoursite/failure', 'cancel' => 'http://yoursite/cancel', 'notification' => 'http://yoursite/notification'];
                $response = (new Tamara())->createCheckoutSession($order, $products, $consumer, $billing_address, $shipping_address, $urls);
                return ($response);
                return redirect()->to($response['checkout_url']);






                return view('frontend.stripe', compact('categorys'), ['client_secret' => $paymentIntent->client_secret, "email" => $user->email, "name" => $user->name, 'key' => env('STRIPE_KEY')]);
                // }else{
                //     return redirect()->route('user.auth')->with('info','please login ');
                // }

            }
        }
    }
    // public function index()
    // {
    //     //
    // }

    // public function tamara()
    // {
    //     //
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
