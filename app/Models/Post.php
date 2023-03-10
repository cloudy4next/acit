<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
