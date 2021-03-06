<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ActivityLog extends Model
{
    use HasFactory, Sortable;
    public $sortable = ['name', 'created_at', 'hours'];
    protected $guarded = [];

    public function volunteers(){
        return $this->hasMany(VolunteersLog::class,'activity_log_id', 'id');
    }

}
