<?php


namespace App\Services\Notification;


class FirebaseNotification
{
    public static $API_ACCESS_KEY='AAAAjEBXAKM:APA91bFSVIrZjEtTsPv_Jyk7NHke5MJ-Q6zDqr2C5d6W9QUDEhI7DF4AJ6CGocffkW2ycoBW6qX2Krk4pCijTPYHX3jzE2Md75F56FdIN2UZ-H3AZVpnkJMQ4AEIoLI85WNnmAEgicgp';

    public static $VENDOR_API_ACCESS_KEY='AAAAHorLR_0:APA91bGvzPBDUBea7Q03qmJvuj-XX-XnPJqBLqt4Rgyiuo-tFPP-hkUI0bxpSKPrAOEUlJHaH4tDpUWjIgfdPZ3j4Uzmxe3XdUnVIyTv3esMXNwhhKtDW3MpSKBAbOm28oszf5ccRTQU';

    public static function sendNotificationById($divids=[], $data=[], $type='customer'){

        $fields = array
        (
            'registration_ids' 	=> $divids,
            'data'			=> $data
        );

        if($type=='customer'){
            $headers = array
            (
                'Authorization: key=' . self::$API_ACCESS_KEY,
                'Content-Type: application/json'
            );
        }else{
            $headers = array
            (
                'Authorization: key=' . self::$VENDOR_API_ACCESS_KEY,
                'Content-Type: application/json'
            );
        }


        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );

        //echo $result;
    }

    public static function sendNotificationByChannel($cids=[], $data=[]){

        $fcmMsg = array(
            'title' => 'hdsds',
            'body' => 'mnamss',
            'channelId' => 'Customer',

        );
        $fields = array(
            'to' => '', //tokens sending for notification
            'notification' => $fcmMsg,

        );

        $headers = array
        (
            'Authorization: key=' . self::$API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );

        echo $result;
    }
}
