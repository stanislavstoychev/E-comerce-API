<?php

namespace App;

use App\Drawing;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded=[];

    public function drawing() {
        return $this->hseOne(Drawing::class);
    }   
}