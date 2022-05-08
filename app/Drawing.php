<?php

namespace App;

use App\Drawingtransmittal;
use App\Drawingdet;
use App\Structure;
use App\Project;
use App\Part;
use Illuminate\Database\Eloquent\Model;

class Drawing extends Model
{
    protected $guarded=[];

    public function drawingtransmittal() {
        return $this->belongsTo(Drawingtrnsmittal::class);
    }
    public function drawingsdet() {
        return $this->hasMany(Drawingdet::class);
    }
    public function project() {
        return $this->belongsTo(Project::class);
    }
    public function structure() {
        return $this->belongsTo(Structure::class);
    }
    public function part() {
        return $this->belongsTo(Part::class);
    }
}
