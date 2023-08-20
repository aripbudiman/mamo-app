<?php

namespace App\Http\Controllers\mobile;

use App\Models\Monitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        if(Auth::user()->roles=='admin'){
            $data =Monitoring::whereDate('tanggal','=',date('Y-m-d',strtotime(today())))
            ->orderBy('id','desc')->get();
            $nominal =Monitoring::whereDate('tanggal','=',date('Y-m-d',strtotime(today())))->sum('nominal');
            $count =Monitoring::whereDate('tanggal','=',date('Y-m-d',strtotime(today())))->count();
            return view('mobile.riwayat',compact('data','nominal','count'));
        }else{
            $data =Monitoring::where('user_id',Auth::id())
            ->whereDate('tanggal','=',date('Y-m-d',strtotime(today())))
            ->orderBy('id','desc')
            ->get();
            $nominal =Monitoring::where('user_id',Auth::id())->whereDate('tanggal','=',date('Y-m-d',strtotime(today())))->sum('nominal');
            $count =Monitoring::where('user_id',Auth::id())->whereDate('tanggal','=',date('Y-m-d',strtotime(today())))->count();
            return view('mobile.riwayat',compact('data','nominal','count'));
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(String $id)
    {
        $details=Monitoring::find($id);
        return view('mobile.details-kunjungan',compact('details'));
    }

    public function edit(string $id)
    {
        $monitoring=Monitoring::findOrFail($id);
        return view('mobile.edit_dok',compact('monitoring'));
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $monitoring=Monitoring::findOrFail($id);
        $monitoring->delete();
        return back()->with('success','Monitoring berhasil dihapus');
    }

    public function fetchHistoryByDate(Request $request){
        $tanggal=$request->tanggal;
        if(Auth::user()->roles=='admin'){
            $data =Monitoring::whereDate('tanggal',$tanggal)
            ->orderBy('tanggal','desc')
            ->get();
            $results='';
            foreach($data as $item){
                $results.='<div class="card bg-blue-2 px-2 py-2 flex justify-between rounded-xl shadow-lg">
                <div class="flex items-start justify-center gap-y-1 flex-col">
                    <h1 class="text-xs first-letter:uppercase text-white font-poppins font-semibold lowercase">
                        '. $item->anggota .'</h1>
                    <h1 class="text-[10px] text-white font-poppins font-semibold capitalize">'. $item->majelis .'</h1>
                    <div class="flex">
                        <p class="text-[10px] text-white font-poppins">
                            '.  date('d-m-Y',strtotime($item->tanggal)) .' 🕛
                            '.  date('H:i',strtotime($item->created_at)) .'
                        </p>
                    </div>
                </div>
                <div class="w-28">
                    <div class="card bg-white/90 py-1 px-3 rounded-lg w-full leading-tight">
                        <div class="flex gap-x-1 justify-start">
                            <img class="block" src="'.asset('images/icons/dompet-gojek.svg') .'">
                            <h1 class="font-bold text-[10px] text-gray-800 font-poppins">CashIn</h1>
                        </div>
                        <p class="font-semibold font-poppins text-gray-900 text-xs">Rp
                            '. number_format($item->nominal,0,',','.') .'
                        </p>
                        <a href="'. route('riwayat.show',$item->id) .'"
                            class="text-green-2 hover:text-green-1 font-semibold font-poppins text-xs">Tap Detail</a>
                    </div>
                </div>
            </div>';
            }
            return response()->json($results);
        }else{
            $data =Monitoring::where('user_id',Auth::id())
                ->whereDate('tanggal',$tanggal)
                ->orderBy('id','desc')
                ->get();
                $results='';
            foreach($data as $item){
                $results.='<div class="card bg-blue-2 px-2 py-2 flex justify-between rounded-xl shadow-lg">
                <div class="flex items-start justify-center gap-y-1 flex-col">
                    <h1 class="text-xs first-letter:uppercase text-white font-poppins font-semibold lowercase">
                        '. $item->anggota .'</h1>
                    <h1 class="text-[10px] text-white font-poppins font-semibold capitalize">'. $item->majelis .'</h1>
                    <div class="flex">
                        <p class="text-[10px] text-white font-poppins">
                            '.  date('d-m-Y',strtotime($item->tanggal)) .' 🕛
                            '.  date('H:i',strtotime($item->created_at)) .'
                        </p>
                    </div>
                </div>
                <div class="w-28">
                    <div class="card bg-white/90 py-1 px-3 rounded-lg w-full leading-tight">
                        <div class="flex gap-x-1 justify-start">
                            <img class="block" src="'. asset('images/icons/dompet-gojek.svg') .'">
                            <h1 class="font-bold text-[10px] text-gray-800 font-poppins">CashIn</h1>
                        </div>
                        <p class="font-semibold font-poppins text-gray-900 text-xs">Rp
                            '.number_format($item->nominal,0,',','.') .'
                        </p>
                        <a href="'. route('riwayat.show',$item->id) .'"
                            class="text-green-2 hover:text-green-1 font-semibold font-poppins text-xs">Tap Detail</a>
                    </div>
                </div>
            </div>';
            }
            return response()->json($results);
        }
    }

    public function fetchDatesByMonth(Request $request){
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
            $results.='<div class="btn-tgl px-2 w-8 flex justify-center mx-2 rounded-lg text-center py-2 text-xs bg-white/90">
            <a onclick="fetchHistoryByDate(`'.date('Y-m-d',strtotime($item->tanggal)).'`)">
                <button type="button">
                    <p class="text-green-2">'. date('D',strtotime($item->tanggal)).'</p>
                    <p class="text-green-2 font-bold font-poppins">'. date('d',strtotime($item->tanggal)) .'</p>
                </button>
            </a>
        </div>';
        }
        return response()->json($results);
    }

    public function details(Monitoring $details){
        return view('mobile.details-kunjungan',compact('details'));
    }
}
