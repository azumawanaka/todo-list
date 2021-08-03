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
    public function getUsers()
    {
        return User::select([
                'users.id as uId',
                'users.name',
                'users.updated_at as last_login',
                'users.updated_at as last_update',
            ])
            ->withCount('tasks')
            ->where('users.role', 0)
            ->get();
    }
}
