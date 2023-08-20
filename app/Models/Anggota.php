<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;

    protected $table='anggota';
    protected $guarded=[];

    public static function resetAnggota(){
        self::truncate();
    }

    public static function getMajelisAnggotaStatsByPetugas($petugas){
        $data=[];
        $majelis=self::where('petugas', $petugas)
        ->distinct('majelis')
        ->count('majelis');
        $anggota=self::where('petugas',$petugas)->count('nama_anggota');
        $data['majelis']=$majelis;
        $data['anggota']=$anggota;
        return $data;
    }

    public function user(){
        return $this->belongsTo(User::class,'petugas','sub_name');
    }

    public function monitoring(){
        return $this->hasMany(Monitoring::class,'anggota_id','id_anggota');
    }
}
