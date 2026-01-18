<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $fillable = [
        'user_id',
        'default_reminder_type',
        'email_notification',
        'email_template',
        'language',
    ];

    protected $casts = [
        'email_notification' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
