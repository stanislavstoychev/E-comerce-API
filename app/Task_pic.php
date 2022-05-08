<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_pic extends Model
{
    protected $guarded = [];
    
    public function task() {
        return $this->belongsTo('App\Task');
    }
}
