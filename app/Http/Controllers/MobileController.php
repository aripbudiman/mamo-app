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
<<<<<<< HEAD
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
            $data=Murabahah::with('dokumentasi','user')->get();
            return view('mobile.murabahah',compact('data'));
        }
    }


    public function murabahah_create(){
        if(Auth::user()->roles =='admin'){
            $data=User::all();
            return view('mobile.murabahah_create',compact('data'));
        }else{
            $data=User::where('id',Auth::id())->get();
            return view('mobile.murabahah_create',compact('data'));
        }
    }

    public function murabahah_store(Request $request){
        $request->validate([
            'foto.*' => 'image|mimes:jpeg,png,jpg',
            'anggota'=>'required',
            'majelis'=>'required',
            'tanggal'=>'required',
            'nominal'=>'required',
        ]);
        DB::beginTransaction();
        try {
            $data=$request->except('foto');;
            $anggota=explode('-', $request->anggota);
            $data['anggota']=$anggota[0];
            $data['anggota_id']=$anggota[1];
            $data['user_id']=Auth::id();
            $murabahah = Murabahah::create($data);
            $murabahahId = $murabahah->id;    
            $no=1;
            if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $photo) {
                $harian=date('d-m-Y',strtotime($request->tanggal));
                $folderPath = storage_path('app/public/murabahah/' . $harian);
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                    $extension = $photo->getClientOriginalExtension();
                    $path = $photo->storeAs('public/murabahah/'.$harian, $no++.'.'.$request->petugas.' MBA @'.$data['anggota'].'@'.$request->majelis.'@'.$request->tanggal.'@'.$request->nominal.'.'.$extension); 
                    Dokumentasi::create([
                        'murabahah_id'=>$murabahahId,
                        'foto'=>$path
                    ]);
                }
            DB::commit();
        }
            return redirect()->back()->with('success','Murabahah berhasil ditambahkan');
        } catch (\Throwable $error) {
            return $error;
            DB::rollback();
        }
=======
        $userId = Auth::id();
        $isAdmin = Auth::user()->roles == 'admin';
    
        $data = $isAdmin
            ? Monitoring::getUserIncomeSummary()
            : Monitoring::getUserIncomeSummary($userId);
    
        return view('mobile.cashin', compact('data'));
>>>>>>> cleancode
    }
    
}
