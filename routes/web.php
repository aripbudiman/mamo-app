<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ProfileController;
use App\Models\Anggota;
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
    Route::post('/anggota/reset', [AnggotaController::class, 'resetAnggota'])->name('anggota.reset');
    Route::resource('monitoring',MonitoringController::class);
    Route::post('get-monitoring-harian',[MobileController::class,'getMonitoringHarian'])->name('getMonitoringHarian');
    Route::get('/edit-idanggota-monitoring',[MonitoringController::class,'edit_monitoring_idanggota'])->name('monitoring.edit_idanggota');
    Route::post('monitoring/select-majelis',[MonitoringController::class,'select_majelis'])->name('monitoring.majelis');
    Route::post('monitoring/select-anggota',[MonitoringController::class,'select_anggota'])->name('monitoring.anggota');
    Route::post('live_search',[AnggotaController::class,'live_search'])->name('live_search');
    Route::post('/tampil-monitoring/monitoring',[MonitoringController::class,'tampilkan'])->name('tampilkan');
    Route::post('/update-id_anggota',[MonitoringController::class,'update_id'])->name('update_id');
    Route::post('/import/excel', [AnggotaController::class, 'importExcel'])->name('import.excel');
    Route::get('/import/monitoring',[MonitoringController::class,'import'])->name('import');
    Route::post('import-monitoring', [MonitoringController::class, 'import_monitoring'])->name('monitoring.import');
    Route::get('laporan/monitoring',[MonitoringController::class,'laporan'])->name('laporan.monitoring');
    Route::post('laporan/excel',[MonitoringController::class,'excel'])->name('laporan.excel');
});

Route::middleware('auth')->group(function(){
    Route::get('/mobile/home',[MobileController::class,'home'])->name('mobile.home');
    Route::get('/mobile/riwayat',[MobileController::class,'riwayat'])->name('mobile.riwayat');
    Route::get('/mobile/hasil',[MobileController::class,'hasil'])->name('mobile.hasil');
    Route::get('/mobile/{details}/details',[MobileController::class,'details'])->name('mobile.details');
    Route::get('/mobile/form',[MobileController::class,'form'])->name('mobile.form');
    Route::get('/mobile/profile',[MobileController::class,'profile'])->name('mobile.profile');
    Route::get('/mobile/{monitoring}/dokumentasi',[MobileController::class,'edit_dok'])->name('mobile.edit_dok');
    Route::put('/mobile/{monitoring}',[MonitoringController::class,'update_dokumentasi'])->name('monitoring.update_dok');
    Route::get('/mobile/{tgl}/monitoring_hari_ini_tanggal',[MobileController::class,'day'])->name('mobile.day');
    Route::delete('/mobile/delete/{id}',[MobileController::class,'delete'])->name('mobile.delete');
    Route::get('/mobile/anggota',[MobileController::class,'anggota'])->name('mobile.anggota');
    Route::get('/mobile/detail-anggota/{anggota}',[MobileController::class,'detailAnggota'])->name('mobile.detail_anggota');
    Route::get('/mobile/cashin',[MobileController::class,'cashin'])->name('mobile.cashin');
    Route::get('/mobile/murabahah',[MobileController::class,'murabahah'])->name('murabahah.index');
    Route::get('/mobile/murabahah/create',[MobileController::class,'murabahah_create'])->name('murabahah.create');
    Route::post('/mobile/murabahah',[MobileController::class,'murabahah_store'])->name('murabahah.store');
});

require __DIR__.'/auth.php';
