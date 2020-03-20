<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';

    protected $appends = array('order_date');

    protected $fillable=['refid','payment_id_response', 'order_id_response','usingwallet','fromwallet','discount_type','instant_discount','total','date','time', 'payment_status'];

    protected $hidden=['user_id', 'payment_text', 'deleted_at', 'created_at', 'payment_id_response', 'order_id_response'];


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
        OrderItem::whereHas('order', function($order)use($user){
            $order->where('payment_status', 'pending')->where('user_id', $user->id);
        })->delete();
        Order::where('payment_status', 'pending')->where('user_id', $user->id)->delete();

        if(isset($data['optional_type']) && $data['optional_type']=='billpay'){

            $instant_discount=Discount::calculateDiscount($request->amount, $request->discount_type);

            if($request->discount_type=='instant'){
                $order=new Order(['refid'=>date('YmdHis'), 'usingwallet'=>($request->usingwallet==1?true:false),'total'=>$request->amount-$instant_discount, 'instant_discount'=>$instant_discount,'discount_type'=>$request->discount_type,'date'=>date('Y-m-d'), 'time'=>date('H:iA')]);
            }else if($request->discount_type=='cashback'){
                $order=new Order(['refid'=>date('YmdHis'), 'usingwallet'=>($request->usingwallet==1?true:false),'total'=>$request->amount, 'instant_discount'=>$instant_discount,'discount_type'=>$request->discount_type,'date'=>date('Y-m-d'), 'time'=>date('H:iA')]);
            }else{
                $order=new Order(['refid'=>date('YmdHis'), 'usingwallet'=>($request->usingwallet==1?true:false),'total'=>$request->amount, 'instant_discount'=>$instant_discount,'discount_type'=>'none', 'date'=>date('Y-m-d'), 'time'=>date('H:iA')]);
            }

            $user->orders()->save($order);
            //var_dump($order->toArray());die('an');
        }

        $items=Order::createItemsArray('billpay', $request);
        $order->details()->saveMany($items);

        return $order;
    }

    //create array of items
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
