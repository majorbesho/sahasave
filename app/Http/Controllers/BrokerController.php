<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class BrokerController extends Controller
{


    public function showLoginForm()
    {
        return view('broker.login');
    }

    // معالجة تسجيل الدخول
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::guard('broker')->attempt($credentials)) {
            return redirect()->route('broker')->with('Success', 'You Are Login');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // تسجيل الخروج
    public function logout()
    {
        Auth::guard('broker')->logout();
        return view('broker.login');
    }
    public function showRegisterForm()
    {


        $countries = Country::orderBy('name')->get()
            ->map(function ($country) {
                return [
                    'code' => $country->code,
                    'name' => $country->name,
                    'flag' => $country->flag,
                ];
            });

        //return $countries;
        return view('broker.register', compact(['countries']));
    }


    // معالجة عملية التسجيل
    public function registerpostbroker(Request $request)
    {
        //return $request->all();

        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:brokers',
            'password' => 'required|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'nullable|string|max:20',
            'nationality' => 'nullable|string|max:100',
            'dateOfbarth' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'provider' => 'nullable|string|max:100',
            'referral_code' => 'nullable|string|max:50',
            'onesignal_device_id' => 'nullable|string|max:100',
            'carrier_field' => 'nullable|string|max:100',
        ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // return $validator();


        // تحميل الصورة إذا تم رفعها
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('brokers/photos', 'public');
        }

        // إنشاء Broker جديد
        Broker::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $photoPath,
            'phone' => $request->phone,
            'nationality' => $request->nationality,
            'dateOfbarth' => $request->dateOfbarth,
            'address' => $request->address,
            'provider' => $request->provider,
            'referral_code' => $request->referral_code,
            'onesignal_device_id' => $request->onesignal_device_id,
            'carrier_field' => $request->carrier_field,
        ]);


        // إعادة التوجيه إلى صفحة تسجيل الدخول مع رسالة نجاح
        return redirect()->route('broker.login')->with('success', 'Registration successful! Please login.');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dash()
    {

        return view('broker.dashboard');
    }






    public function profile()
    {
        $auth = auth('broker')->user();

        if ($auth) {
            // $userbil = DB::table('orders')
            //     ->join('users', 'orders.user_id', '=', 'users.id')
            //     ->join('gop_orders', 'orders.id', '=', 'gop_orders.order_id')
            //     ->join('group_products', 'group_products.id', '=', 'gop_orders.gop_id')

            //     ->where('orders.user_id', '=', auth()->user()->id)->get();
            // //return $userbil;
            // $userbilx = DB::table('orders')
            //     ->join('users', 'orders.user_id', '=', 'users.id')
            //     ->join('gop_orders', 'orders.id', '=', 'gop_orders.order_id')
            //     ->join('group_products', 'group_products.id', '=', 'gop_orders.gop_id')

            //     ->where('orders.user_id', '=', auth()->user()->id)
            //     ->select(

            // 'orders.created_at as orderDatelast',

            // 'orders.order_number',
            // 'orders.gop_id',
            // 'orders.user_name',
            // 'users.address',
            // 'orders.note',
            // 'orders.payment_method',
            // 'orders.payment_status',
            // 'orders.condition',
            // 'orders.empid',
            // 'orders.total_amount',
            // 'orders.coupon',
            // 'orders.delivery_charge',
            // 'orders.quantity',
            // 'orders.email',
            // 'orders.phone',
            // 'orders.startdate',
            // 'orders.enddate',
            // 'orders.sessoin_id',

            // 'orders.product_type',
            // 'orders.updated_at',
            // 'users.name',
            // 'users.email_verified_at',
            // 'users.photo',
            // 'users.phoneOtp_verified_at',
            // 'users.nationality',
            // 'users.dateOfbarth',
            // 'users.password',
            // 'users.provider',
            // 'users.provider_id',
            // 'users.referral_code',
            // 'users.ref_by',
            // 'users.no_of_refs',
            // 'users.ref_level_id',
            // 'users.phone_verfiy',
            // 'users.is_verified',
            // 'users.status',
            // 'users.onesignal_device_id',
            // 'users.remember_token',
            // 'emp_code',
            // '_lft',
            // '_rgt',
            // 'parent_id',
            // 'order_id',
            // 'qty',
            // 'title',
            // 'slug',
            // 'discreption',
            // 'Caturl',
            // 'sdate',
            // 'edate',
            // 'stock',
            // 'price',
            // 'showPrice',
            // 'periodID',
            // 'showx',
            // // 'supplier',
            // // 'sandboxPriceID',
            // 'conditaion',
            // // 'offer_price',
            // 'discount',

            // 'type',
            // 'chk',
            // 'dose',
            // 'Directions',
            // 'Ingredients',
            // )
            // ->get();
            //return $userbilx;


            //$result = json_decode($userbilx, true);
            //    $empidcheck= DB::table('emps')
            //    ->get();

            //return $empidcheck;
            return view('broker.personalInformation', compact('auth'));
        } else {
            return redirect()->route('home')->with('Login first Please and Acive your account   ');
        }

        // return view('broker.personalInformation', compact('auth'));
    }


    public function shipment_schedule()
    {
        $auth = auth('broker')->user();
        return view('broker.shipmentschedule', compact('auth'));
    }


    public function saved_load()
    {
        $auth = auth('broker')->user();
        return view('broker.savedload', compact('auth'));
    }




    public function shipment_history()
    {
        $auth = auth('broker')->user();
        return view('broker.shipment-history', compact('auth'));
    }





    public function  broker_payment_account()
    {
        $auth = auth('broker')->user();
        return view('broker.broker-payment-account', compact('auth'));
    }



    public function  chat_1()
    {
        $auth = auth('broker')->user();
        return view('broker.chat-1', compact('auth'));
    }




    public function  broker_setting()
    {
        $auth = auth('broker')->user();
        return view('broker.broker-setting', compact('auth'));
    }



    public function  broker_change_password()
    {
        $auth = auth('broker')->user();
        return view('broker.broker_change_password', compact('auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Broker  $broker
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Broker  $broker
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Broker  $broker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Broker  $broker
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
