<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MobileController extends Controller
{
    public function home(){
        $data =Monitoring::where('user_id',Auth::id())->orderBy('id','desc')->get();
        return view('mobile.home',compact('data'));
    }

    public function riwayat(){
        $data =Monitoring::where('user_id',Auth::id())->orderBy('tanggal','desc')->get();
        return view('mobile.riwayat',compact('data'));
    }

    public function details(Monitoring $details){
        return view('mobile.details-kunjungan',compact('details'));
    }

    public function form(){
        $user=User::where('roles','tpl')->where('id',Auth::id())->get();
        return view('mobile.form-monitoring',compact('user'));
    }

    public function profile(){
        return view('mobile.profile');
    }
}
