<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
class MobileController extends Controller
{

    private $monitoring, $dari,$sampai;
    public function __construct()
    {
        $this->monitoring=new Monitoring();
        $this->dari=now()->firstOfMonth()->toDateString();
        $this->sampai=now()->lastOfMonth()->toDateString();
    }
    public function home(){
        if(Auth::user()->roles=='admin'){
            $data =Monitoring::whereDate('tanggal','=',date('Y-m-d',strtotime(today())))
            ->orderBy('id','desc')->get();
            $nominal =Monitoring::whereDate('tanggal','=',date('Y-m-d',strtotime(today())))->sum('nominal');
            $count =Monitoring::whereDate('tanggal','=',date('Y-m-d',strtotime(today())))->count();
            return view('mobile.home',compact('data','nominal','count'));
        }else{
            $data =Monitoring::where('user_id',Auth::id())
            ->whereDate('tanggal','=',date('Y-m-d',strtotime(today())))
            ->orderBy('id','desc')
            ->get();
            $nominal =Monitoring::where('user_id',Auth::id())->whereDate('tanggal','=',date('Y-m-d',strtotime(today())))->sum('nominal');
            $count =Monitoring::where('user_id',Auth::id())->whereDate('tanggal','=',date('Y-m-d',strtotime(today())))->count();
            return view('mobile.home',compact('data','nominal','count'));
        }
    }

    public function riwayat(){
        if(Auth::user()->roles=='admin'){
            $data =Monitoring::with('user')->orderBy('id','desc')->get();
            return view('mobile.riwayat',compact('data'));
        }else{
            $data =Monitoring::with('user')->where('user_id',Auth::id())->orderBy('id','desc')->get();
            return view('mobile.riwayat',compact('data'));
        }
    }

    public function details(Monitoring $details){
        return view('mobile.details-kunjungan',compact('details'));
    }

    public function form(){
        if(Auth::user()->roles=='admin'){
            $user=User::where('roles','tpl')->get();
            return view('mobile.form-monitoring',compact('user'));
        }else{
            $user=User::where('roles','tpl')->where('id',Auth::id())->get();
            return view('mobile.form-monitoring',compact('user'));
        } 
    }

    public function profile(){
        return view('mobile.profile');
    }

    public function edit_dok(Monitoring $monitoring){
        
        return view('mobile.edit_dok',compact('monitoring'));
    }

    public function day(String $id){
        if(Auth::user()->roles=='admin'){
            $data =Monitoring::whereDate('tanggal','=',$id)
            ->orderBy('id','desc')
            ->get();
            $nominal =Monitoring::whereDate('tanggal','=',date('Y-m-d',strtotime($id)))->sum('nominal');
            $count =Monitoring::whereDate('tanggal','=',date('Y-m-d',strtotime($id)))->count();
            return view('mobile.home',compact('data','nominal','count'));
        }else{
            $data =Monitoring::where('user_id',Auth::id())
                ->whereDate('tanggal','=',$id)
                ->orderBy('id','desc')
                ->get();
                $nominal =Monitoring::where('user_id',Auth::id())->whereDate('tanggal','=',date('Y-m-d',strtotime($id)))->sum('nominal');
                $count =Monitoring::where('user_id',Auth::id())->whereDate('tanggal','=',date('Y-m-d',strtotime($id)))->count();
                return view('mobile.home',compact('data','nominal','count'));
        }
    }

    public function delete(Monitoring $id){
        $id->delete();
        return back()->with('success','Monitoring berhasil dihapus');
    }

    public function hasil(){
        if(Auth::user()->roles=='admin'){
            $nominal=Monitoring::whereBetween('tanggal',[$this->dari,$this->sampai])->sum('nominal');
            $count=Monitoring::whereBetween('tanggal',[$this->dari,$this->sampai])->count();
            $bisaDitemui=Monitoring::where('ditemui','bisa')->whereBetween('tanggal',[$this->dari,$this->sampai])->count();
            $tidakBisaDitemui=Monitoring::where('ditemui','tidak bisa')->whereBetween('tanggal',[$this->dari,$this->sampai])->count();
            $polaBayar=Monitoring::groupBy('pola_bayar') ->select('pola_bayar', \DB::raw('count(*) as count'))
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
            $polaBayar=Monitoring::where('user_id',Auth::id())->groupBy('pola_bayar') ->select('pola_bayar', \DB::raw('count(*) as count'))
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
    
}
