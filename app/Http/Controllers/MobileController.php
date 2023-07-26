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
        
        return view('mobile.hasil');
    }
    
}
