<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantAiController extends Controller
{
    /**
     * Display the Restaurant AI homepage
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('restaurant-ai.index');
    }

    /**
     * Display the pricing page
     *
     * @return \Illuminate\View\View
     */
    public function pricing()
    {
        $plans = [
            [
                'name' => 'basic',
                'price_monthly' => 299,
                'price_yearly' => 2990,
                'features' => [
                    'chat_support',
                    'basic_analytics',
                    'single_location',
                    'email_support',
                ]
            ],
            [
                'name' => 'pro',
                'price_monthly' => 599,
                'price_yearly' => 5990,
                'features' => [
                    'whatsapp_integration',
                    'voice_calls',
                    'advanced_analytics',
                    'multi_location',
                    'priority_support',
                    'custom_branding',
                ]
            ],
            [
                'name' => 'enterprise',
                'price_monthly' => null,
                'price_yearly' => null,
                'features' => [
                    'unlimited_locations',
                    'custom_integrations',
                    'dedicated_account_manager',
                    'white_label',
                    'api_access',
                    'sla_guarantee',
                ]
            ]
        ];

        return view('restaurant-ai.pricing', compact('plans'));
    }

    /**
     * Display the features page
     *
     * @return \Illuminate\View\View
     */
    public function features()
    {
        return view('restaurant-ai.features');
    }

    /**
     * Handle demo request submission
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function demoRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'restaurant_name' => 'required|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // TODO: Store demo request in database or send email notification
        // For now, just return success

        return response()->json([
            'success' => true,
            'message' => __('restaurant-ai.demo_request_success')
        ]);
    }
}
