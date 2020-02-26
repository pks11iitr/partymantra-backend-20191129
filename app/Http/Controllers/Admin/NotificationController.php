<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use App\Services\Notification\FirebaseNotification;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{

    public function create(Request $request){
        return view('siteadmin.notifications-form');
    }

    public function send(Request $request){

        $request->validate([
            'receipents'=>'required',
            'title'=>'required',
            'description'=>'required'
        ]);
        if(!in_array($request->receipents,['all','customer', 'partner'])){
            $receipents=explode(',',$request->receipents);
            $users=User::whereIn('id',$receipents)->select('id', 'token')->get();
            $notifications=[];
            foreach($users as $u){
                $notifications[]=['title'=>$request->title,'description'=>$request->description, 'user_id'=>$u->id, 'is_sent'=>1];
            }
            Notification::insert($notifications);
            foreach($users as $u){
                FirebaseNotification::sendNotificationById([$u->token], [
                    'title'=>$request->title,
                    'body'=>$request->body
                ]);
            }

        }else if($request->type=='group'){
            Notification::create(['title'=>$request->title,'description'=>$request->description, 'is_sent'=>1, 'receiver_type'=>$request->type]);
            if($request->receipents == 'customer'){
                //all customers
            }elseif($request->receipents == 'partner'){
                //all partners
            }else{
                //all customers
                FirebaseNotification::sendNotificationByChannel();
                //all partners
                FirebaseNotification::sendNotificationByChannel();
            }
        }


        return redirect()->back()->with('success','Notifications as been send');
    }
}
