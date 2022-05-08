<?php

namespace App;

use App\Drawingdet;
use Illuminate\Database\Eloquent\Model;

class Drawingfile extends Model
{
    protected $guarded=[];
    
         public function drawingdet() {
        return $this->belongsTo(Drawingdet::class);
    }
}
