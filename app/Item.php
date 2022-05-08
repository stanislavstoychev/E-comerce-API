<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Part;
use App\Subcontractor;

class Item extends Model
{
    protected $guarded = [];

    public function part() {
        return $this->belongsTo(Part::class);
    }
    public function subcontractor() {
        return $this->belongsTo(Subcontractor::class);
    }
}