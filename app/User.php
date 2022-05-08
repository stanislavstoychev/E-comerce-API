<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function subcontractor() {
        return $this->belongsTo('App\Subcontractor');
    }
    public function inspector() {
        return $this->belongsTo('App\Inspector');
    }

    public function inspections() {
        return $this->belongsToMany(Inspection::class)->withPivot(['status', 'remark'])->withTimestamps();
    }
    public function activeinspections() {
        return $this->belongsToMany(Inspection::class)
        ->withPivot(['status', 'remark'])
        ->wherePivotIn('status', ['Open', 'On hold'])->withTimestamps();
    }
    public function allinspections() {
        return $this->belongsToMany(Inspection::class)
        ->withPivot(['status', 'remark'])
        ->withTimestamps();
    }
}