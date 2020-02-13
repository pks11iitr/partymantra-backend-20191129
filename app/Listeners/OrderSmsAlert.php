<?php

namespace App\Listeners;

use App\Events\OrderSuccessfull;
use App\Services\Notification\FirebaseNotification;
use App\Services\SMS\Msg91;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderSmsAlert
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
        $msg='Your order for Booking ID: '.$event->order->refid.' at TPM is successfull. ';
            if(($event->order->total_paid??0)>0)
                $msg=$msg.'Total amount paid is '.($event->order->total_paid??0).'Rs.';
        Msg91::send($event->order->mobile, $msg);
    }
}
