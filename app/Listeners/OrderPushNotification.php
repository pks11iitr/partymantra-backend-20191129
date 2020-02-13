<?php

namespace App\Listeners;

use App\Events\OrderSuccessfull;
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
        $dids=[$event->order->customer->token];
        $msg=[
            'title'=>'Order Successfull',
            'body'=>'Your order at TPM is successfull. Booking ID:'.$event->refid
        ];
        FirebaseNotification::sendNotificationById($dids, $msg);
    }
}
