<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Monitoring extends Model
{
    use HasFactory;
    
    protected $table='monitoring';
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
