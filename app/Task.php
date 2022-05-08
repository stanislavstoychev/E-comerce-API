<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public function subcontractor() {
        return $this->belongsTo('App\Subcontractor');
    }
    public function project() {
        return $this->belongsTo('App\Project');
    }

    public function structure() {
        return $this->belongsTo('App\Structure');
    }

    public function substructure() {
        return $this->belongsTo('App\Substructure');
    }

    public function part() {
        return $this->belongsTo('App\Part');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function pics() {
        return $this->hasMany('App\Task_pic');
    }
        public function comments() {
        return $this->hasMany('App\Task_comment');
    }
    
}
