<?php

namespace App\Providers;

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

        \App\Events\OrderSuccessfull::class=>[
            \App\Listeners\OrderSmsAlert::class,
            \App\Listeners\OrderPushNotification::class,
        ],

        \App\Events\RechargeSuccess::class=>[
            \App\Listeners\RechargePushNotification::class,
        ],

        \App\Events\OrderDeclined::class=>[
            \App\Listeners\OrderDeclinedSmsAlert::class,
            \App\Listeners\OrderDeclinedPushNotification::class,
        ],

        \App\Events\OrderConfirmed::class=>[
            \App\Listeners\OrderConfirmedSmsAlert::class,
            \App\Listeners\OrderConfirmedPushNotification::class,
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
