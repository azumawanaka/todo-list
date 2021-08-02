<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Task;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'last_login',
        'last_update',
        'last_update_time',
    ];

    protected $appends = [
        'last_login_human',
        'last_update_human',
        'last_update_time_human',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function isAdminUser()
    {
        $role = $this->where('role', 1)->first();
        return $role->role != 0;
    }

    public function isRegularUser()
    {
        $role = $this->where('role', 0)->first();
        return $role->role != 1;
    }

    public function getLastLoginHumanAttribute(): string
    {
        return $this->last_login->diffForHumans();
    }

    public function getLastUpdateHumanAttribute(): string
    {
        return \Carbon\Carbon::parse($this->last_update)->format('M d, Y');
    }

    public function getLastUpdateTimeHumanAttribute(): string
    {
        return \Carbon\Carbon::parse($this->last_update)->format('g:i A');
    }
}
