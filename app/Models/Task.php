<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Priority;
use App\Models\User;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category_id',
        'priority_id',
        'deadline',
        'is_completed',
        'completed_at',
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'completed_at' => 'datetime',
        'is_completed' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
