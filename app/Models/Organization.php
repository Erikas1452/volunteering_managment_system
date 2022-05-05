<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Organization extends Authenticatable
{
    use Notifiable;

    protected $guard = 'organization';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function ativities(){
        return $this->hasMany(VolunteeringActivities::class,'organization_id', 'id');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($organization) {
             $organization->ativities()->delete();
        });
    }
}
