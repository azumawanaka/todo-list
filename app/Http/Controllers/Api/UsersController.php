<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\TaskService;

class UsersController extends Controller
{
    /**
     * @var UserService $userService
     * @var TaskService $taskService
     */
    protected $userService;
    protected $taskService;

    public function __construct(UserService $userService, TaskService $taskService)
    {
        $this->userService = $userService;
        $this->taskService = $taskService;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getUsers();
        return response($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function show(int $userId)
    {
        $tasks = $this->taskService->getTaskByUserId($userId);
        return response($tasks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
