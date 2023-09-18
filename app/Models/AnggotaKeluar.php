<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaKeluar extends Model
{
    use HasFactory;
    protected $table='anggota_keluar';
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
