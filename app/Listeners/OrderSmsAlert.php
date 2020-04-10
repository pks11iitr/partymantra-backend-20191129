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

        $details = $event->order->details;
        if (!empty($details->toArray())) {
            switch ($details[0]->optional_type) {
                case 'dining':
                    $title = 'Table Booking: ';
                    $body = 'We have received table booking request. You will get confirmation shortly. Your reference id is: ' . ($event->order->refid ?? '');
                    break;
                case 'party':
                    $title = 'Party Booking';
                    $body = 'We have received party booking request. You will get confirmation shortly. Your reference id is: ' . ($event->order->refid ?? '');
                    break;
                case 'billpay':
                    $title = 'Payment Successfull';
                    $body = 'Your billpayment using TPM is successfull. Booking ID:' . ($event->order->refid ?? '');
                    break;
                default:
                    $title = 'Order Successfull';
                    $body = 'Your order at TPM is successfull. Booking ID:' . ($event->order->refid ?? '');
            }
        } else {
            return;
        }

        //$msg='Your order for Booking ID: '.($event->order->refid??'').' at TPM is successfull. ';
            if(($event->order->total_paid??0)>0)
                $body=$body.'. Total amount paid is Rs.'.($event->order->total_paid??0);
        Msg91::send($event->order->mobile, $body);
    }
}
