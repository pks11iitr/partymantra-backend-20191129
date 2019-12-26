<?php


namespace App\Services\Payment;
use GuzzleHttp;

class RazorPayService
{
    public function order(){
        $client = new GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.razorpay.com/v1/orders');

        echo $response->getStatusCode(); // 200
        echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
        echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
    }
}
