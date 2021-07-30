<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Events\TaskAdded;
use Illuminate\Http\Response;
use App\Http\Requests\TaskFormRequest;
use App\Services\TaskService;
use App\Models\Task;

class TasksController extends Controller
{

    /**
     * @var TaskService $taskService
     */
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->middleware('auth');
        $this->taskService = $taskService;

    }

    public function index(): View
    {
        return view('tasks.index');
    }

    public function store(TaskFormRequest $request)
    {
        $user = Auth::user();
        $task = $this->taskService->storeTask($user, $request);

        broadcast(new TaskAdded($user, $task))->toOthers();

        return ['status' => 'New task added!'];
    }

    public function fetchTasks()
    {
        return Task::with('user')->get();
    }

    public function update(int $taskId)
    {
        $user = Auth::user();
        $task = $this->taskService->updateTask($taskId);

        broadcast(new TaskAdded($user, $task))->toOthers();

        return ['status' => 'Task updated!'];
    }
}
