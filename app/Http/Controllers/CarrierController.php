<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\networks;
use App\Notifications\NewUserRegisterNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class CarrierController extends Controller
{


    public function showLoginForm()
    {
        return view('carrier.login');
    }

    // معالجة تسجيل الدخول
    public function login(Request $request)
    {
        //return $request->all();
        $credentials = $request->only('email', 'password');

        if (Auth::guard('carrier')->attempt($credentials)) {
            return redirect()->route('carrier')->with('Success', 'You Are Login');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // تسجيل الخروج
    public function logout()
    {
        Auth::guard('carrier')->logout();
        return  view('carrier.login');
    }

    public function showRegisterFormcarrier()
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
        return  view('carrier.registerview', compact(['countries']));
    }





    // معالجة عملية التسجيل
    public function registerpostcarrier(Request $request)
    {
        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:carriers',
            'password' => 'required|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:204s8',
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
            $photoPath = $request->file('photo')->store('carrier/photos', 'public');
        }

        Carrier::create([
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

        //return $request->all();
        // إعادة التوجيه إلى صفحة تسجيل الدخول مع رسالة نجاح
        return redirect()->route('carrier.login')->with('success', 'Registration successful! Please login.');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dash()
    {

        return view('carrier.dashboard');
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
     * @param  \App\Models\Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
