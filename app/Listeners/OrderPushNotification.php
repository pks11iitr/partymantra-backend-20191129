<?php

namespace App\Listeners;

use App\Events\OrderSuccessfull;
use App\Models\Notification;
use App\Services\Notification\FirebaseNotification;
use App\Services\SMS\Msg91;
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
                        $body = 'Your order at TPM is successfull. Booking ID:' . ($event->order->refid ?? '');
                        break;
                    default:
                        $title = 'Order Successfull';
                        $body = 'Your order at TPM is successfull. Booking ID:' . ($event->order->refid ?? '');
                }
            } else {
                return;
            }

            Notification::create(['title' => $title, 'description' => $body, 'user_id' => $event->order->customer->id ?? '', 'is_sent' => 1]);

        if($event->source=='android') {
            $dids = [$event->order->customer->token ?? ''];
            $msg = [
                'title' => $title,
                'body' => $body
            ];
            FirebaseNotification::sendNotificationById($dids, $msg);
        }else if($event->source=='website'){
            $mobile=$event->order->customer->mobile;
            Msg91::send($mobile, $body);
        }

        //partner notification
        if(!empty($details->toArray())){
            switch($details[0]->optional_type){
                case 'dining':
                    $title='Table Booking Request Received: ';
                    $body='You have received table booking request (Booking id: '.($event->order->refid??'').'). Please confirm or decline as per availablity';
                    break;
                case 'party':
                    $title='Party Booking Request Received: ';
                    $body='You have received party booking request (Booking id: '.($event->order->refid??'').'). Please confirm or decline as per availablity';
                    break;
                case 'billpay':
                    $title='Payment Successfull';
                    $body='Your order at TPM is successfull. Booking ID:'.($event->order->refid??'');
                    break;
                default:
                    $title='Order Successfull';
                    $body='Your order at TPM is successfull. Booking ID:'.($event->order->refid??'');
            }
        }

        $dids=[$event->order->details[0]->partner->user->token??''];
        $msg=[
            'title'=>$title,
            'body'=>$body
        ];

        Notification::create(['title'=>$title,'description'=>$body, 'user_id'=>$event->order->details[0]->partner->user->id??'', 'is_sent'=>1]);

        FirebaseNotification::sendNotificationById($dids, $msg, 'vendor');
    }
}
