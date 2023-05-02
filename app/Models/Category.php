<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;


    protected $fillable = [
        'name',
    ];
    public function tutorials()
    {
        return $this->hasMany('App\Models\Tutorial');
    }
    public function staticpages()
    {
        return $this->hasMany('App\Models\StaticPage');
    }
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function stakeholders()
    {
        return $this->hasMany('App\Models\Stakeholder');
    }

    public function diagnosis()
    {
        return $this->hasMany('App\Models\Diagnosis');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Messages');
    }
}
