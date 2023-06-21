<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ELearning extends Model
{
    use HasFactory;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;

    protected $fillable = [
        'title',
        'description',
        'e_category',
        'images',
    ];


    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
