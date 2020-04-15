<?php

namespace App\Listeners;

use App\Events\OrderDeclined;
use App\Services\SMS\Msg91;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderDeclinedSmsAlert
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
     * @param  OrderDeclined  $event
     * @return void
     */
    public function handle(OrderDeclined $event)
    {
        $details = $event->order->details;
        if (!empty($details->toArray())) {
            switch ($details[0]->optional_type) {
                case 'dining':
                    $body = 'We apologize! Your table booking order with reference id : ' . ($event->order->refid ?? '').' has been declined';
                    break;
                case 'party':
                    $body = 'We apologize! Your party booking order with reference id : ' . ($event->order->refid ?? '').' has been declined';
                    break;
                default:
                    $body = 'Congratulations! Your order with reference id : ' . ($event->order->refid ?? '').' has been declined';
            }
        } else {
            return;
        }

        Msg91::send($event->order->mobile??$event->order->customer->mobile, $body);
    }
}
