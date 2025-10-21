<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\ProductResource;
use Carbon\Carbon;
use App\Models\CheckoutData;
use Illuminate\Support\Facades\Validator;
use App\Mail\OrderMail;
use App\Models\order;
use App\Models\networks;
use Illuminate\Support\Str;
use Stripe;
use Illuminate\Support\Facades\Redirect;

class StripeWebhookController extends Controller
{
    public function handleWebhook()
    {


        return response()->json([
            'status' => "success",
        ], 200);
    }
}
