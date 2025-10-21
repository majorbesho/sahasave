<?php

namespace App\Http\Controllers\shipper;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Shipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use \Cache;


class ShipperController extends Controller
{


    public function showLoginForm()
    {
        return view('shipper.login');
    }

    // معالجة تسجيل الدخول
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('shipper')->attempt($credentials)) {
            return redirect()->route('shipper')->with('Success', 'You Are Login');

            // return redirect()->intended('/shipper/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // تسجيل الخروج
    public function logout()
    {
        Auth::guard('shipper')->logout();
        return view('shipper.login');
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

        return $countries;
        return view('shipper.register', compact('countries'));
    }


    // معالجة عملية التسجيل
    public function registerpostshipper(Request $request)
    {
        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:shippers',
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

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // تحميل الصورة إذا تم رفعها
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('shippers/photos', 'public');
        }

        // إنشاء Broker جديد
        Shipper::create([
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
        return redirect()->route('shipper.login')->with('success', 'Registration successful! Please login.');
    }

    public function dash()
    {
        $auth = auth('shipper')->user();
        return view('shipper.dashboard', compact('auth'));
    }

    public function profile()
    {
        $auth = auth('shipper')->user();

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
            return view('shipper.personalInformation', compact('auth'));
        } else {
            return redirect()->route('home')->with('Login first Please and Acive your account   ');
        }

        // return view('shipper.personalInformation', compact('auth'));
    }


    public function shipment_schedule()
    {
        $auth = auth('shipper')->user();
        return view('shipper.shipmentschedule', compact('auth'));
    }


    public function saved_load()
    {
        $auth = auth('shipper')->user();
        return view('shipper.savedload', compact('auth'));
    }




    public function shipment_history()
    {
        $auth = auth('shipper')->user();
        return view('shipper.shipment-history', compact('auth'));
    }





    public function  shipper_payment_account()
    {
        $auth = auth('shipper')->user();
        return view('shipper.shipper-payment-account', compact('auth'));
    }



    public function  chat_1()
    {
        $auth = auth('shipper')->user();
        return view('shipper.chat-1', compact('auth'));
    }




    public function  shipper_setting()
    {
        $auth = auth('shipper')->user();
        return view('shipper.shipper-setting', compact('auth'));
    }



    public function  shipper_change_password()
    {
        $auth = auth('shipper')->user();
        return view('shipper.shipper_change_password', compact('auth'));
    }
}
