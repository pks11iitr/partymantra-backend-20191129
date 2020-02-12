<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index(Request $request){
        $user=auth()->user();
        if($user->hasRole('customer')){
            $notifications=Notification::where('is_sent', true)
                ->where(function($query) use ($user){
                    $query->where('user_id', $user->id)
                        ->orWhereIn('receiver_type', ['allcustomer','alluser']);
                })
                ->orderBy('id','desc')
                ->get();
        }else{
            $notifications=Notification::where('is_sent', true)
                ->where(function($query) use ($user){
                    $query->where('user_id', $user->id)
                        ->orWhereIn('receiver_type', ['allvendor','alluser']);
                })
                ->orderBy('id','desc')
                ->get();
        }

        return $notifications;

    }
}
