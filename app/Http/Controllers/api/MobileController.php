<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Anggota;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class MobileController extends Controller
{
    // public function getListTanggal(Request $request){
    //     $tahun = $request->tahun;
    //     $bulan = $request->bulan;

    //     $monitoringData = DB::table('monitoring')
    //         ->whereYear('tanggal', $tahun)
    //         ->whereMonth('tanggal', $bulan)
    //         ->groupBy('tanggal')
    //         ->orderBy('tanggal','DESC')
    //         ->get(['tanggal']);

    //     $results='';
    //     foreach ($monitoringData as $item) {
    //         $results.='<div class="btn-tgl px-2 w-8 flex justify-center mx-2 rounded-lg text-center py-2 text-xs bg-hijau-10">
    //         <a onclick="getMonitoringHarian(`'.date('Y-m-d',strtotime($item->tanggal)).'`)">
    //             <button type="button">
    //                 <p class="text-slate-700">'. date('D',strtotime($item->tanggal)).'</p>
    //                 <p class="text-slate-900 font-bold font-poppins">'. date('d',strtotime($item->tanggal)) .'</p>
    //             </button>
    //         </a>
    //     </div>';
    //     }
    //     return response()->json($results);
    // }

    public function live_search(Request $request){
        $query = $request->input('anggota');
        $data = Anggota::where('nama_anggota', 'LIKE', "%{$query}")->orWhere('majelis', 'LIKE', "%{$query}")->get();
        $result='';
        foreach($data as $item){
            $result.=' <div class="w-full flex gap-x-3 mb-8">
            <div class="">
                <img src="'.asset($item->user->foto) .'" class="w-16 rounded-full block">
                <p class="text-xs text-center text-gray-800 first-letter:uppercase">'. $item->user->name .'</p>
            </div>
            <div class="border-b border-gray-400 flex justify-between gap-x-5 w-full">
                <div>
                    <h1 class="text-sm text-gray-800 lowercase first-letter:uppercase">
                        '.$item->nama_anggota .'</h1>
                    <h2 class="text-sm text-gray-800 lowercase first-letter:uppercase">'. $item->majelis .'</h2>
                    <p class="text-xs">Rp '. number_format($item->monitoring_sum_nominal,0,',','.') .'</p>
                </div>
                <div>
                    <a href="'.route('mobile.detail_anggota', $item->id_anggota) .'"
                        class="text-xs border border-gray-500 px-2 py-1 rounded-lg">Detail</a>
                </div>
            </div>
        </div>';
        }

        return response()->json($result);
    }
        
}
