<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Storage;

class Wallet extends Model
{
    protected $table='wallet';

    protected $fillable=['refid','type','amount','description','iscomplete', 'order_id', 'order_id_response', 'payment_id', 'payment_id_response','user_id'];

    protected $hidden=['created_at', 'updated_at', 'deleted_at','iscomplete'];

    protected $appends=['icon','date'];

    public static function balance($userid){
        $wallet=Wallet::where('user_id', $userid)->where('iscomplete', true)->select(DB::raw('sum(amount) as total'), 'type')->groupBy('type')->get();
        $balances=[];
        foreach($wallet as $w){
            $balances[$w->type]=$w->total;
        }

        return ($balances['Credit']??0)-($balances['Debit']??0);
    }

    public static function updatewallet($userid, $description, $type, $amount,$orderid=null){
        Wallet::create(['user_id'=>$userid, 'description'=>$description, 'type'=>$type, 'iscomplete'=>1, 'amount'=>$amount, 'order_id'=>$orderid, 'refid'=>date('YmdHis')]);
    }


    // deduct amount from wallet if applicable
    public static function payUsingWallet($order){
        $walletbalance=Wallet::balance($order->user_id);
        $fromwallet=($order->total>=$walletbalance)?$walletbalance:$order->total;
        $order->usingwallet=true;
        $order->fromwallet=$fromwallet;
        if($order->total-$fromwallet>0){
            $paymentdone='no';
        }else{
            Wallet::updatewallet($order->user_id,'Paid for Order ID:'.$order->refid, 'Debit',$fromwallet);
            $order->payment_status='paid';
            $paymentdone='yes';
        }
        $order->save();
        return [
            'paymentdone'=>$paymentdone,
            'fromwallet'=>$fromwallet
        ];
    }

    public function getIconAttribute($value){
        if($this->type=='Debit')
            return asset('images/red.png');
        else
            return asset('images/green.png');

    }

    public function getDateAttribute($value){
        return date('D, d-M-Y H:iA', strtotime($this->updated_at));
    }

    public function customer()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
