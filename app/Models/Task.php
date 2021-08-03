<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'summary',
        'description',
        'due_date',
        'completed_at',
        'deleted_at',
    ];

    protected $dates = [
        'due_date',
        'updated_at',
    ];

    protected $appends = [
        'due_date_human',
        'due_date_carbon',
        'due_date_time_carbon',
        'updated_at_human',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getDueDateHumanAttribute(): string
    {
        return $this->due_date->diffForHumans();
    }

    public function getUpdatedAtHumanAttribute(): string
    {
        return $this->updated_at->diffForHumans();
    }

    public function getDueDateCarbonAttribute(): string
    {
        return \Carbon\Carbon::parse($this->due_date)->format('M d, Y');
    }

    public function getDueDateTimeCarbonAttribute(): string
    {
        return \Carbon\Carbon::parse($this->due_date)->format('g:i A');
    }
}
