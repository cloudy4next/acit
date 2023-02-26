<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
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
        'read_by',
        'read_at',
        'total_messages',
        // 'is_replay',
        // 'replay_by',
    ];
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

        public function editMessage($crud = false)
    {
        return '<a href="'.route('admin.message.edit.message', $this->id).'" class="btn btn-sm btn-link"><i class="la la-edit"></i>Edit</a>';
    }

}
