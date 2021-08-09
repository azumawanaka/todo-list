<?php

namespace App\Providers;

use Illuminate\Events\TaskReminder;
use App\Listeners\SendReminderNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        TaskReminder::class => [
            SendReminderNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            TaskReminder::class,
            [SendReminderNotification::class, 'handle']
        );

        Event::listen(function (TaskReminder $event) {
            //
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return true;
    }
}
