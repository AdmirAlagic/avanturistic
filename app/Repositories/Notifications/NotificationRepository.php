<?php

namespace App\Repositories\Notifications;

use App\Notification;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Exception;
use Log;
class NotificationRepository
{

    public static function newNotification($userId,  $type, $url,  $fromUserID = null,  $content = null,   $imageUrl = null)
    {
        $notification =  Notification::create([
            'content' => $content,
            'user_id' => $userId,
            'from_user_id' => $fromUserID,
            'type'=> $type,
            'image_url' => $imageUrl,
            'url' => $url,
             
           
        ]);
        
        return $notification;
    }

    public static  function fcmNotification($user, $title = '', $message, $url = null){
        try{
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);
            
            $notificationBuilder = new PayloadNotificationBuilder($title);
            $notificationBuilder->setBody($message)
                                ->setSound('default');
            $dataBuilder = new PayloadDataBuilder();
           /*  
            $dataBuilder->addData(['url' => $url]);
             */
            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();
            
        
            $downstreamResponse = FCM::sendTo($user->fcm_token, $option, $notification, $data);
        } catch (Exception $e){
            Log::error('Failed to send push notification to:'. $user->email);
        }
    }

}
