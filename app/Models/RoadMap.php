<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadMap extends Model
{
    use HasFactory;

    protected $table='road_maps';
    protected $guarded=[];
}
