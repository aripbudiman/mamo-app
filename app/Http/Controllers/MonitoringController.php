<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monitoring=Monitoring::all();
        return view('monitoring.list-monitoring-pydb',compact('monitoring'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user=User::where('roles','tpl')->where('id',Auth::id())->get();
        return view('monitoring.form-monitoring',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'=>'required',
            'majelis'=>'required',
            'anggota'=>'required',
        ]);
        DB::beginTransaction();
        try {
            $data = $request->all();
            $uploadedFile = $request->file('dokumentasi');
            $lastId = DB::table('monitoring')->orderBy('id', 'desc')->first();
            if ($lastId !== null) {
                $newId = $lastId->id + 1;
            } else {
                $newId = 1;
            }
            $newFilename = $newId.'__'.$data['anggota'].'__'.$data['majelis'].'__'.date('d-F-Y', strtotime($data['tanggal'])) . '.' . $uploadedFile->getClientOriginalExtension();
            $data['dokumentasi'] = $uploadedFile->storeAs('public/dokumentasi', $newFilename);
<<<<<<< HEAD
            $data['user_id']=1;
=======
            $data['user_id']=Auth::id();
>>>>>>> origin/master
            Monitoring::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Monitoring berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
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

    public function select_majelis(Request $request){
        $petugas = $request->petugas;
        $majelis = DB::table('anggota')
                ->select('majelis')
                ->where('petugas', $petugas)
                ->groupBy('majelis')
                ->get();
                $output = '';
        foreach ($majelis as $l) {
            $output .= '<option value="' . $l->majelis . '">' . $l->majelis. '</option>';
        }
        return response()->json($output);
    }

    public function select_anggota(Request $request){ 
        $majelis = $request->majelis;
        $anggota = DB::table('anggota')
                ->select('nama_anggota')
                ->where('majelis', $majelis)
                ->get();
                $output = '';
        foreach ($anggota as $a) {
            $output .= '<option value="' . $a->nama_anggota . '">' . $a->nama_anggota. '</option>';
        }
        return response()->json($output);
    }

    public function update_dokumentasi(Request $request,Monitoring $monitoring){

        if($request->hasFile('dokumentasi')){
            $uploadedFile = $request->file('dokumentasi');
            $ext=$uploadedFile->getClientOriginalExtension();
            $nama=$monitoring->anggota;
            $majelis=$monitoring->majelis;
            $newNamaFoto=$monitoring->id.'__'.$nama.'__'.$majelis.'__'.$monitoring->tanggal.'.'.$ext;
            $monitoring->dokumentasi=$uploadedFile->storeAs('public/dokumentasi',$newNamaFoto);
            $monitoring->save();
            return redirect()->back();
        }else{
            $monitoring->dokumentasi=$monitoring->dokumentasi;
            $monitoring->save();
            return redirect()->back();
        }   
    }

    public function import(){
        return view('monitoring.import');
    }

    public function import_monitoring(Request $request){
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);
    
        try {
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
    
            // Mulai dari baris kedua untuk menghindari baris judul
            foreach ($rows as $key => $row) {
                if ($key == 0) continue; // Lewati baris judul
                $data = [
                    'user_id' => $row[0],
                    'tanggal' => $row[1],
                    'ditemui' => $row[2],
                    'pola_bayar' => $row[3],
                    'majelis' => $row[4],
                    'anggota' => $row[5],
                    'kondisi' => $row[6],
                    'hasil' => $row[7],
                    'nominal' => $row[8],
                    'dokumentasi' => $row[9],
                ];
    
                // Simpan data ke tabel monitoring sesuai kebutuhan Anda
                Monitoring::create($data);
            }
    
            return redirect()->back()->with('success', 'Data berhasil diimpor');
        } catch (\Exception $e) {
            $error=$e;
            return $error;
        }
    }

}
