<?php

namespace App\Listeners;

use App\Events\FCMCreated;
use App\Repositories\Notifications\NotificationRepository;
use App\User;

class FCMCreatedListener
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
    public function handle(FCMCreated $event)
    {
        $user = $event->user;
        if($user->fcm_token){
            NotificationRepository::fcmNotification($user, '', $event->message);
        }
        
     
    }
}