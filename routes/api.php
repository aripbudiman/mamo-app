<?php

use App\Http\Controllers\api\MobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('get-list-tanggal',[MobileController::class,'getListTanggal'])->name('getListTanggal');
Route::post('live_search/anggota',[MobileController::class,'live_search'])->name('live_search.anggota');
