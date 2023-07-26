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
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monitoring=Monitoring::orderBy('id','desc')->get();
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
            $data['user_id']=Auth::id();
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
    public function edit(Monitoring $monitoring)
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

            // return $monitoring;
        if($request->hasFile('dokumentasi')){
            $uploadedFile = $request->file('dokumentasi');
            $ext=$uploadedFile->getClientOriginalExtension();
            $nama=$monitoring->anggota;
            $majelis=$monitoring->majelis;
            $newNamaFoto=$monitoring->id.'__'.$nama.'__'.$majelis.'__'.$monitoring->tanggal.'.'.$ext;
            $monitoring->dokumentasi=$uploadedFile->storeAs('public/dokumentasi',$newNamaFoto);
            $monitoring->save();
            return redirect()->back()->with('success','Monitoring berhasil di updated');
        }else{
            $monitoring->dokumentasi=$monitoring->dokumentasi;
            $monitoring->save();
            return redirect()->back()->with('success','Monitoring berhasil di updated');
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
    public function laporan(){
        return view('monitoring.laporan-pydb');
    }

    public function excel(Request $request,Monitoring $monitoring){
        try {
            $dari=$request->dari_tanggal;
            $sampai=$request->sampai_tanggal;
            $data=$monitoring::with('user')->whereBetween('tanggal', [$dari, $sampai])->get();
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Header
            $sheet->setCellValue('A1', 'Tanggal');
            $sheet->setCellValue('B1', 'Petugas');
            $sheet->setCellValue('C1', 'Anggota');
            $sheet->setCellValue('D1', 'Majelis');
            $sheet->setCellValue('E1', 'Nominal');
            $sheet->setCellValue('F1', 'Pola Bayar');
            $sheet->setCellValue('G1', 'Ditemui');
            $sheet->setCellValue('H1', 'Kondisi');
            $sheet->setCellValue('I1', 'Hasil');
            $sheet->setCellValue('J1', 'Dokumentasi');
            $row = 2;
            foreach ($data as $item) {
                $sheet->setCellValue('A' . $row, $item->tanggal);
                $sheet->setCellValue('B' . $row, $item->user->sub_name);
                $sheet->setCellValue('C' . $row, $item->anggota);
                $sheet->setCellValue('D' . $row, $item->majelis);
                $sheet->setCellValue('E' . $row, $item->nominal);
                $sheet->setCellValue('F' . $row, $item->pola_bayar);
                $sheet->setCellValue('G' . $row, $item->ditemui);
                $sheet->setCellValue('H' . $row, $item->kondisi);
                $sheet->setCellValue('I' . $row, $item->hasil);
                if ($item->dokumentasi == 0) {
                    $sheet->setCellValue('J' . $row, 'Tidak ada gambar');
                } else {
                    $imagePath = storage_path('app/' . $item->dokumentasi);
                    $drawing = new Drawing();
                    $drawing->setPath($imagePath);
                    $drawing->setWidth(50);
                    $drawing->setHeight(50);
                    $drawing->setCoordinates('J' . $row);
                    $drawing->setWorksheet($sheet);
                    $sheet->getRowDimension($row)->setRowHeight($drawing->getHeight());
                    $row++;
                }
            }

            $writer = new Xlsx($spreadsheet);
            $filename = 'data monitoring '.$dari.'s/d'.$sampai.'.xlsx';
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
        } catch (\Throwable $th) {
            return $th;
        }
        
        }

}
