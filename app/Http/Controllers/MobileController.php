<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Anggota;
use App\Models\Monitoring;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
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
        $petugas=Auth::user()->sub_name;
        $data=$this->monitoring->getCapaian(Auth::id(),$petugas);
        return view('mobile.hasil',compact('data'));
    }


    public function createMonitoring(){
        if(Auth::user()->roles=='admin'){
            $user=User::all();
            return view('mobile.form-monitoring',compact('user'));
        }else{
            $user=User::where('roles','tpl')->where('id',Auth::id())->get();
            return view('mobile.form-monitoring',compact('user'));
        }
    }

    public function anggota(){
        $anggota=Anggota::with('user')->withSum('monitoring','nominal')->limit(30)->get();
        $user=User::where('roles','tpl')->get();
        return view('mobile.anggota',compact('anggota','user'));
    }

    public function detailAnggota(string $id){
        $result=Monitoring::statistikKunjunganAnggota($id);
        $anggota=Anggota::where('id_anggota',$id)->get();
        $data=Monitoring::with('user')->where('anggota_id',$id)->orderBy('tanggal','desc')->limit(5)->get();
        return view('mobile.detail-anggota',compact('result','anggota','data'));
    }

    public function cashin(){
        if(Auth::user()->roles =='admin'){
            $data=Monitoring::getUserIncomeSummary();
            return view('mobile.cashin',compact('data'));
        }else{
            $data=Monitoring::getUserIncomeSummary(Auth::id());
            return view('mobile.cashin',compact('data'));
        }
    }

    public function murabahah(){
        if(Auth::user()->roles =='admin'){
            $data=Murabahah::with('dokumentasi','user')->get();
            return view('mobile.murabahah',compact('data'));
        }else{
            $data=Dokumentasi::all();
            return view('mobile.murabahah',compact('data'));
        }
    }


        public function screenshoot(Request $request,$id)
        {
            $authToken = $request->header('XSRF-TOKEN'); // Ganti ini dengan cara yang sesuai untuk mendapatkan token
    $headers = [
        'Authorization' => 'Bearer ' . $authToken,
    ];

        // Ambil data transaksi berdasarkan $transactionId
        $transactionId = 872; // Ganti dengan ID transaksi yang sesuai
        $filename = 'transaction_' . $transactionId . '.png';
        $filePath = storage_path('app/public/screenshots/' . $filename);

        Browsershot::url('https://mamo-tech.dev/riwayat/'.$id)
            ->setOption('portrait', true)
            ->windowSize(360, 768)
            ->waitUntilNetworkIdle()
            ->setExtraHttpHeaders($headers)
            ->save('screenshoot.png');
  
        return back();
        }


        public function settings(){
            return view('mobile.setting');
        }
}
