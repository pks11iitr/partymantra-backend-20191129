<?php

namespace App\Listeners;

use App\Events\OrderConfirmed;
use App\Services\SMS\Msg91;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirmedSmsAlert
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
     * @param  OrderConfirmed  $event
     * @return void
     */
    public function handle(OrderConfirmed $event)
    {
        $details = $event->order->details;
        if (!empty($details->toArray())) {
            switch ($details[0]->optional_type) {
                case 'dining':
                    $body = 'Congratulations! Your table booking order with reference id : ' . ($event->order->refid ?? '').' has been confirmed';
                    break;
                case 'party':
                    $body = 'Congratulations! Your party booking order with reference id : ' . ($event->order->refid ?? '').' has been confirmed';
                    break;
                default:
                    $body = 'Congratulations! Your order with reference id : ' . ($event->order->refid ?? '').' has been confirmed';
            }
        } else {
            return;
        }
        
        Msg91::send($event->order->mobile??$event->order->customer->mobile, $body);
    }
}
