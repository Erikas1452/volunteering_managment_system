<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use Sortable;

    public $sortable = ['category_name_en'];

    protected $fillable = [
        'category_name_en',
        'category_icon',
    ];
}
