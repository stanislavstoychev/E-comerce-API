<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InspectionUser extends Model
{
    protected $table = 'inspection_user';
    protected $guarded = [];

    public function inspections() {
        return $this->belongsToMany(User::class, 'inspection_user')->withPivot('remark', 'status', 'date', 'time');
    }
}