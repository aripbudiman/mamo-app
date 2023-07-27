<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;

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

    
}
