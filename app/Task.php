<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function members()
    {
        return $this->belongsToMany('App\Member')->withTimestamps();
    }
}
