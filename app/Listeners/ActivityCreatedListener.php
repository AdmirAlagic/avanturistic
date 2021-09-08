<?php

namespace App\Listeners;

use App\Events\ActivityCreated;
use App\Repositories\Notifications\NotificationRepository;
use App\User;

class ActivityCreatedListener
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
     * @param  \App\Events\MessageSent  $event
     * @return void
     */
    public function handle(ActivityCreated $event)
    {
        $user = User::find($event->to_user_id);
        if($user){
            $fromUser = $event->from_user_name;
            switch($event->type){
                case 'like':
                    $message = ' liked your adventure.';
                break;
                case 'comment':
                    $message = ' commented your adventure.';
                break;
                case 'visited':
                    $message =  ' set "I was here" on your adventure.';
                break;
            }
            $msgTxt = $fromUser .$message;
            if($user && $user->fcm_token){
                NotificationRepository::fcmNotification($user, '', $msgTxt, $event->url);
            }
        }
        
     
    }
}