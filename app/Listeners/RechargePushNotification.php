<?php

namespace App\Listeners;

use App\Events\RechargeSuccess;
use App\Models\Notification;
use App\Services\Notification\FirebaseNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RechargePushNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RechargeSuccess  $event
     * @return void
     */
    public function handle(RechargeSuccess $event)
    {
        $title='Order Successfull';
        $body='Your recharge at TPM for Rs.'.($event->wallet->amount??0).' is successful. Recharge ID is:'.$event->wallet->refid;
        $dids=[$event->wallet->customer->token];
        $msg=[
            'title'=>$title,
            'body'=>$body
        ];

        Notification::create(['title'=>$title,'description'=>$body, 'user_id'=>$event->wallet->customer->id, 'is_sent'=>1]);

        FirebaseNotification::sendNotificationById($dids, $msg);
    }
}
