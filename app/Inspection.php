<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $guarded = [];

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


    public function step() {
        return $this->belongsTo('App\Step');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
    public function users() {
        return $this->belongsToMany('App\User')->withPivot(['status', 'remark'])->withTimestamps();
    }
}