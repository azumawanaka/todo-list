<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TaskReminder extends Command
{
    /**
     * @var string
     */
    protected $signature = 'task:reminder';

    /**
     * @var string
     */
    protected $description = 'Gives a reminder to users tasks';

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // \Log::info('Task reminder works...');

        $this->info('Task reminder works...');
    }
}
