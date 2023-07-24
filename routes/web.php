<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ProfileController;
use App\Models\Monitoring;
use Illuminate\Support\Facades\Route;

use Jenssegers\Agent\Agent;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $agent=new Agent();
    if($agent->isDesktop()){
        return view('welcome');
    }elseif($agent->isMobile()){
        return redirect()->route('mobile.home');
    }
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('anggota',AnggotaController::class);
    Route::resource('monitoring',MonitoringController::class);
    Route::post('monitoring/select-majelis',[MonitoringController::class,'select_majelis'])->name('monitoring.majelis');
    Route::post('monitoring/select-anggota',[MonitoringController::class,'select_anggota'])->name('monitoring.anggota');
    Route::post('/import/excel', [AnggotaController::class, 'importExcel'])->name('import.excel');
    Route::get('/import/monitoring',[MonitoringController::class,'import'])->name('import');
    Route::post('import-monitoring', [MonitoringController::class, 'import_monitoring'])->name('monitoring.import');
});

Route::middleware('auth')->group(function(){
    Route::get('/mobile/home',[MobileController::class,'home'])->name('mobile.home');
    Route::get('/mobile/riwayat',[MobileController::class,'riwayat'])->name('mobile.riwayat');
    Route::get('/mobile/{details}/details',[MobileController::class,'details'])->name('mobile.details');
    Route::get('/mobile/form',[MobileController::class,'form'])->name('mobile.form');
    Route::get('/mobile/profile',[MobileController::class,'profile'])->name('mobile.profile');
    Route::get('/mobile/{monitoring}/dokumentasi',[MobileController::class,'edit_dok'])->name('mobile.edit_dok');
    Route::put('/mobile/{monitoring}',[MonitoringController::class,'update_dokumentasi'])->name('monitoring.update_dok');
});

require __DIR__.'/auth.php';
