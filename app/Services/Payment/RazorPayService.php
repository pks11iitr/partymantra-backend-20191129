<?php


namespace App\Services\Payment;
use GuzzleHttp;

class RazorPayService
{

    protected $merchantkey='Dvd9xhIQc0l4L3';

    public function __construct(GuzzleHttp\Client $client){
        $this->client=$client;
    }


    public function generateorderid($data){

        try{
            //die('dsd');
            $response = $this->client->post('https://api.razorpay.com/v1/orders', [GuzzleHttp\RequestOptions::JSON =>$data, GuzzleHttp\RequestOptions::AUTH => [$this->merchantkey,'']]);
            //die('dsd');
            $body=$response->getBody();

        }catch(GuzzleHttp\Exception\TransferException $e){
            $body=$e->getResponse()->getBody()->getContents();
        }
        return $body;
    }

    public function verifypayment($data){
        return true;
    }
}
