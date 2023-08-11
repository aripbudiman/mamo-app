<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Dokumentasi;
use App\Models\User;
use App\Models\Monitoring;
use App\Models\Murabahah;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
            $nominal =Monitoring::whereDate('tanggal','=',date('Y-m-d',strtotime(today())))->sum('nominal');
            $count =Monitoring::whereDate('tanggal','=',date('Y-m-d',strtotime(today())))->count();
            $data=Monitoring::with('user')->orderBy('tanggal','desc')->paginate(10);
            return view('mobile.home',compact('data'));
        }else{
            $nominal =Monitoring::where('user_id',Auth::id())->whereDate('tanggal','=',date('Y-m-d',strtotime(today())))->sum('nominal');
            $count =Monitoring::where('user_id',Auth::id())->whereDate('tanggal','=',date('Y-m-d',strtotime(today())))->count();
            $data=Monitoring::with('user')->orderBy('tanggal','desc')->paginate(10);
            return view('mobile.home',compact('data'));
        }
    }

    public function riwayat(){
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
            return view('mobile.riwayat',compact('data','nominal','count'));
        }else{
            $data =Monitoring::where('user_id',Auth::id())
                ->whereDate('tanggal','=',$id)
                ->orderBy('id','desc')
                ->get();
                $nominal =Monitoring::where('user_id',Auth::id())->whereDate('tanggal','=',date('Y-m-d',strtotime($id)))->sum('nominal');
                $count =Monitoring::where('user_id',Auth::id())->whereDate('tanggal','=',date('Y-m-d',strtotime($id)))->count();
                return view('mobile.riwayat',compact('data','nominal','count'));
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

    public function getMonitoringHarian(Request $request){
        $tanggal=$request->tanggal;
        if(Auth::user()->roles=='admin'){
            $data =Monitoring::whereDate('tanggal',$tanggal)
            ->orderBy('tanggal','desc')
            ->get();
            $results='';
            foreach($data as $item){
                $results.='<a href="'.route('mobile.details',$item->id) .'">
                <div class="card bg-hijau-10 my-2 px-4 py-3 flex justify-between rounded-md shadow-lg">
                    <div>
                        <h1 class="text-md text-slate-800 font-poppins font-semibold lowercase">'. $item->anggota .'</h1>
                        <h1 class="text-sm text-slate-800 font-poppins font-semibold capitalize">'. $item->majelis .'</h1>
                        <div class="flex">
                            <p class="text-[10px] text-slate-600 font-poppins">
                                '.  date('d-m-Y',strtotime($item->tanggal)) .' 🕛
                                '.  date('H:i',strtotime($item->created_at)) .'
                            </p>
                            <p class="text-[10px] ml-2 text-slate-600 font-poppins font-semibold lowercase">
                                <i class="bi bi-pen"></i> '. $item->user->name .'
                            </p>
                        </div>
                    </div>
                    <div class="text-right flex flex-col justify-between">
                        <h1 class="text-xs text-slate-800 font-poppins font-semibold capitalize">Rp
                            '. number_format($item->nominal,0,',','.') .'</h1>
                        <div class="flex items-center">
                            <a href="'. route('mobile.edit_dok',$item->id) .'"
                                class="text-sky-500 text-[10px] px-1 tex-xs">Edit</a>
                            <form action="'. route('mobile.delete',$item->id) .'" method="post" class="inline-flex">
                            ' . csrf_field() . method_field("DELETE") . '
                                <button onclick="return confirm(`Are you sure?`)" type="submit"
                                    class="text-rose-500 text-[10px] px-1 tex-xs">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </a>';
            }
            return response()->json($results);
        }else{
            $data =Monitoring::where('user_id',Auth::id())
                ->whereDate('tanggal',$tanggal)
                ->orderBy('id','desc')
                ->get();
                $results='';
            foreach($data as $item){
                $results.='<a href="'.route('mobile.details',$item->id) .'">
                <div class="card bg-hijau-10 my-2 px-4 py-3 flex justify-between rounded-md shadow-lg">
                    <div>
                        <h1 class="text-md text-slate-900 font-poppins font-semibold lowercase">'. $item->anggota .'</h1>
                        <h1 class="text-sm text-slate-900 font-poppins font-semibold capitalize">'. $item->majelis .'</h1>
                        <div class="flex">
                            <p class="text-[10px] text-slate-600 font-poppins">
                                '.  date('d-m-Y',strtotime($item->tanggal)) .' 🕛
                                '.  date('H:i',strtotime($item->created_at)) .'
                            </p>
                            <p class="text-[10px] ml-2 text-slate-600 font-poppins font-semibold lowercase">
                                <i class="bi bi-pen"></i> '. $item->user->name .'
                            </p>
                        </div>
                    </div>
                    <div class="text-right flex flex-col justify-between">
                        <h1 class="text-xs text-slate-800 font-poppins font-semibold capitalize">Rp
                            '. number_format($item->nominal,0,',','.') .'</h1>
                        <div class="flex items-center">
                            <a href="'. route('mobile.edit_dok',$item->id) .'"
                                class="text-sky-500 text-[10px] px-1 tex-xs">Edit</a>
                            <form action="'. route('mobile.delete',$item->id) .'" method="post" class="inline-flex">
                            ' . csrf_field() . method_field("DELETE") . '
                                <button onclick="return confirm(`Are you sure?`)" type="submit"
                                    class="text-rose-500 text-[10px] px-1 tex-xs">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </a>';
            }
            return response()->json($results);
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
    }
    
}
