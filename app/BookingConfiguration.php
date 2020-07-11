<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingConfiguration extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='booking_configurations';
}
        