<?php

namespace App\Providers;

use App\Events\FormationValidated;
use App\Events\UserCreated;
use App\Events\OrderCreated;
use App\Listeners\FormationValidatedListener;
use App\Listeners\OrderSaveListener;
use App\Listeners\UserSavedListener;
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
        UserCreated::class => [
            UserSavedListener::class
        ],
        OrderCreated::class => [
            OrderSaveListener::class
        ],
        FormationValidated::class => [
            FormationValidatedListener::class
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
