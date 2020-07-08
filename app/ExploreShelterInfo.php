<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExploreShelterInfo extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='explore_shelter_infos';
}
        