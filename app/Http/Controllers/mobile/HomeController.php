<?php

namespace App\Http\Controllers\mobile;

use Carbon\Carbon;
use App\Models\Murabahah;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    public function index()
    {
        $currentMonth = Carbon::now()->format('Y-m');
        if(Auth::user()->roles=='admin'){
            $nominal = Monitoring::where(DB::raw('MONTH(tanggal)'), '=', Carbon::now()->month)
                                ->sum('nominal');
            $count =Monitoring::whereDate('tanggal','=',date('Y-m-d',strtotime(today())))->count();
            $data=Monitoring::with('user')->orderBy('tanggal','desc')->paginate(10);
            $murabahah=Murabahah::with('user','dokumentasi')->orderBy('tanggal','desc')->paginate(10);
            return view('mobile.home',compact('data','murabahah','nominal'));
        }else{
            $nominal = Monitoring::where('user_id',Auth::id())->where(DB::raw('MONTH(tanggal)'), '=', Carbon::now()->month)
                                ->sum('nominal');
            $count =Monitoring::where('user_id',Auth::id())->whereDate('tanggal','=',date('Y-m-d',strtotime(today())))->count();
            $data=Monitoring::with('user')->orderBy('tanggal','desc')->paginate(10);
            $murabahah=Murabahah::with('user','dokumentasi')->orderBy('tanggal','desc')->paginate(10);
            return view('mobile.home',compact('data','murabahah','nominal'));
        }
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
}
