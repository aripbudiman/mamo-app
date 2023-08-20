<?php

namespace App\Http\Controllers\mobile;

use App\Models\Anggota;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Monitoring;
use App\Models\Murabahah;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $data=Anggota::getMajelisAnggotaStatsByPetugas(Auth::user()->sub_name);
        $monitoring=Monitoring::where('user_id',Auth::id())->orderBy('tanggal','desc')->limit(30)->get();
        $postMonitoring=Monitoring::getTotalPostMonitoringByUser(Auth::id());
        $postMurabahah=Murabahah::getTotalPostMurabahahByUser(Auth::id());
        return view('mobile.profile',compact('data','monitoring','postMonitoring','postMurabahah'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function show(string $id)
    {
        
    }

 
    public function edit(string $id)
    {
        
    }


    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
        
    }

    public function getMurabahahInProfilePage(){
        $data =Murabahah::with('dokumentasi')->where('user_id',Auth::id())->orderBy('tanggal','desc')->limit(30)->get();
        $result='';
        foreach ($data as $item) {
           $result.=' <img src="'. asset(str_replace('public','storage',$item->dokumentasi[0]->foto)).'"
            class="object-contain self-center bg-gradient-to-t from-green-1 via-emerald-300 to-blue-2 h-full">';
        }
        return response()->json($result);
    }

    public function getMonitoringInProfilePage(){
        $monitoring=Monitoring::where('user_id',Auth::id())->orderBy('tanggal','desc')->limit(30)->get();
        $result='';
        foreach ($monitoring as $item) {
            $result.='<img src="'. asset(str_replace('public','storage',$item->dokumentasi)) .'"
            class="object-contain self-center bg-gradient-to-t from-green-1 via-emerald-300 to-blue-2 h-full">';
        }
        return response()->json($result);
    }
}
