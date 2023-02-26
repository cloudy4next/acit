<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;


    protected $hidden = [
        'id',
    ];

    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'description',
        'audio',
        'image',
        'video',
        // 'is_replay',
        // 'replay_by',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function messages()
    {
        return $this->belongsTo('App\Models\Messages');
    }

}


