<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Shipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ShipperAuthController extends Controller
{
    //
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
        if (Auth::guard('shipper')->attempt($credentials)) {
            // إنشاء Token للمستخدم (إذا كنت تستخدم Laravel Passport أو Sanctum)
            $user = Auth::guard('shipper')->user();
            $token = $user->createToken('ShipperToken')->accessToken;

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
        //return $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:shippers',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:20|max:255|unique:shippers',
            'nationality' => 'required|string|max:100',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // إنشاء مستخدم جديد
        $shipper = Shipper::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'nationality' => $request->nationality,
            'address' => $request->address,
            'status' => 'active', // يمكنك تغيير القيمة الافتراضية
        ]);

        // إنشاء Token للمستخدم
        $token = $shipper->createToken('shipper-token')->plainTextToken;

        return response()->json([
            'message' => 'Shipper registered successfully',
            'token' => $token,
            'shipper' => $shipper,
        ], 201);
    }
}
