<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Validation\Rule;
use App\Models\AnggotaKeluar;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggota=Anggota::paginate(50);
        return view('anggota.index',compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        foreach ($data as $row) {
            $idAnggota = $row[0];
            $namaAnggota = $row[1];
            $majelis = $row[2];
            $petugas = $row[3];
            $outstanding = $row[4];

            $anggota=new Anggota();
            $anggota->id_anggota=str_replace(" ","",$idAnggota);
            $anggota->nama_anggota=$namaAnggota;
            $anggota->majelis=$majelis;
            $anggota->petugas=$petugas;
            $anggota->outstanding=$outstanding;
            $anggota->save();
        }

        return redirect()->back()->with('success', 'Data berhasil diimpor dari file Excel.');
    }


    public function resetAnggota()
    {
        Anggota::resetAnggota();
        return redirect()->back()->with('success', 'Data anggota berhasil direset.');
    }

    public function live_search(Request $request){
        $query = $request->input('query');
        $data = Anggota::where('majelis', 'LIKE', "%{$query}%")->get();
        $results='';
        foreach($data as $item){
            $results.='<tr>
            <td
                class="px-2 py-1 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                '.$item->id_anggota.'</td>
            <td
                class="px-2 py-1 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                '.$item->nama_anggota.'</td>
            <td class="px-2 py-1 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                '.$item->majelis .'
            </td>
            <td class="px-2 py-1 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                '.$item->petugas .'</td>
            <td class="px-2 py-1 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                '.number_format($item->outstanding,0,',','.').'</td>
            <td class="px-2 py-1 whitespace-nowrap text-right text-sm font-medium">
                <a class="text-blue-500 hover:text-blue-700" href="#">Edit</a>
            </td>
        </tr>';
        }

        return response()->json($results);
    }

    public function anggota_keluar($id){
        $anggota = Anggota::where('id_anggota',$id)->get();
        return view('mobile.anggota-keluar',compact('anggota'));
    }

    public function store_anggota_keluar(Request $request){
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg',
            'nama_anggota' => 'required',
            'tanggal' => 'required',
            'majelis' => 'required',
            'alesan' => 'required',
        ]);
    DB::beginTransaction();
    try {
        $harian=date('d-m-Y',strtotime($request->tanggal));
        $folderPath = storage_path('app/public/anggota_keluar/' . $harian);
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        $tanggal=date('d_F_Y',strtotime($request->tanggal));
        $majelis=$request->majelis;
        $nama=$request->nama_anggota;
        $ext= $request->image->getClientOriginalExtension();
        $alesan=$request->alesan;
        $newName=time().$tanggal.'@'.$majelis.'@'.$nama.'.'.$ext;
        $path=$request->image->storeAs('public/anggota_keluar/'.$harian, $newName);
        AnggotaKeluar::create([
            'image'=>$newName,
            'nama_anggota'=>$nama,
            'majelis'=>$majelis,
            'alesan'=>$alesan,
            'tanggal'=>$request->tanggal,
            'image'=>$path,
            'user_id'=>Auth::id()
        ]);
        DB::commit();
        return redirect()->route('mobile.anggota')->with('success', 'Data berhasil diimpor dari file Excel.');
    } catch (\Throwable $th) {
        return $th;
       DB::rollback();
    }
    
    }

    public function mutasi_keluar(){
        $data=AnggotaKeluar::with('user')->orderBy('id','desc')->limit(30)->get();
        return view('mobile.mutasi-keluar',compact('data'));
    }
}
