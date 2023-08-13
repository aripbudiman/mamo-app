<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use App\Models\Monitoring;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MobileController extends Controller
{

    private $monitoring, $dari,$sampai;
    public function __construct()
    {
        $this->monitoring=new Monitoring();
        $this->dari=now()->firstOfMonth()->toDateString();
        $this->sampai=now()->lastOfMonth()->toDateString();
    }
 
    public function hasil(){
        if(Auth::user()->roles=='admin'){
            $nominal=Monitoring::whereBetween('tanggal',[$this->dari,$this->sampai])->sum('nominal');
            $count=Monitoring::whereBetween('tanggal',[$this->dari,$this->sampai])->count();
            $bisaDitemui=Monitoring::where('ditemui','bisa')->whereBetween('tanggal',[$this->dari,$this->sampai])->count();
            $tidakBisaDitemui=Monitoring::where('ditemui','tidak bisa')->whereBetween('tanggal',[$this->dari,$this->sampai])->count();
            $polaBayar=Monitoring::whereBetween('tanggal',[$this->dari,$this->sampai])->groupBy('pola_bayar') ->select('pola_bayar', \DB::raw('count(*) as count'))
            ->get();
            $polaBayarKategori=[];
            $countPolaBayar=[];
            foreach ($polaBayar as $key=>$value) {
                $polaBayarKategori[$key]=$value->pola_bayar;
                $countPolaBayar[$key]=$value->count;
            }
            return view('mobile.hasil',[
                'kategori'=>$polaBayarKategori,
                'count_pola'=>$countPolaBayar,
                'count'=>$count,
                'nominal'=>$nominal,
                'akun'=>$count
            ]);
        }else{
            $nominal=Monitoring::where('user_id',Auth::id())->whereBetween('tanggal',[$this->dari,$this->sampai])->sum('nominal');
            $count=Monitoring::where('user_id',Auth::id())->whereBetween('tanggal',[$this->dari,$this->sampai])->count();
            $bisaDitemui=Monitoring::where('user_id',Auth::id())->where('ditemui','bisa')->whereBetween('tanggal',[$this->dari,$this->sampai])->count();
            $tidakBisaDitemui=Monitoring::where('user_id',Auth::id())->where('ditemui','tidak bisa')->whereBetween('tanggal',[$this->dari,$this->sampai])->count();
            $polaBayar=Monitoring::where('user_id',Auth::id())->whereBetween('tanggal',[$this->dari,$this->sampai])->groupBy('pola_bayar') ->select('pola_bayar', \DB::raw('count(*) as count'))
            ->get();
            $polaBayarKategori=[];
            $countPolaBayar=[];
            foreach ($polaBayar as $key=>$value) {
                $polaBayarKategori[$key]=$value->pola_bayar;
                $countPolaBayar[$key]=$value->count;
            }
            return view('mobile.hasil',[
                'kategori'=>$polaBayarKategori,
                'count_pola'=>$countPolaBayar,
                'count'=>$count,
                'nominal'=>$nominal,
                'akun'=>$count
            ]);
        }
        
    }

    public function anggota(){
        $anggota=Anggota::all();
        $user=User::where('roles','tpl')->get();
        return view('mobile.anggota',compact('anggota','user'));
    }

    public function detailAnggota(string $id){
        $result=Monitoring::statistikKunjunganAnggota($id);
        $anggota=Anggota::where('id_anggota',$id)->get();
        return view('mobile.detail-anggota',compact('result','anggota'));
    }

    public function cashin(){
        $userId = Auth::id();
        $isAdmin = Auth::user()->roles == 'admin';
    
        $data = $isAdmin
            ? Monitoring::getUserIncomeSummary()
            : Monitoring::getUserIncomeSummary($userId);
    
        return view('mobile.cashin', compact('data'));
    }
    
}
