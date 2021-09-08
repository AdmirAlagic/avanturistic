<?php

namespace App\Providers;

use App\Events\ActivityCreated;
use App\Events\FCMCreated;
use App\Listeners\ActivityCreatedListener;
use App\Listeners\MessageSentListener;
use App\Listeners\LogVerifiedUser;
use App\Listeners\FCMCreatedListener;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        MessageSent::class =>
        [
            MessageSentListener::class,
        ],
        ActivityCreated::class =>
        [
            ActivityCreatedListener::class,
        ],
        FCMCreated::class =>
        [
            FCMCreatedListener::class,
        ],
        'Illuminate\Auth\Events\Verified' => [
            'App\Listeners\LogVerifiedUser',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
