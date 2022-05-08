<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Part;
class Substructure extends Model
{
    protected $guarded = [];

    public function structure() {
        return $this->belongsTo('App\Structure');
    }

    public function part() {
        return $this->belongsTo('App\Part');
    }
}
