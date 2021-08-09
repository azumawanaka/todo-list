<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\TaskReminder;
use Illuminate\Queue\InteractsWithQueue;

class SendReminderNotification implements ShouldQueue
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
     * @param  TaskReminder  $event
     * @return void
     */
    public function handle(TaskReminder $event)
    {
        //
    }
}
