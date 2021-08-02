<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\User;

/**
 * Class UserService.
 */
class UserService
{
    public function getUsers(int $limit = 10)
    {
        return User::leftJoin('tasks', 'tasks.user_id', 'users.id')
        ->select([
            DB::raw("count(tasks.user_id) as total_tasks"),
            'users.name as uname',
            'users.updated_at as last_login',
            'tasks.updated_at as last_update'
        ])
        ->where('users.role', 0)
        ->groupBy('users.id')
        ->get();
    }
}
