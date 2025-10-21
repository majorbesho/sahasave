<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;
use Socialite;


class SocialController extends Controller
{
    //





    public function redirect($provider)
    {
     return FacadesSocialite::driver($provider)->redirect();
    }
}


