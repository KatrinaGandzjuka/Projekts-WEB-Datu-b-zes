<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddTerpiController;
use App\Http\Controllers\AddGrupasController;
use App\Http\Controllers\ViewLietotajiController;
use App\Http\Controllers\ViewGrupasController;
use App\Http\Controllers\ViewTerpiController;
use App\Http\Controllers\DeleteLietotajiController;
use App\Http\Controllers\DeleteGrupasController;
use App\Http\Controllers\DeleteTerpiController;
use App\Http\Controllers\AudzekniGrupasController;
use App\Http\Controllers\PedagogiGrupasController;
use App\Http\Controllers\AudzekniKostimiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NumursController;

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


Route::get('/', [AdminController::class, 'AdminIndex']);
Route::get('/addTerpi', [AddTerpiController::class, 'IndexAddTerpi']);
Route::get('/addGrupas', [AddGrupasController::class, 'IndexAddGrupas']);
Route::get('/viewLietotaji', [ViewLietotajiController::class, 'ViewLietotajiIndex']);
Route::get('/viewGrupas', [ViewGrupasController::class, 'ViewGrupasIndex']);
Route::get('/viewTerpi', [ViewTerpiController::class, 'ViewTerpiIndex']);
Route::get('/redigetLietotajus{personasKods}', [ViewLietotajiController::class, 'LietotajiRedigetIndex']);
Route::get('/redigetGrupas{GrupasNosaukums}', [ViewGrupasController::class, 'GrupasRedigetIndex']);
Route::get('/redigetTerpi{KostimiID}', [ViewTerpiController::class, 'TerpiRedigetIndex']);
Route::get('/dzestLietotajus{personasKods}', [DeleteLietotajiController::class, 'DeleteLietotajiIndex'] );
Route::get('/deleteLietotajiData{personasKods}', [DeleteLietotajiController::class, 'DeleteLietotajiData']);
Route::get('/dzestGrupas{GrupasNosaukums}', [DeleteGrupasController::class, 'DeleteGrupasIndex'] );
Route::get('/deleteGrupasData{GrupasNosaukums}', [DeleteGrupasController::class, 'DeleteGrupasData']);
Route::get('/dzestTerpus{KostimiID}', [DeleteTerpiController::class, 'DeleteTerpiIndex'] );
Route::get('/deleteTerpiData{KostimiID}', [DeleteTerpiController::class, 'DeleteTerpiData']);
Route::get('/audzekniGrupas{GrupasNosaukums}', [AudzekniGrupasController::class, 'AudzekniGrupasIndex'] );
Route::get('/pievAudzAudzekniGrupas{GrupasNosaukums}', [AudzekniGrupasController::class, 'PievAudzAudzekniGrupasIndex'] );
Route::get('/dataInsertAudzekniGrupas{GrupasNosaukums}/{personasKods}', [AudzekniGrupasController::class, 'AudzekniGrupasDataInsert']);
Route::get('/dataDeleteAudzekniGrupas{GrupasNosaukums}/{personasKods}', [AudzekniGrupasController::class, 'AudzekniGrupasDataDelete']);
Route::get('/pievPedPedagogiGrupas{GrupasNosaukums}', [PedagogiGrupasController::class, 'PievPedPedagogiGrupasIndex'] );
Route::get('/dataDeletePedagogiGrupas{GrupasNosaukums}/{personasKods}', [PedagogiGrupasController::class, 'PedagogiGrupasDataDelete']);
Route::get('/iedalitTerpi{KostimiID}', [AudzekniKostimiController::class, 'AudzekniKostimiIndex']);
Route::get('/dataInsertAudzekniKostimi{KostimiID}/{personasKods}', [AudzekniKostimiController::class, 'AudzekniKostimiDataInsert']);
Route::get('/savaktTerpi{KostimiID}', [AudzekniKostimiController::class, 'AudzekniKostimiSavaktIndex']);
Route::get('/dataDeleteAudzekniKostimi{KostimiID}/{personasKods}', [AudzekniKostimiController::class, 'AudzekniKostimiDataDelete']);
Route::get('/iedalitGrupai{KostimiID}', [AudzekniKostimiController::class, 'AudzekniKostimiGrupaIndex']);
Route::get('/dataInsertGrupasKostimi/{KostimiID}/{GrupasAudzeknaNosaukums}', [AudzekniKostimiController::class, 'GrupasKostimiDataInsert']);
Route::get('/login', [LoginController::class, 'LoginIndex']);
Route::get('/audzeknis{personasKods}', [LoginController::class, 'AudzeknisIndex']);
Route::get('/vecaks{personasKods}', [LoginController::class, 'VecaksIndex']);
Route::get('/pedagogs{personasKods}', [LoginController::class, 'PedagogsIndex']);
Route::get('/searchTerpi', [ViewTerpiController::class, 'SearchTerpi']);



Route::post('/dataInsert', [AdminController::class, 'UserDataInsert']);
Route::post('/dataInsertTerpi', [AddTerpiController::class, 'TerpiDataInsert']);
Route::post('/dataInsertGrupas', [AddGrupasController::class, 'GrupasDataInsert']);
Route::post('/dataUpdateLietotaji{personasKods}', [ViewLietotajiController::class, 'DataUpdateLietotaji']);
Route::post('/dataUpdateGrupas{GrupasNosaukums}', [ViewGrupasController::class, 'DataUpdateGrupas']);
Route::post('/dataUpdateTerpi{KostimiID}', [ViewTerpiController::class, 'DataUpdateTerpi']);
Route::post('/dataInsertPedagogiGrupas{GrupasNosaukums}', [PedagogiGrupasController::class, 'PedagogiGrupasDataInsert']);
Route::post('/loginPost', [LoginController::class, 'LoginPost']);

Route::get('/printAudzekniGrupas/{GrupasNosaukums}', [AudzekniGrupasController::class, 'AudzekniGrupasDataPrint'])->name('print.audzekni.grupas');

Route::get('/numurs', [NumursController::class, 'index'])->name('numurs.index');
Route::get('/numurs/create', [NumursController::class, 'create'])->name('numurs.create');
Route::post('/numurs', [NumursController::class, 'store'])->name('numurs.store');
Route::get('/numurs/{numur}/edit', [NumursController::class, 'edit'])->name('numurs.edit');
Route::put('/numurs/{numur}', [NumursController::class, 'update'])->name('numurs.update');
Route::delete('/numurs/{numur}', [NumursController::class, 'destroy'])->name('numurs.destroy');

Route::get('/printTerpi', [ViewTerpiController::class, 'PrintTerpi'])->name('terpi.print');
Route::get('/printAudzeknis/{personasKods}', [ViewLietotajiController::class, 'printAudzeknis'])->name('print.audzeknis');

