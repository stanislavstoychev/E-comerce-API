<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Drawingdet;
use App\Project;

class Drawingtransmittal extends Model
{
    protected $guarded=[];

    
        public function project() {
        return $this->belongsTo(Project::class);
    }

        public function drawingsdet()
    {
        return $this->belongsToMany(Drawingdet::class, 'drawingdet_drawingtrnsmittal')->withTimestamps();
    }

}
