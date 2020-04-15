<?php

namespace App\Listeners;

use App\Events\OrderDeclined;
use App\Models\Notification;
use App\Services\Notification\FirebaseNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderDeclinedPushNotification
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
        //customer notification
        $details = $event->order->details;
        if (!empty($details->toArray())) {
            switch ($details[0]->optional_type) {
                case 'dining':
                    $title = 'Table Booking Declined';
                    $body = 'We apologize! Your table booking order with reference id : ' . ($event->order->refid ?? '').' has been declined';
                    break;
                case 'party':
                    $title = 'Party Booking declined';
                    $body = 'We apologize! Your party booking order with reference id : ' . ($event->order->refid ?? '').' has been declined';
                    break;
                default:
                    $title = 'Order Declined';
                    $body = 'Congratulations! Your order with reference id : ' . ($event->order->refid ?? '').' has been declined';
            }
        } else {
            return;
        }

        Notification::create(['title' => $title, 'description' => $body, 'user_id' => $event->order->customer->id ?? '', 'is_sent' => 1]);

        $dids = [$event->order->customer->token ?? ''];
        $msg = [
            'title' => $title,
            'body' => $body
        ];
        FirebaseNotification::sendNotificationById($dids, $msg);
    }
}
