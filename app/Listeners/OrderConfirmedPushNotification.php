<?php

namespace App\Listeners;

use App\Events\OrderConfirmed;
use App\Models\Notification;
use App\Services\Notification\FirebaseNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirmedPushNotification
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
        //customer notification
        $details = $event->order->details;
        if (!empty($details->toArray())) {
            switch ($details[0]->optional_type) {
                case 'dining':
                    $title = 'Table Booking Confirmed';
                    $body = 'Congratulations! Your table booking order with reference id : ' . ($event->order->refid ?? '').' has been confirmed';
                    break;
                case 'party':
                    $title = 'Party Booking Confirmed';
                    $body = 'Congratulations! Your party booking order with reference id : ' . ($event->order->refid ?? '').' has been confirmed';
                    break;
                default:
                    $title = 'Order Confirmed';
                    $body = 'Congratulations! Your order with reference id : ' . ($event->order->refid ?? '').' has been confirmed';
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
