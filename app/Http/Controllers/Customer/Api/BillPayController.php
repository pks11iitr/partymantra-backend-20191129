<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Discount;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Wallet;
use App\Services\Payment\RazorPayService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillPayController extends Controller
{
    public function __construct(RazorPayService $pay){
        $this->pay=$pay;
    }

    public function initiateBillPay(Request $request){

        $request->validate([
            'amount'=>'required|integer|min:1',
            'discount_type'=>'required|in:instant,cashback,none',
            'entity_id'=>'required|integer'
        ]);

        $partner=Partner::findOrFail($request->entity_id);
        $user=auth()->user();
        if(!$user){
            return [
                'status'=>'failed',
                'message'=>'logout'
            ];
        }
        $order=Order::deleteAndCreate($user, $request, ['optional_type'=>'billpay']);

        if($order->total==0){
            $fromwallet=0;
            $paymentdone='yes';
            $order->payment_status='paid';
            $order->save();
        }else if($order->total>0){ //paying using wallet
            if($request->usingwallet==1){
                $walletresult=Wallet::payUsingWallet($order);
                $paymentdone=$walletresult['paymentdone'];
                $fromwallet=$walletresult['fromwallet'];
            }else{
                $paymentdone='no';
                $fromwallet=0;
            }
        }

        if($paymentdone=='no'){
            $response=$this->pay->generateorderid([
                "amount"=>$order->total*100-$fromwallet*100,
                "currency"=>"INR",
                "receipt"=>$order->refid,
            ]);
            $responsearr=json_decode($response);
            if(!isset($responsearr->id)){
                return [
                    'status'=>'failed',
                    'message'=>'Payment cannot be initiated'
                ];
            }
            $order->order_id=$responsearr->id;
            $order->order_id_response=$response;
            $order->save();
        }

        return response()->json([
            'message' => 'success',
            'paymentdone'=>$paymentdone,
            'data' => [
                'orderid' => $order->order_id??'',
                'total' => ($order->total-$fromwallet)*100,
                'description' => $partner->name,
                'address' => '',
                'currency'=>'INR',
                'merchantid'=>'',
                'paymentdone'=>$paymentdone
            ],
        ], 200);
    }


    public function verifyBillPay(Request $request){
        $order=Order::where('order_id', $request->razorpay_order_id)->firstOrFail();
        $paymentresult=$this->pay->verifypayment($request->all());
        if($paymentresult){
            $order->payment_id=$request->razorpay_payment_id;
            $order->payment_id_response=$request->razorpay_signature;
            $order->payment_status='paid';

            $order->save();
            if($order->usingwallet==true){
                $balance=Wallet::balance($order->user_id);
                if($balance >=$order->fromwallet){
                    Wallet::updatewallet($order->user_id, 'Amount paid for Order ID:'.$order->refid, 'Debit', $order->fromwallet, $order->id);
                }else{
                    return response()->json([
                        'status'=>'failed',
                        'message'=>'Payment is not successfull',
                        'errors'=>[

                        ],
                    ], 200);
                }

            }
            return response()->json([
                'status'=>'success',
                'message'=>'Payment is successfull',
                'errors'=>[

                ],
            ], 200);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'Payment is not successfull',
                'errors'=>[

                ],
            ], 200);
        }
    }

    public function getPartners(Request $request){
        $partners= Partner::active()->select('name', 'id')->get();
        $discounts=Discount::get();
        return compact('partners','discounts');
    }

}
