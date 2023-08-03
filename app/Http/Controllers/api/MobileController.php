<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            $results.='<div class="btn-tgl px-2 w-8 flex justify-center mx-2 rounded-lg text-center py-2 text-xs bg-yellow-300">
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
        
}
