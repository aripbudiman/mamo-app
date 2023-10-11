<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    public function index(){
        $anggota = Anggota::groupBy('majelis')
        ->select('majelis')
        ->get();
        $petugas=User::where('roles','tpl')->get();
        return view('database.rolling',compact('anggota','petugas'));
    }

    public function update(Request $request){
        $anggota=Anggota::where('majelis',$request->majelis)->get();
        foreach($anggota as $a){
            $a->petugas=$request->petugas;
            $a->save();
        }
        return back();
    }
}
