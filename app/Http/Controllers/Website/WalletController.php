<?php

namespace App\Http\Controllers\Website;

use App\Events\RechargeSuccess;
use App\Http\Controllers\Website\Traits\WebsiteLoginRedirection;
use App\Models\Wallet;
use App\Services\Payment\RazorPayService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    use WebsiteLoginRedirection;

    public function __construct(RazorPayService $pay){
        $this->pay=$pay;
    }

    public function addMoney(Request $request){

        $redirect=$this->redirectIfRequired(url()->full());
        if($redirect)
            return $redirect;


        $request->validate([
            'amount'=>'required|integer|min:1'
        ]);

        $user=auth()->user();
        if($user){
            //delete all incomplete attempts
            Wallet::where('user_id', $user->id)->where('iscomplete', false)->delete();

            //start new attempt
            $wallet=Wallet::create(['refid'=>date('YmdHis'), 'type'=>'Credit', 'amount'=>$request->amount, 'description'=>'Wallet Recharge','user_id'=>$user->id]);

            $response=$this->pay->generateorderid([
                "amount"=>$wallet->amount*100,
                "currency"=>"INR",
                "receipt"=>$wallet->refid.'',
            ]);
            $responsearr=json_decode($response);
            if(isset($responsearr->id)){
                $api_key=$this->pay->api_key;
                $wallet->order_id=$responsearr->id;
                $wallet->order_id_response=$response;
                $wallet->save();

                    $data=[
                        'id'=>$wallet->id,
                        'orderid'=>$wallet->order_id,
                        'total'=>$wallet->amount*100,
                        'url'=>route('website.wallet.verify'),
                        'description'=>'Wallet Recharge'
                ];
                return view('Website.checkout', compact('data','api_key'));

            }else{
                abort(404);
            }
        }

        abort(404);

    }

    public function verifyRecharge(Request $request){
        $user=auth()->user();
        $wallet=Wallet::where('order_id', $request->razorpay_order_id)->firstOrFail();
        $paymentresult=$this->pay->verifypayment($request->all());
        if($paymentresult){
            $wallet->payment_id=$request->razorpay_payment_id;
            $wallet->payment_id_response=$request->razorpay_signature;
            $wallet->iscomplete=true;
            $wallet->save();
            event(new RechargeSuccess($wallet));
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
}
