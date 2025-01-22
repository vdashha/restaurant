<?php

namespace App\Providers;

use App\Events\ChangeOrderStatus;
use App\Events\OrderCreated;
use App\Listeners\ChangeOrderStatusNotification;
use App\Listeners\OrderCreatedListener;
use App\Listeners\OrderCreatedTelegramNotificationListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderCreated::class => [
            OrderCreatedListener::class,
            OrderCreatedTelegramNotificationListener::class,
        ],
        ChangeOrderStatus::class => [
            ChangeOrderStatusNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
