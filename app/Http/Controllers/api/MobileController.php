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
    public function getListTanggal(Request $request){
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        $monitoringData = DB::table('monitoring')
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->groupBy('tanggal')
            ->orderBy('tanggal','DESC')
            ->get(['tanggal']);

        $results='';
        foreach ($monitoringData as $item) {
            $results.='<div class="btn-tgl px-2 w-8 flex justify-center mx-2 rounded-lg text-center py-2 text-xs bg-hijau-10">
            <a onclick="getMonitoringHarian(`'.date('Y-m-d',strtotime($item->tanggal)).'`)">
                <button type="button">
                    <p class="text-slate-700">'. date('D',strtotime($item->tanggal)).'</p>
                    <p class="text-slate-900 font-bold font-poppins">'. date('d',strtotime($item->tanggal)) .'</p>
                </button>
            </a>
        </div>';
        }
        return response()->json($results);
    }

    public function live_search(Request $request){
        $query = $request->input('anggota');
        $data = Anggota::where('nama_anggota', 'LIKE', "%{$query}%")->get();
        $result='';
        foreach($data as $d){
            $result.='<a href="'. route('mobile.detail_anggota', $d->id_anggota) .'" class="card bg-hijau-10 mx-5 my-4 p-3 rounded-lg block shadow-md border border-hijau-20">
            <h2 class="lowercase first-letter:uppercase font-poppins font-semibold text-lg text-slate-900">
                '.$d->nama_anggota .'
            </h2>
            <p class="lowercase first-letter:uppercase text-slate-900">'.$d->majelis.'</p>
        </a>';
        }

        return response()->json($result);
    }
        
}
