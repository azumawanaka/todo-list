<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;

/**
 * Class UserService.
 */
class UserService
{
    public function getUsers($request): ?LengthAwarePaginator
    {
        return User::select([
                'users.id as uId',
                'users.name',
                'users.updated_at as last_login',
                'users.updated_at as last_update',
            ])
            ->withCount('tasks')
            ->where('users.role', 0)
            ->paginate($request->limit);
    }
}
