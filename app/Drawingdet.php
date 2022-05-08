<?php

namespace App;

use App\Drawing;
use App\Drawingfile;
use App\Drawingtransmittal;
use Illuminate\Database\Eloquent\Model;

class Drawingdet extends Model
{
     protected $guarded=[];

     public function drawing() {
        return $this->belongsTo(Drawing::class);
    }

         public function drawingfiles() {
        return $this->hasMany(Drawingfile::class);
    }

    public function drawingtransmittals()
    {
        return $this->belongsToMany(Drawingtransmittal::class, 'drawingdet_drawingtrnsmittal')->withTimestamps();
    }

}
