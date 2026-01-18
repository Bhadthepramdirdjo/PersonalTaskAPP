<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = [
        'task_id',
        'reminder_time',
        'reminder_type',
        'is_active',
        'is_sent',
    ];

    protected $casts = [
        'reminder_time' => 'datetime',
        'is_active' => 'boolean',
        'is_sent' => 'boolean',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
