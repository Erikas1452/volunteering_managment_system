<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class VolunteersLog extends Model
{
    use HasFactory, Sortable;
    public $timestamps = false;
    public $sortable = ['full_name', 'email' , 'city'];
    protected $guarded = [];
}
