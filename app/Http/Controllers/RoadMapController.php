<?php

namespace App\Http\Controllers;

use App\Models\RoadMap;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class RoadMapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=RoadMap::all();
        return view('roadmaps.index',compact('data'));
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
        $latlng= explode('|', $request->latlng);
        $latitude=$latlng[0];
        $longitude=$latlng[1];
        $data=RoadMap::where('majelis', $request->majelis)->first();
        $data->latitude=$latitude;
        $data->longitude=$longitude;
        $data->save();
        return redirect()->back()->with('success', 'Data saved successfully!');
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
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file');

        try {
            $spreadsheet = IOFactory::load($file);
            $worksheet = $spreadsheet->getActiveSheet();
            
            foreach ($worksheet->getRowIterator() as $row) {
                $data = $row->getCellIterator();
                $rowData = [];
                foreach ($data as $cell) {
                    $rowData[] = $cell->getValue();
                }

                // Skip header row
                if ($row->getRowIndex() === 1) {
                    continue;
                }

                RoadMap::create([
                    'kecamatan' => $rowData[0],
                    'desa' => $rowData[1],
                    'majelis' => $rowData[2],
                ]);
            }

            return redirect()->back()->with('success', 'Data imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while importing data.');
        }
    }

    public function roadMaps(){
        return view('roadmaps.road_maps');
    }


    public function selectKecamatan(Request $request){
        $kecamatan=$request->kecamatan;
        $data = DB::table('road_maps')
        ->select('desa')
        ->where('kecamatan', $kecamatan)
        ->groupBy('desa')
        ->get();
        $output = '';
        foreach ($data as $a) {
            $output .= '<option value="' . $a->desa.'">' . $a->desa. '</option>';
        }
        return response()->json($output);
    }

    public function selectDesa(Request $request){
        $desa=$request->desa;
        $data = DB::table('road_maps')
        ->select('majelis')
        ->where('desa', $desa)
        ->get();
        $output = '';
        foreach ($data as $a) {
            $output .= '<option value="' . $a->majelis.'">' . $a->majelis. '</option>';
        }
        return response()->json($output);
    }

    public function getRoadMaps(){
        $data = RoadMap::whereNotNull('latitude')->get();
        return response()->json($data);
    }
}
