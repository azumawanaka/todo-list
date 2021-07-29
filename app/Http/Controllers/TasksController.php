<?php

namespace App\Http\Controllers;

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
       try {
            $user = Auth::user();
            $tasks = $this->taskService->storeTask($user, $request);

            broadcast(new TaskAdded($user, $tasks))->toOthers();

            return ['status' => 'New task added!'];
       } catch (\Throwable $th) {
            return response()->json([
                'errors' => "Password does't match",
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
       }
    }

    public function taskLists()
    {
        return Task::with('user')->get();
        // return $this->taskService->getTasks();
    }
}
