<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Murabahah extends Model
{
    use HasFactory;

    protected $table='murabahah';
    protected $guarded=[];

    public function dokumentasi(){
        return $this->hasMany(Dokumentasi::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
