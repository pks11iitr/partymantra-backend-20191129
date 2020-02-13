<?php

namespace App\Listeners;

use App\Events\OrderSuccessfull;
use App\Models\Notification;
use App\Services\Notification\FirebaseNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPushNotification
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
     * @param  OrderSuccessfull  $event
     * @return void
     */
    public function handle(OrderSuccessfull $event)
    {
        //customer notification
        $title='Order Successfull';
        $body='Your order at TPM is successfull. Booking ID:'.($event->order->refid??'');

        $dids=[$event->order->customer->token??''];
        $msg=[
            'title'=>$title,
            'body'=>$body
        ];

        Notification::create(['title'=>$title,'description'=>$body, 'user_id'=>$event->order->customer->id??'', 'is_sent'=>1]);

        FirebaseNotification::sendNotificationById($dids, $msg);


        //partner notification
        $title='Payment Successfull';
        $body='Payment for Booking ID:'.($event->order->refid??'').' is successfull';

        $dids=[$event->order->details[0]->partner->token??''];
        $msg=[
            'title'=>$title,
            'body'=>$body
        ];

        Notification::create(['title'=>$title,'description'=>$body, 'user_id'=>$event->order->details[0]->partner_id??'', 'is_sent'=>1]);

        FirebaseNotification::sendNotificationById($dids, $msg);
    }
}
