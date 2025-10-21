<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Broker;
use App\Models\Carrier;
use App\Models\Shipper;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleLoginController extends Controller
{
    //
    protected $userTypes = ['broker', 'carrier', 'shipper', 'user'];

    public function redirectToGoogle($userType)
    {
        if (!in_array($userType, $this->userTypes)) {
            abort(404);
        }

        session(['user_type' => $userType]);
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $userType = session('user_type');

            if (!in_array($userType, $this->userTypes)) {
                abort(404);
            }

            $user = $this->findOrCreateUser($googleUser, $userType);

            $this->loginUser($user, $userType);

            return redirect()->intended($this->redirectPath($userType));
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'حدث خطأ أثناء تسجيل الدخول عبر Google');
        }
    }

    protected function findOrCreateUser($googleUser, $userType)
    {
        $model = $this->getModel($userType);

        $user = $model::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $user = $model::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => Hash::make(Str::random(24)),
                'provider' => 'google',
                'provider_id' => $googleUser->getId(),
                'email_verified_at' => now(),
                'photo' => $googleUser->getAvatar(),
            ]);
        } else {
            $user->update([
                'provider' => 'google',
                'provider_id' => $googleUser->getId(),
                'photo' => $googleUser->getAvatar(),
            ]);
        }

        return $user;
    }

    protected function loginUser($user, $userType)
    {
        switch ($userType) {
            case 'broker':
                Auth::guard('broker')->login($user);
                break;
            case 'carrier':
                Auth::guard('carrier')->login($user);
                break;
            case 'shipper':
                Auth::guard('shipper')->login($user);
                break;
            case 'user':
                Auth::guard('web')->login($user);
                break;
        }
    }

    protected function redirectPath($userType)
    {
        switch ($userType) {
            case 'broker':
                return '/broker/dashboard';
            case 'carrier':
                return '/carrier/dashboard';
            case 'shipper':
                return '/shipper/dashboard';
            case 'user':
                return '/user/dashboard';
            default:
                return '/';
        }
    }

    protected function getModel($userType)
    {
        switch ($userType) {
            case 'broker':
                return Broker::class;
            case 'carrier':
                return Carrier::class;
            case 'shipper':
                return Shipper::class;
            case 'user':
                return User::class;
        }
    }
}
