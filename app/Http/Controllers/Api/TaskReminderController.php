<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Events\TaskReminder;
use App\Services\TaskService;
use App\Models\User;

class TaskReminderController extends Controller
{
    /**
     * @var TaskService $taskService
     */
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $tasks = $this->taskService->getTaskByUserId($user->id);
        TaskReminder::dispatch($tasks);
    }
}
