<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TaskService;
use App\Events\TaskReminder;
use App\Models\Task;
use Carbon\Carbon;

class RemindTask extends Command
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
     * @var TaskService @taskService
     */
    protected $taskService;

    /**
     * @return void
     */
    public function __construct(TaskService $taskService)
    {
        parent::__construct();

        $this->taskService = $taskService;
    }

    public function handle()
    {
        $tasks = $this->taskService->fetchTaskBeforeDueDate();

        if (!$tasks->isEmpty()) {
            $tasks->each(function (Task $task) {
                event(new TaskReminder($task));

                $remind = 1;
                $this->taskService->updateTaskReminder($task, $remind);
            });
        }
    }
}
