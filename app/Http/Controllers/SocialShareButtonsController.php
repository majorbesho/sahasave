<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Jorenvh\Share\ShareFacade;

class SocialShareButtonsController extends Controller
{
    //

    public function ShareWidget()
    {
        $shareComponent = \Share::page(
            'https://SahaSave.com/',
            'Your share text comes here',
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();

        return view('frontend.pages.box', compact('shareComponent'));
    }
}
