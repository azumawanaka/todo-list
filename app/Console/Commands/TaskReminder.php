<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TaskService;
use App\Models\Task;
use Carbon\Carbon;

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
            foreach ($tasks as $task) {
                $remind = 1;
                $now = Carbon::now()->toDateTimeString();
                $dueDate = Carbon::parse($task->due_date)->addMinutes(5)->toDateTimeString();

                if ($dueDate >= $now && $now <= $dueDate) {
                    $isUpdated = $this->taskService->updateTaskReminder($task, $remind);
                    \Log::info(['task' => $task, 'isUpdate' => $isUpdated] );
                }
            }
        }
    }
}
