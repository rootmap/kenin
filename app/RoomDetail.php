<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomDetail extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='room_details';
}
        