<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    /**
     * Mối quan hệ nhiều-nhiều với User.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Mối quan hệ nhiều-nhiều với Permission.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
