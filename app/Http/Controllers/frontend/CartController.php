<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;


use Gloudemans\Shoppingcart\Facades\Cart;



use Illuminate\Http\Request;

class CartController extends Controller
{
    //cartproduct
    public function cartpro()
    {
        return view('frontend.cart.cartpro');
    }


    public function cartproStore(Request $request)
    {
        //dd($request->all());
        return $request->all();
        // var product_id = $(this).data('product-id');
        $product_qty = $request->input('product_qty');
        $product_id = $request->input('product_id');
        //return $product_id;
        $product = product::getProductBycart($product_id);
        $price  = $product[0]['price'];
        //return $product;
        //return $price;
        $cart_array = [];

        foreach (Cart::instance('shopping')->content() as $item) {
            $cart_array[] = $item->id;
        }
        //return $cart_array;
        $result = Cart::instance('shopping')->add($product_id, $product[0]['title'], $product_qty, $price)->associate('App\Models\product');
        //return json_encode($result);
        if ($result) {
            $response['status'] = true;
            $response['product_id'] = $product_id;
            $response['totle'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = " Item Added To cart";
        }
        if ($result->ajax()) {
            $header = view('frontend.layouts.header')->render();
            $response['header'] = $header;
        }
        return json_encode($response);
    }



    public function cartproDelete(Request $request)
    {
        //dd($request->all());
        //return $request->all();
        $id = $request->input('cart_id');
        Cart::instance('shopping')->remove($id);
        $response['status'] = true;
        $response['totle'] = Cart::subtotal();
        $response['cart_count'] = Cart::instance('shopping')->count();
        $response['message'] = " Item removed  To cart";

        if ($request->ajax()) {
            $header = view('frontend.layouts.header')->render();
            $response['header'] = $header;
        }
        return json_encode($response);
    }

    public function cart()
    {
        return view('frontend.cart.cart');
    }

    //cartStore
    public function cartStore(Request $request)
    {
        //dd($request->all());
        //return $request->all();
        // var product_id = $(this).data('product-id');
        $product_qty = $request->input('product_qty');
        $product_id = $request->input('product_id');
        $product_type = $request->input('product_type');
        //return $producttypeid;
        $price  = $product[0]['showPrice'];
        //return $product;
        //return $price;
        $cart_array = [];
        //dd($product_type);

        foreach (Cart::instance('shopping')->content() as $item) {
            $cart_array[] = $item->id;
        }
        //return $cart_array;
        //return json_encode($result);
        if ($result) {
            $response['status'] = true;
            $response['product_id'] = $product_id;
            $response['producttypeid'] = $product_type;
            $response['totle'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = " Item Added To cart";
        }
        //dd($result);
        //return json_encode($response);
        if ($request->ajax()) {
            $header = view('frontend.layouts.header')->render();
            $response['header'] = $header;
        }
        return json_encode($response);
    }



    public function couponadd(Request $request)
    {
        // return $request->all();

        $couponcode = $request->input('couponcode');
        $coupon = Coupon::where('code', $request->input('code'))->first();
        // return $coupon;
        if (!$coupon) {
            return back()->with('error', 'incaled code ');
        }
        $totalprice = Cart::instance('shopping')->subtotal();
        if ($coupon) {
            Session::put('coupon', [
                "id" => $coupon->id,
                "code" => $coupon->code,
                "value" => $coupon->discount($totalprice),
            ]);
            return back()->with('success', 'code applyed ');
        }
    }


    public function cartStore2(Request $request)
    {
        //dd($request->all());
        //return $request->all();
        // var product_id = $(this).data('product-id');
        $product_qty = $request->input('product_qty');
        $product_id = $request->input('product_id');
        $product_type = $request->input('product_type');
        return $product_type;
        $price  = $product[0]['showPrice'];
        //return $product;
        //return $price;
        $cart_array = [];
        //dd($product_type);

        foreach (Cart::instance('shopping')->content() as $item) {
            $cart_array[] = $item->id;
        }
        //return $cart_array;
        //return json_encode($result);
        if ($result) {
            $response['status'] = true;
            $response['product_id'] = $product_id;
            $response['producttypeid'] = $product_type;
            $response['totle'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = " Item Added To cart";
        }
        //dd($result);
        //return json_encode($response);
        if ($request->ajax()) {
            $header = view('frontend.layouts.header')->render();
            $response['header'] = $header;
        }
        return json_encode($response);
    }



    public function cartDelete(Request $request)
    {
        $id = $request->input('cart_id');
        $result = Cart::instance('shopping')->remove($id);
        //return $request->all();
        if ($result) {
            $response['status'] = true;
            $response['totle'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = "Item removed  To cart";
        }
        if ($request->ajax()) {
            $header = view('frontend.layouts.header')->render();
            $response['header'] = $header;
        }
        return json_encode($response);
    }

    //cartStorx

    public function cartStorex(Request $request)
    {
        //dd($request->all());
        //return $request->all();
        // var product_id = $(this).data('product-id');
        $product_qty = $request->input('product_qty');
        $product_id = $request->input('product_id');
        $product_type = 1;
        //return $producttypeid;
        $price  = $product[0]['showPrice'];
        //return $product;
        //return $price;
        $cart_array = [];
        //dd($product_type);

        foreach (Cart::instance('shopping')->content() as $item) {
            $cart_array[] = $item->id;
        }
        //return $cart_array;
        //return json_encode($result);
        if ($result) {
            $response['status'] = true;
            $response['product_id'] = $product_id;
            $response['producttypeid'] = 1;
            $response['totle'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = " Item Added To cart";
        }
        //dd($result);
        //return json_encode($response);
        if ($request->ajax()) {
            $header = view('frontend.layouts.header')->render();
            $response['header'] = $header;
        }
        return json_encode($response);
    }

    public function cartDeletex(Request $request)
    {
        $id = $request->input('cart_id');
        $result = Cart::instance('shopping')->remove($id);
        //return $request->all();
        if ($result) {
            $response['status'] = true;
            $response['totle'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = "Item removed  To cart";
        }
        if ($request->ajax()) {
            $header = view('frontend.layouts.header')->render();
            $response['header'] = $header;
        }
        return json_encode($response);
    }
}
