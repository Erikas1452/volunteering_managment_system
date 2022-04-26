<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteeringActivities extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }

    public function questions(){
        return $this->hasMany(ExtraQuestions::class,'activity_id', 'id');
    }
}
