<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteeringActivities extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function organization(){
        return $this->belongsTo(Organization::class,'organization_id','id');
    }

    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }

    public function questions(){
        return $this->hasMany(ExtraQuestions::class,'activity_id', 'id');
    }

    public function registrationForms(){
        return $this->hasMany(RegistrationForm::class,'activity_id', 'id')->with('answers');
    }

    public function acceptedForms() {
        return $this->hasMany(RegistrationForm::class,'activity_id', 'id')->with('answers')->where('accepted', '1');
    }

    public function notAcceptedForms() {
        return $this->hasMany(RegistrationForm::class,'activity_id', 'id')->with('answers')->where('accepted', '0');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($activity) {
             $activity->questions()->delete();
             $activity->registrationForms()->delete();
        });
    }
}
