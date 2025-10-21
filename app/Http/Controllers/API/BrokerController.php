<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



use App\Models\Broker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class BrokerController extends Controller
{


    public function login(Request $request)
    {
        // التحقق من صحة البيانات
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $credentials = $request->only('email', 'password');

        // محاولة تسجيل الدخول
        if (Auth::guard('broker')->attempt($credentials)) {
            // إنشاء Token للمستخدم (إذا كنت تستخدم Laravel Passport أو Sanctum)
            $user = Auth::guard('broker')->user();
            $token = $user->createToken('BrokerToken')->accessToken;

            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        // في حالة فشل تسجيل الدخول
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    public function registerapi(Request $request)
    {
        // التحقق من صحة البيانات
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:brokers',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:20|unique:brokers',
            'nationality' => 'required|string|max:100',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // إنشاء مستخدم جديد
        $broker = Broker::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => 'required|string|max:20|unique:brokers', // تأكد من استخدام الجدول الصحيح
            'nationality' => $request->nationality,
            'address' => $request->address,
            'status' => 'active', // يمكنك تغيير القيمة الافتراضية
        ]);

        // إنشاء Token للمستخدم
        $token = $broker->createToken('broker-token')->plainTextToken;

        return response()->json([
            'message' => 'broker registered successfully',
            'token' => $token,
            'broker' => $broker,
        ], 201);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
