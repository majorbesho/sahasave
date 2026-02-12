<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect to Google for authentication
     */
    public function redirectToGoogle($role = 'patient')
    {
        // Check rate limiting
        $key = 'google-redirect:' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 10)) {
            $seconds = RateLimiter::availableIn($key);
            return redirect()->route('login')
                ->with('error', 'لقد تجاوزت الحد المسموح. يرجى المحاولة بعد ' . $seconds . ' ثانية.');
        }

        RateLimiter::hit($key, 60);

        // Store role in session to use after callback
        session(['auth_role' => $role]);

        return Socialite::driver('google')
            ->scopes(['email', 'profile'])
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    /**
     * Redirect for doctor registration
     */
    public function redirectToDoctor()
    {
        return $this->redirectToGoogle('doctor');
    }

    /**
     * Redirect for patient registration
     */
    public function redirectToPatient()
    {
        return $this->redirectToGoogle('patient');
    }

    /**
     * Handle Google callback
     */
    public function handleGoogleCallback(Request $request)
    {
        // Check rate limiting for callback
        $key = 'google-callback:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 15)) {
            $seconds = RateLimiter::availableIn($key);
            return redirect()->route('login')
                ->with('error', 'لقد تجاوزت الحد المسموح من محاولات الاسترجاع. يرجى المحاولة بعد ' . $seconds . ' ثانية.');
        }

        RateLimiter::hit($key, 60);

        try {
            $googleUser = Socialite::driver('google')->user();

            // Get role from session
            $role = session('auth_role', 'patient');

            // Check if user exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // User exists - login
                Auth::login($user);

                // Clear any failed login attempts for this user
                $this->clearFailedAttempts($user->email);

                return $this->redirectBasedOnRole($user, $role, true);
            } else {
                // New user - register
                return $this->registerWithGoogle($googleUser, $role);
            }
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Google Auth Error: ' . $e->getMessage(), [
                'exception' => $e,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            // Increment failed attempts
            $this->incrementFailedAttempt($request);

            return redirect()->route('login')
                ->with('error', 'حدث خطأ أثناء المصادقة باستخدام جوجل. يرجى المحاولة مرة أخرى.');
        }
    }

    /**
     * Register new user with Google data
     */
    protected function registerWithGoogle($googleUser, $role)
    {
        // Check registration rate limiting
        $key = 'google-register:' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            return redirect()->route('register.patient')
                ->with('error', 'لقد تجاوزت الحد المسموح من محاولات التسجيل. يرجى المحاولة بعد ' . $seconds . ' ثانية.');
        }

        RateLimiter::hit($key, 300); // 5 minutes

        // Generate a random password for the user
        $password = Str::random(16);

        // Create user data array
        $userData = [
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => Hash::make($password),
            'role' => $role,
            'provider' => 'google',
            'provider_id' => $googleUser->getId(),
            'email_verified_at' => now(),
            'status' => 'active',
        ];

        // Add optional fields if available
        if ($googleUser->getAvatar()) {
            $userData['photo'] = $googleUser->getAvatar();
        }

        // Create the user
        $user = User::create($userData);

        // Login the user
        Auth::login($user);

        // Generate referral code for new user
        $user->generateReferralCode();

        // Send welcome notification
        event(new \Illuminate\Auth\Events\Registered($user));

        return $this->redirectBasedOnRole($user, $role, false);
    }

    /**
     * Connect Google account to existing user
     */
    public function connectGoogleAccount(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::find($request->user_id);

            // Check if Google account is already connected to another user
            $existingUser = User::where('provider_id', $googleUser->getId())
                ->where('provider', 'google')
                ->first();

            if ($existingUser && $existingUser->id != $user->id) {
                return back()->with('error', 'حساب جوجل هذا مرتبط بحساب آخر بالفعل');
            }

            // Update user with Google info
            $user->update([
                'provider' => 'google',
                'provider_id' => $googleUser->getId(),
                'photo' => $googleUser->getAvatar() ?: $user->photo,
            ]);

            return back()->with('success', 'تم ربط حساب جوجل بنجاح');
        } catch (\Exception $e) {
            \Log::error('Google Connect Error: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء ربط حساب جوجل');
        }
    }

    /**
     * Disconnect Google account
     */
    public function disconnectGoogleAccount(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);

        // Check if user has password set before disconnecting
        if (!$user->password) {
            return back()->with('error', 'يجب تعيين كلمة مرور قبل فصل حساب جوجل');
        }

        $user->update([
            'provider' => null,
            'provider_id' => null,
        ]);

        return back()->with('success', 'تم فصل حساب جوجل بنجاح');
    }

    /**
     * Clear failed login attempts for a user
     */
    protected function clearFailedAttempts($email)
    {
        $key = 'login:' . $email;
        RateLimiter::clear($key);
    }

    /**
     * Increment failed attempt counter
     */
    protected function incrementFailedAttempt(Request $request)
    {
        $key = 'login-failed:' . $request->ip();
        RateLimiter::hit($key, 600); // 10 minutes
    }

    /**
     * Redirect user based on their role
     */
    protected function redirectBasedOnRole($user, $role, $isLogin)
    {
        // Clear the session role
        session()->forget('auth_role');

        $redirectTo = route('home');

        // Custom redirects based on role
        if ($user->isDoctor()) {
            $redirectTo = route('doctor.dashboard');
        } elseif ($user->isAdmin()) {
            $redirectTo = route('admin');
        } elseif ($user->isMedicalCenterAdmin()) {
            $redirectTo = route('medical-center.dashboard');
        } elseif ($user->isPatient()) {
            $redirectTo = route('patient.dashboard');
        }

        // Flash success message
        $message = $isLogin
            ? 'تم تسجيل الدخول بنجاح باستخدام جوجل!'
            : 'تم إنشاء حسابك بنجاح باستخدام جوجل!';

        return redirect()->intended($redirectTo)
            ->with('success', $message);
    }
}
