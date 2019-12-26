<?php


namespace App\Services\Payment;
use App\Models\Order;
use GuzzleHttp;

class RazorPayService
{

    public $merchantkey='Dvd9xhIQc0l4L3';
    protected $api_key='rzp_test_zAvfify4pZWTAH';
    protected $api_secret='R47Ub82h0pGfoMiyYZu1BKGc';

    public function __construct(GuzzleHttp\Client $client){
        $this->client=$client;
    }


    public function generateorderid($data){

        try{
            //die('dsd');
            $response = $this->client->post('https://api.razorpay.com/v1/orders', [GuzzleHttp\RequestOptions::JSON =>$data, GuzzleHttp\RequestOptions::AUTH => [$this->api_key,$this->api_secret]]);
            //die('dsd');
            $body=$response->getBody()->getContents();

        }catch(GuzzleHttp\Exception\TransferException $e){
            $body=$e->getResponse()->getBody()->getContents();
        }
        return $body;
    }

    public function verifypayment($data){
        $generated_signature = hmac_sha256($data['razorpay_order_id'] + "|" + $data['razorpay_payment_id'], $this->api_secret);

        if ($generated_signature == $data['razorpay_signature']) {
           return true;
        }
        return false;
    }
}
