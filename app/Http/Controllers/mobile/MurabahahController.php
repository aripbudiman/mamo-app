<?php

namespace App\Http\Controllers\mobile;

use App\Models\User;
use App\Models\Murabahah;
use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MurabahahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Murabahah::with('dokumentasi','user')->get();
        return view('mobile.murabahah',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->roles =='admin'){
            $data=User::all();
            return view('mobile.murabahah_create',compact('data'));
        }else{
            $data=User::where('id',Auth::id())->get();
            return view('mobile.murabahah_create',compact('data'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
