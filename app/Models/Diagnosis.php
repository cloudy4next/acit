<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;


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
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
        public function editMessage($crud = false)
    {
        return '<a href="'.route('admin.diagnosis.edit.message', $this->id).'" class="btn btn-sm btn-link"><i class="la la-reply"></i>Reply</a>';
    }

}


