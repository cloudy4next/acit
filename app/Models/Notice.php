<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $hidden = [
        'id',
    ];

    protected $fillable = [
        'title',
        'description',
        'notice_period',
        'user_id',
    ];

    protected $casts = [
         'notice_period'  => 'datetime:Y-m-d H:i:s'
   ];
    // public function setDatetimeAttribute($value) {
    //     $this->attributes['datetime'] = \Carbon\Carbon::parse($value);
    // }

}
