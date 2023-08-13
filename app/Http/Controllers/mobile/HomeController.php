<?php

namespace App\Http\Controllers\mobile;

use App\Models\Monitoring;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
