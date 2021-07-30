<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'summary',
        'description',
        'due_date',
        'status',
        'completed_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}