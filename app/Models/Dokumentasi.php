<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;

    protected $table='dokumentasi';
    protected $guarded=[];

    public function murabahah(){
        return $this->belongsTo(Murabahah::class);
    }
}
