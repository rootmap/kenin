<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FotterMenu extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='fotter_menus';
}
        