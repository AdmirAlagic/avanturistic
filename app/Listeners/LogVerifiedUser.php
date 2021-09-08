<?php

namespace App\Listeners;

use App\Events\ActivityCreated;
use Illuminate\Auth\Events\Verified;
use Log;

class LogVerifiedUser
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
    public function handle(Verified $event)
    {
       
        Log::info('event ', ['user', $event->user]);

        \Mail::to($event->user->email)->send(new \App\Mail\WelcomeMail($event->user));
    }
}