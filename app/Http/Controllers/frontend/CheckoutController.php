<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Category;

use App\Models\order;
use App\Models\product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class CheckoutController extends Controller
{


    //checkout

    public function checkoutnew()
    {
        $user = Auth::user();
        //return $user;
        $categorys = Category::where(['status' => 'active'])->with('gproducts')->orderBy('id', 'DESC')->get();


        return view('frontend.user.checkoutnew', compact(['user', 'categorys']));
    }

    public function checkout1()
    {
        $user = Auth::user();
        //return $user;
        $categorys = Category::where(['status' => 'active'])->with('gproducts')->orderBy('id', 'DESC')->get();
        if ($user) {
            return view('frontend.user.checkout', compact(['user', 'categorys']));
        } else {
            return view('frontend.user.auth')->with('error', ' Please Register account ');;
        }
    }

    // public function checkout1Store(Request $request){
    //     return $request->all();
    //     $user= Auth::user();

    //      return view('frontend.user.checkout',compact('user'));
    // }
    public function checkout0()
    {
        $user = Auth::user();
        //return $user;
        return view('frontend.user.checkout0', compact('user'));
    }


    public function checkout1Store(Request $request)
    {
        return $request->all();
        $user = Auth::user();

        $categorys = Category::where(['status' => 'active'])->with('gproducts')->orderBy('id', 'DESC')->get();


        return view('frontend.user.checkout', compact(['user', 'categorys']));
    }



    public function checkout0store(Request $request)
    {
        //return $request->all();


        Session::put('checkout0', [

            'username' => $request->username,
            'email' => $request->email,
            'user_id' => $request->user_id,
            'phone' => $request->phone,

            // 'product-id'=>$request->product-id,
            // 'product-price'=>$request->product-price,


            // 'username'=>$request->username,

            // 'username'=>$request->username,


        ]);

        return session()->all();



        return $request->all();


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
        $order['condition'] = 'complete';
        $order['payment_status'] = 'paid';
        $order['payment_method'] = 'visa';
        //  $order['condition']= 'complete';
        //quantity
        $order['quantity'] = $request->qty;;
        // return Session::get('cart')['shopping']['1'][];
        //return Session::get('cart')['shopping']['0']['name'];
        //  $order['total_amount']= auth()->user->id;
        //  $order['coupon']= auth()->user->id;
        //  $order['delivery_charge']=;
        //  $order['quantity']=;
        //  $order['email']=;
        //  $order['phone']=;
        //  $order['startdate']=;
        //  $order['enddate']=;
        //  $order['user_name']=;
        //  $order['note']=;
        //  $order['payment_method']=;
        //  $order['payment_status']=;
        //  $order['condition']=;
        //return $order;

        $status = $order->save();
        foreach (Cart::instance('shopping')->content() as $item) {
            $gop_id[] = $item->id;
            $qty = $item->qty;
            //return $qty;
            $order->gproduct()->attach($gproduct, ['qty' => $qty]);

            //return $order;//
        }

        if ($status) {
            Mail::to($order['email'])
                ->bcc('SehaSave.commarketing@gmail.com')
                //SehaSave.commarketing@gmail.com

                ->cc('beshog32@gmail.com')
                ->send(new OrderMail($order));

            Cart::instance('shopping')->destroy();
            Session::forget('checkout1');
            return redirect()->route('personalInformation')->with('Success');
        }


        return redirect()->route('home')->with('error');
    }




    public function checkoutstore(Request $request)
    {
        //return $request->all();

        if (is_null($request->username)) {

            if (auth()->user()) {
                return redirect()->route('dashboard')->with('error', 'complety your profil ');
            } else {
                return redirect()->route('user.auth')->with('error', 'complety your profil ');
            }
        } else {
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
            $order['condition'] = 'complete';
            $order['payment_status'] = 'paid';
            $order['payment_method'] = 'visa';
            //  $order['condition']= 'complete';
            //quantity
            $order['quantity'] = $request->qty;
            // return Session::get('cart')['shopping']['1'][];
            //return Session::get('cart')['shopping']['0']['name'];
            //  $order['total_amount']= auth()->user->id;
            //  $order['coupon']= auth()->user->id;
            //  $order['delivery_charge']=;
            //  $order['quantity']=;
            //  $order['email']=;
            //  $order['phone']=;
            //  $order['startdate']=;
            //  $order['enddate']=;
            //  $order['user_name']=;
            //  $order['note']=;
            //  $order['payment_method']=;
            //  $order['payment_status']=;
            //  $order['condition']=;
            //return $order;

            $status = $order->save();
            foreach (Cart::instance('shopping')->content() as $item) {
                $gop_id[] = $item->id;
                $qty = $item->qty;
                //return $qty;
                $order->gproduct()->attach($gproduct, ['qty' => $qty]);

                return $order; //
            }

            if ($status) {
                Mail::to($order['email'])
                    ->bcc('operation.SehaSave.com@gmail.com')
                    ->cc('beshog32@gmail.com')
                    ->send(new OrderMail($order));

                Cart::instance('shopping')->destroy();
                Session::forget('checkout1');
                return redirect()->route('dashboard')->with('Success');
            }
        }


        return redirect()->route('home')->with('error');
    }
}
