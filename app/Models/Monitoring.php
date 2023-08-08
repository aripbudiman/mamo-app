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

    
    public static function statistikKunjunganAnggota($id){
        $data=[];
       
        $totalKunjungan= self::where('anggota_id', $id)->count();
        $totalBayar= self::where('anggota_id', $id)->sum('nominal');
        $ditemui2=[['ditemui'=>'tidak bisa','count'=>0],['ditemui'=>'bisa','count'=>0]];
        $ditemui =self::select('ditemui', DB::raw('COUNT(ditemui) as count'))
        ->where('anggota_id', $id)
        ->groupBy('ditemui')
        ->get();
        foreach ($ditemui as $item) {
            foreach ($ditemui2 as &$item2) {
                if ($item2['ditemui'] === $item->ditemui) {
                    $item2['count'] = $item->count;
                    break;
                }
            }
        }
        $countBayar=self::where('anggota_id', $id)
        ->where('nominal', '>', 0)
        ->count();
        $countTidakBayar=self::where('anggota_id', $id)
        ->where('nominal', '=', 0)
        ->count();
        $outstanding=DB::select("SELECT outstanding FROM anggota WHERE id_anggota = $id");
        $data['totalKunjungan']=$totalKunjungan;
        $data['totalBayar']=$totalBayar;
        $data['ditemui']=$ditemui2;
        $data['countBayar']=$countBayar;
        $data['countTidakBayar']=$countTidakBayar;
        $data['outstanding']=$outstanding[0]->outstanding;
        return $data;
        
    }

    public function statistikBulanan($bulan = null, $tahun = null){
        $query = DB::table('monitoring')
            ->select(
                DB::raw('YEAR(tanggal) AS tahun'),
                DB::raw('MONTH(tanggal) AS bulan'),
                DB::raw('SUM(nominal) AS total_nominal'),
                DB::raw('COUNT(anggota_id) AS kunjungan'),
                DB::raw('COUNT(CASE WHEN ditemui = "bisa" THEN 1 ELSE NULL END) AS bisa'),
                DB::raw('COUNT(CASE WHEN ditemui = "tidak bisa" THEN 1 ELSE NULL END) AS tidak_bisa'),
                DB::raw('COUNT(CASE WHEN nominal = 0 THEN 1 ELSE NULL END) AS tidak_bayar'),
                DB::raw('COUNT(CASE WHEN nominal > 0 THEN 1 ELSE NULL END) AS bayar')
            )
            ->groupBy(DB::raw('YEAR(tanggal), MONTH(tanggal)'))
            ->orderBy(DB::raw('YEAR(tanggal), MONTH(tanggal)'));
        if ($bulan !== null && $tahun !== null) {
            $query->whereYear('tanggal', $tahun)
                  ->whereMonth('tanggal', $bulan);
        }
        return $query->get();
    }

    public static function getUserIncomeSummary($userId=null,$limit=50)
    {
         $query=self::select('tanggal')
            ->selectRaw('SUM(nominal) AS total_pendapatan')
            ->selectRaw('COUNT(*) AS jumlah_transaksi')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'DESC');
           if($userId!== null){
               $query->where('user_id', $userId);
           } 
            return $query->limit($limit)->get();
            
    }
}
