<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutTestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $plan = 'price_1QuCmGGh0XImvywkjyfPoRq5')
    {
        //
        if (!Auth::check()) {
            return redirect()->route('login.signup')->with('error', 'please Sing UP to complet your subscription');
        }

        if (Auth::check()) {
            return $request->user()
                ->newSubscription('prod_RnoP0BqPAuMhpV', $plan)
                ->trialDays(1)

                ->checkout([
                    'success_url' => route('success'),
                    'cancel_url' => route('home'),
                    'allow_promotion_codes' => true,
                ]);
        }
    }
}
