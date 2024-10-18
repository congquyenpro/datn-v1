<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    protected $fillable = [
        'user_id', 
        'action_type', 
        'ip_address', 
        'user_agent', 
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
