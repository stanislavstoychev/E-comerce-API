<?php

namespace App;
use App\Drawing;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $guarded = [];

    public function project() {
        return $this->belongsTo('App\Project');
    }
    public function drawing() {
        return $this->hasOne(Drawing::class);
    }
}
