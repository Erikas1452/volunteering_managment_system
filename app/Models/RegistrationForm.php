<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationForm extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function answers(){
        return $this->hasMany(RegistrationAnswers::class,'registration_form_id', 'id');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($registrationForm) {
             $registrationForm->answers()->delete();
        });
    }
}
