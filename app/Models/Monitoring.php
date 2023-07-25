<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;
    
    protected $table='monitoring';
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
