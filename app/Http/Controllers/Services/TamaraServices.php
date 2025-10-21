<?php

namespace App\Http\Services;
use GuzzleHttp\Client;
// use http\Client;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TamaraServices
{

    private $base_Url;
    private $headers;
    private $request_client;

    public function __construct(Client $request_client ) {
        $this->request_client = $request_client;
        $this->base_Url = env('tamara_base_url');
        $this->headers = [
            'authorization' => 'Bearer '.env('tamara_token'),
            'Content-Type' => 'application/json',
        ];

    }

}
