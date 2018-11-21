<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Permission extends Model
{
    protected $guarded = [];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
