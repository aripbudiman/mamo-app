<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\mobile\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mobile\HomeController;
use App\Http\Controllers\mobile\RiwayatController;
use App\Http\Controllers\mobile\MurabahahController;
use App\Http\Controllers\mobile\MonitoringController as Monitoring;
use App\Http\Controllers\mobile\WilayahController;
use App\Http\Controllers\mobile\StatistikController;
use App\Http\Controllers\RoadMapController;
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
        return redirect()->route('home.index');
    }
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::resource('anggota',AnggotaController::class);
    Route::post('/anggota/reset', [AnggotaController::class, 'resetAnggota'])->name('anggota.reset');
    Route::resource('monitoring',MonitoringController::class);
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
    Route::resource('roadmap',RoadMapController::class);
    Route::post('roadmap/import',[RoadMapController::class,'importExcel'])->name('roadmap.import');
    Route::post('road_map/select_kecamatan',[RoadMapController::class,'selectKecamatan'])->name('road_map.select_kecamatan');
    Route::post('road_map/select_desa',[RoadMapController::class,'selectDesa'])->name('road_map.select_desa');
    Route::get('get_road_maps',[RoadMapController::class,'getRoadMaps'])->name('get_road_maps');
    Route::get('road_maps',[RoadMapController::class,'roadMaps'])->name('road_maps');
});

Route::middleware('auth')->group(function(){
    Route::get('/mobile/hasil',[MobileController::class,'hasil'])->name('mobile.hasil');
    Route::get('/mobile/form',[MobileController::class,'createMonitoring'])->name('mobile.form');
    Route::put('/mobile/{monitoring}',[MonitoringController::class,'update_dokumentasi'])->name('monitoring.update_dok');
    Route::get('/mobile/anggota',[MobileController::class,'anggota'])->name('mobile.anggota');
    Route::get('/mobile/detail-anggota/{anggota}',[MobileController::class,'detailAnggota'])->name('mobile.detail_anggota');
    Route::get('/mobile/anggota_keluar/{id}',[AnggotaController::class,'anggota_keluar'])->name('mobile.anggota_keluar');
    Route::post('/mobile/store_anggota_keluar',[AnggotaController::class,'store_anggota_keluar'])->name('mobile.store_anggota_keluar');
    Route::get('/mobile/mutasi_keluar',[AnggotaController::class,'mutasi_keluar'])->name('mobile.mutasi_keluar');
    Route::get('/mobile/cashin',[MobileController::class,'cashin'])->name('mobile.cashin');
    Route::get('/mobile/sp3',[MobileController::class,'sp3'])->name('mobile.sp3');
});
 
Route::middleware('auth')->group(function(){
    Route::resource('riwayat',RiwayatController::class);
    Route::resource('home',HomeController::class);
    Route::post('fetch-history-by-date',[RiwayatController::class,'fetchHistoryByDate'])->name('riwayat.fetchHistoryByDate');
    Route::post('fetch-d ates-by-month',[RiwayatController::class,'fetchDatesByMonth'])->name('fetchDatesByMonth'); 
    Route::resource('murabahah',MurabahahController::class);
    Route::get('get-murabahah-in-profile-page/profile',[ProfileController::class,'getMurabahahInProfilePage'])->name('getMurabahahInProfilePage.profile');
    Route::get('get-monitoring-in-profile-page/profile',[ProfileController::class,'getMonitoringInProfilePage'])->name('getMonitoringInProfilePage.profile');
    Route::resource('profile',ProfileController::class);
    Route::post('screenshoot/{id}',[MobileController::class,'screenshoot'])->name('screenshoot.screen');
    Route::get('/settings',[MobileController::class,'settings'])->name('settings');
    Route::resource('mobilemonitoring',Monitoring::class);
    Route::resource('wilayah',WilayahController::class);
    Route::resource('par',StatistikController::class);
});


require __DIR__.'/auth.php';
