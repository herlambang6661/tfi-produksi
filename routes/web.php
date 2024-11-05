<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\_01_Datatables\Daftar\TipeList;
use App\Http\Controllers\_01_Datatables\Daftar\JenisList;
use App\Http\Controllers\_01_Datatables\Daftar\WarnaList;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\_01_Datatables\Daftar\TipeSubList;
use App\Http\Controllers\_01_Datatables\Daftar\SupplierList;
use App\Http\Controllers\_01_Datatables\Kontrak\KontrakList;
use App\Http\Controllers\_01_Datatables\Gudang\PenerimaanList;
use App\Http\Controllers\_01_Datatables\Gudang\ScanBarcodeList;
use App\Http\Controllers\_01_Datatables\Kontrak\SuratkontrakList;

Route::get('/', function () {
    if (Auth::check()) {
        return view('products.dashboard', [
            'active' => 'Dashboard',
            'judul' => 'Dashboard',
        ]);
    } else {
        return view('login');
    }
});
Route::get('login', function () {
    return view('login');
})->name('login');

Route::resource('getTipe', TipeList::class);
Route::resource('getWarna', WarnaList::class);
Route::resource('getSupplier', SupplierList::class);
Route::resource('getSuratkontrak', SuratkontrakList::class);
Route::resource('getKontrak', KontrakList::class);
Route::resource('getPenerimaan', PenerimaanList::class);
Route::resource('getScanner', ScanBarcodeList::class);
Route::resource('getJenis', JenisList::class);
Route::resource('getTipeSub', TipeSubList::class);

Route::controller(AuthController::class)->group(function () {
    Route::post('post-login', 'postLogin')->name('login.post');
});
Route::get('dashboard', [DashboardController::class, 'dashboard']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::controller(DaftarController::class)->group(function () {
    Route::get('daftar/tipe', 'tipe')->name('daftar/tipe');
    Route::get('daftar/supplier', 'supplier')->name('daftar/supplier');
    Route::post('storedataTipe', 'storeTipe')->name('storedataTipe');
    Route::post('storedataEditTipe', 'storeEditTipe')->name('storedataEditTipe');
    Route::post('storedataEditWarna', 'storeEditWarna')->name('storedataEditWarna');
    Route::post('storedataEdittipeSub', 'storeEditTipeSub')->name('storedataEdittipeSub');
    Route::post('viewdataEditjenis', 'viewEditJenis')->name('viewdataEditJenis');
    Route::post('storeEditjenis', 'storeEditJenis')->name('storeEditJenis');
    Route::post('storedataEditSupplier', 'storeEditSupplier')->name('storedataEditSupplier');
    Route::post('updatedataSupplier/{id}', 'updateSupplier')->name('Updatedatasupplier');
    Route::post('storedataWarna', 'storeWarna')->name('storedataWarna');
    Route::post('storedataTipesub', 'storeTipesub')->name('storedataTipesub');
    Route::post('storedataSupplier', 'storeSupplier')->name('storedataSupplier');
    Route::post('storejenis', 'storeJenis')->name('store.jenis');
    Route::get('getkodetipe', 'getkodetipe')->name('getkodetipe');
    Route::post('viewEdittipe', 'viewEdittipe')->name('viewEdittipe');
    Route::post('viewEditwarna', 'viewEditwarna')->name('viewEditwarna');
    Route::post('viewEdittipeSub', 'viewEditTipeSub')->name('viewEdittipeSub');
    Route::post('viewEditsupplier', 'viewEditsupplier')->name('viewEditsupplier');
});

Route::controller(KontrakController::class)->group(function () {
    Route::get('kontrak/suratkontrak', 'suratKontrak')->name('kontrak/suratkontrak');
    Route::get('kontrak/suratkontrak/tambah', 'suratKontrakAdd')->name('kontrakAdd');
    Route::post('storedataSuratkontrak', 'store')->name('storedataSuratkontrak');
    Route::post('kontrak/getWarnaByTipe', 'getWarnaByTipe')->name('kontrak/getWarnaByTipe');
    Route::get('kontrak/getKategori', 'getKategori')->name('getKT');
    Route::get('kontrak/getBahanBahu', 'getBahanBaku')->name('getBB');
    Route::get('kontrak/getWarna', 'getWarna')->name('getWR');
    Route::get('getsupplierKontrak', 'getsupplierKontrak')->name('getsupplierKontrak');
    Route::post('viewKontrak', 'detailKontrak')->name('detail.kontrak');
    Route::get('getPengemudi', 'getPengemudi')->name('getPengemudi');
});
Route::controller(GudangController::class)->group(function () {
    Route::post('checkPenerimaan', 'checkPenerimaan')->name('checkPenerimaan');
    Route::get('gudang/penerimaan', 'penerimaan')->name('gudang/penerimaan');
    Route::get('getkodeKontrak', 'getkodeKontrak')->name('getkodeKontrak');
    Route::get('getjeniss', 'getJeniss')->name('getjeniss');
    Route::post('gudang/getTipeByKode', 'getTipeByKode')->name('gudang/getTipeByKode');
    Route::post('storedataPenerimaan', 'storePenerimaan')->name('storedataPenerimaan');
    Route::get('/gudang/penerimaan/verifikasi/{id}', 'verifikasi')->name('/gudang/penerimaan/verifikasi/{id}');
    Route::post('getSupir', 'getSupir')->name('getSupir');
    Route::post('storedataVerifikasi', 'storeVerifikasi')->name('storedataVerifikasi');
    Route::post('gudang/printPenerimaan', 'printPenerimaan')->name('gudang/printPenerimaan');
    Route::post('gudang/printBarcode', 'printBarcode')->name('gudang/printBarcode');
    Route::post('/getLastKendaraanKe', 'getLastKendaraanKe')->name('getLastKendaraanKe');
    Route::post('gudang/batal/proses', 'cancelOrder')->name('gudang.cancelOrder');

    //Scanner
    Route::get('gudang/scanner', 'scanner')->name('gudang.scanner');
});
