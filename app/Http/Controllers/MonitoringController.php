<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Intervention\Image\Facades\Image;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monitoring=Monitoring::with('user')->orderBy('id','desc')->paginate(21);
        // return $monitoring;
        return view('monitoring.list-monitoring-pydb',compact('monitoring'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->roles=='admin'){
            $user=User::all();
            return view('monitoring.form-monitoring',compact('user'));
        }else{
            $user=User::where('roles','tpl')->where('id',Auth::id())->get();
            return view('monitoring.form-monitoring',compact('user'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required',
        'majelis' => 'required',
        'anggota' => 'required',
        'dokumentasi' => 'required|image', // Pastikan gambar diunggah
    ]);

    DB::beginTransaction();
    try {
        $data = $request->all();
        $uploadedFile = $request->file('dokumentasi');

        $anggota = explode('-', $request->anggota);
        $data['anggota'] = $anggota[0];
        $data['anggota_id'] = $anggota[1];
        $harian = date('d-m-Y', strtotime($request->tanggal));
        $folderPath = storage_path('app/public/dokumentasi/' . $harian);

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // Mengubah ukuran gambar
        $newFilename = $this->resizeAndSaveImage($uploadedFile, $data, $harian);

        $data['user_id'] = Auth::id();
        Monitoring::create($data);
        DB::commit();
        return redirect()->back()->with('success', 'Monitoring berhasil ditambahkan');
    } catch (\Throwable $th) {
        DB::rollBack();
        return $th;
    }
}

// Fungsi untuk mengubah ukuran gambar dan menyimpannya
private function resizeAndSaveImage($uploadedFile, &$data, $harian)
{
    $image = Image::make($uploadedFile);

    // Mengubah ukuran gambar (misalnya, ke lebar 800px dan tinggi sesuai proporsinya)
    $image->resize(800, null, function ($constraint) {
        $constraint->aspectRatio();
    });

    // Buat nama file baru yang unik
    $newFilename = $this->generateUniqueFilename($uploadedFile, $data, $harian);

    // Simpan gambar yang diubah
    $image->save(storage_path('app/public/dokumentasi/' . $harian . '/' . $newFilename));

    $data['dokumentasi'] = 'public/dokumentasi/' . $harian . '/' . $newFilename;

    return $newFilename;
}

// Fungsi untuk menghasilkan nama file yang unik
private function generateUniqueFilename($uploadedFile, $data, $harian)
{
    $lastId = DB::table('monitoring')->orderBy('id', 'desc')->first();
    if ($lastId !== null) {
        $newId = $lastId->id + 1;
    } else {
        $newId = 1;
    }

    return $newId . '__' . $data['anggota'].$data[''] . '__' . $data['majelis'] . '__' . date('d-F-Y', strtotime($data['tanggal'])) . '.' . $uploadedFile->getClientOriginalExtension();
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
    public function destroy(Monitoring $monitoring)
    {
        $monitoring->delete();
        return back()->with('success','Monitoring berhasil di delete');
    }

    public function select_majelis(Request $request)
    {
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
                ->select('nama_anggota','id_anggota')
                ->where('majelis', $majelis)
                ->get();
                $output = '';
        foreach ($anggota as $a) {
            $output .= '<option value="' . $a->nama_anggota.'-'.$a->id_anggota.'" data-id_anggota="'.$a->id_anggota.'">' . $a->nama_anggota. '</option>';
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

     public function edit_monitoring_idanggota(){
        $petugas=User::where('roles','tpl')->get();
        return view('monitoring.edit-idanggota-monitoring',compact('petugas'));
    }

    public function tampilkan(Request $request){
        $majelis=$request->majelis;
        $data=Monitoring::where('majelis',$majelis)->get();
        $output='';
        foreach($data as $d){
            $output.='
            <tr>
            <td
                class="px-1 py-1 w-20 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                <input type="text" name="id[]" value="'.$d->id.'" class="w-full text-center"></td>
            <td
                class="px-1 py-1 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                <input type="text" class="w-full" value="'.$d->anggota.'"></td>
            <td class="px-1 py-1 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                <input type="text" class="w-full" value="'.$d->majelis.'">
            </td>
            <td class="px-1 py-1 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
            <input type="text" class="w-full" value="'.date('d F Y',strtotime($d->tanggal)).'">
            </td>
            <td class="px-1 py-1 whitespace-nowrap text-right text-sm font-medium">
                <input type="text" name="id_anggota[]" value="'.$d->anggota_id.'" class="w-full">
            </td>
        </tr>
        ';
        }
        return response()->json($output);
    }

    public function update_id(Request $request){
        $data = $request->all();
        $ids = $data['id'];
        $idAnggota = $data['id_anggota'];
        foreach ($ids as $index => $id) {
            // Cek apakah ID dan id_anggota tidak kosong/null
            if (!empty($id) && !is_null($idAnggota[$index])) {
                // Temukan data monitoring berdasarkan ID
                $monitoring = Monitoring::find($id);

                if ($monitoring) {
                    // Update kolom "id_anggota" dengan nilai baru
                    $monitoring->anggota_id = $idAnggota[$index];
                    $monitoring->save();
                }
            }
        }

        return back();
    }

}
