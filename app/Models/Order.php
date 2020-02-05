<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';

    protected $appends = array('order_date');

    protected $fillable=['refid'];

    protected $hidden=['user_id', 'payment_text', 'deleted_at', 'created_at', 'payment_id_response', 'order_id_response','usingwallet','fromwallet'];


    public function details(){
        return $this->hasMany('App\Models\OrderItem', 'order_id');
    }

    public function customer(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function review(){
        return $this->hasOne('App\Models\Review', 'order_id');
    }

    public function getOrderDateAttribute()
    {
        return date('D M d,Y H:i a', strtotime($this->updated_at));
    }

    //delete pending order of given type and create new
    public static function deleteAndCreate($user, $request, $data=[]){
        $orders=Order::where('user_id',$user->id)->where('payment_status', 'pending');
        if(isset($data['optional_type'])){
            $orders=$orders->where('optional_type', $data['optional_type']);
        }
        $orders->details()->delete();
        $orders->delete();

        if(isset($data['optional_type']) && $data['optional_type']=='billpay'){
            $order=new Order(['refid'=>date('YmdHis'), 'usingwallet'=>($request->usingwallet=1?true:false),'total'=>$request->amount]);
            $user->orders()->save($order);
            $items=Order::createItemsArray('billpay', $request);
            $order->details()->saveMany($items);
        }

        return $order;
    }

    public static function createItemsArray($type, $request){
        if($type=='billpay'){
            $items[]=new OrderItem([
                'entity_id'=>$request->entity_id,
                'entity_type'=>'App\Models\Partner',
                'optional_type'=>'billpay',
                'partner_id'=>$request->entity_id,
                'no_of_pass'=>0,
                'price'=>$request->amount,
            ]);
        }
        return $items;
    }

}
