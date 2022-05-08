<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_comment extends Model
{
    protected $guarded = [];
        
    public function task() {
        return $this->belongsTo('App\Task');
    }
}
