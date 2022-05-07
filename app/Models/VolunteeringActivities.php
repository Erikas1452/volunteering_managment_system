<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class VolunteeringActivities extends Model
{
    use HasFactory, Sortable;

    public $sortable = ['name', 'people_limit' , 'people_registered', 'start_date', 'end_date'];

    public function CategorySortable($query, $direction)
    {
        return $query->join('categories', 'categories.id', '=', 'volunteering_activities.id')
                    ->orderBy('category_name_en', $direction)
                    ->select('volunteering_activities.*');
    }

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
