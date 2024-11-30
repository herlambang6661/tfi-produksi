<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\_01_Datatables\Daftar\TipeList;
use App\Http\Controllers\_01_Datatables\Daftar\JenisList;
use App\Http\Controllers\_01_Datatables\Daftar\WarnaList;
use App\Http\Controllers\_01_Datatables\Settings\LogList;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\_01_Datatables\Daftar\TipeSubList;
use App\Http\Controllers\_01_Datatables\Daftar\SupplierList;
use App\Http\Controllers\_01_Datatables\Gudang\PenerimaanQR;
use App\Http\Controllers\_01_Datatables\Kontrak\KontrakList;
use App\Http\Controllers\_01_Datatables\Gudang\PenerimaanList;
use App\Http\Controllers\_01_Datatables\Gudang\PengolahanList;
use App\Http\Controllers\_01_Datatables\Gudang\ScanBarcodeList;
use App\Http\Controllers\_01_Datatables\Produksi\PengebonanList;
use App\Http\Controllers\_01_Datatables\Kontrak\SuratkontrakList;
use App\Http\Controllers\_01_Datatables\Produksi\PengebonanQR;

// Route::get('/', function () {
//     if (Auth::check()) {
//         return view('products.dashboard', [
//             'active' => 'Dashboard',
//             'judul' => 'Dashboard',
//         ]);
//     } else {
//         return view('login');
//     }
// });
Route::get('/', function () {
    return view('login');
})->name('login');

Route::resource('getTipe', TipeList::class);
Route::resource('getWarna', WarnaList::class);
Route::resource('getSupplier', SupplierList::class);
Route::resource('getSuratkontrak', SuratkontrakList::class);
Route::resource('getKontrak', KontrakList::class);
Route::resource('getPenerimaan', PenerimaanList::class);
Route::resource('getPenerimaanQR', PenerimaanQR::class);
Route::resource('getPengolahan', PengolahanList::class);
Route::resource('getPengebonan', PengebonanList::class);
Route::resource('getScanner', ScanBarcodeList::class);
Route::resource('getJenis', JenisList::class)->middleware('log.activity');
Route::resource('getTipeSub', TipeSubList::class);
Route::resource('getLogActivity', LogList::class);
Route::resource('getResultPengebonan', PengebonanQR::class);

Route::controller(AuthController::class)->group(function () {
    Route::post('post-login', 'postLogin')->name('login.post')->middleware('log.activity');
    Route::post('/update-location', 'updateLocation')->name('update.location');
    Route::get('logout', 'logout')->name('logout');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard']);

Route::controller(DaftarController::class)->group(function () {
    Route::get('daftar/tipe', 'tipe')->name('daftar/tipe');
    Route::get('daftar/supplier', 'supplier')->name('daftar/supplier');
    Route::post('storedataTipe', 'storeTipe')->name('storedataTipe')->middleware('log.activity');
    Route::post('storedataEditTipe', 'storeEditTipe')->name('storedataEditTipe')->middleware('log.activity');
    Route::post('storedataEditWarna', 'storeEditWarna')->name('storedataEditWarna')->middleware('log.activity');
    Route::post('storedataEdittipeSub', 'storeEditTipeSub')->name('storedataEdittipeSub')->middleware('log.activity');
    Route::post('viewdataEditjenis', 'viewEditJenis')->name('viewdataEditJenis')->middleware('log.activity');
    Route::post('storeEditjenis', 'storeEditJenis')->name('storeEditJenis')->middleware('log.activity');
    Route::post('storedataEditSupplier', 'storeEditSupplier')->name('storedataEditSupplier')->middleware('log.activity');
    Route::post('updatedataSupplier/{id}', 'updateSupplier')->name('Updatedatasupplier')->middleware('log.activity');
    Route::post('storedataWarna', 'storeWarna')->name('storedataWarna')->middleware('log.activity');
    Route::post('storedataTipesub', 'storeTipesub')->name('storedataTipesub')->middleware('log.activity');
    Route::post('storedataSupplier', 'storeSupplier')->name('storedataSupplier')->middleware('log.activity');
    Route::post('storejenis', 'storeJenis')->name('store.jenis')->middleware('log.activity');
    Route::get('getkodetipe', 'getkodetipe')->name('getkodetipe');
    Route::post('viewEdittipe', 'viewEdittipe')->name('viewEdittipe')->middleware('log.activity');
    Route::post('viewEditwarna', 'viewEditwarna')->name('viewEditwarna')->middleware('log.activity');
    Route::post('viewEdittipeSub', 'viewEditTipeSub')->name('viewEdittipeSub')->middleware('log.activity');
    Route::post('viewEditsupplier', 'viewEditsupplier')->name('viewEditsupplier')->middleware('log.activity');
    Route::post('daftar/add/daftar', 'viewAddDaftar')->name('daftar.add')->middleware('log.activity');
});

Route::controller(KontrakController::class)->group(function () {
    Route::get('kontrak/suratkontrak', 'suratKontrak')->name('kontrak/suratkontrak');
    Route::get('kontrak/suratkontrak/tambah', 'suratKontrakAdd')->name('kontrakAdd');
    Route::post('storedataSuratkontrak', 'store')->name('storedataSuratkontrak')->middleware('log.activity');
    Route::post('kontrak/getWarnaByTipe', 'getWarnaByTipe')->name('kontrak/getWarnaByTipe');
    Route::get('kontrak/getKategori', 'getKategori')->name('getKT');
    Route::get('kontrak/getBahanBahu', 'getBahanBaku')->name('getBB');
    Route::get('kontrak/getWarna', 'getWarna')->name('getWR');
    Route::get('getsupplierKontrak', 'getsupplierKontrak')->name('getsupplierKontrak');
    Route::post('viewKontrak', 'detailKontrak')->name('detail.kontrak')->middleware('log.activity');
    Route::get('getPengemudi', 'getPengemudi')->name('getPengemudi');
    Route::get('/get-pdf', 'getPDF')->name('download.pdf');
    Route::post('kontrak/printSuratKontrak', 'printSuratKontrak')->name('kontrak/printSuratKontrak');
});
Route::controller(GudangController::class)->group(function () {
    Route::post('checkPenerimaan', 'checkPenerimaan')->name('checkPenerimaan');
    Route::get('gudang/penerimaan', 'penerimaan')->name('gudang/penerimaan');
    Route::get('getkodeKontrak', 'getkodeKontrak')->name('getkodeKontrak');
    Route::get('getjeniss', 'getJeniss')->name('getjeniss');
    Route::post('gudang/getTipeByKode', 'getTipeByKode')->name('gudang/getTipeByKode');
    Route::post('storedataPenerimaan', 'storePenerimaan')->name('storedataPenerimaan')->middleware('log.activity');
    Route::get('/gudang/penerimaan/verifikasi/{id}', 'verifikasi')->name('/gudang/penerimaan/verifikasi/{id}')->middleware('log.activity');
    Route::get('/gudang/penerimaan/printQrcode/{id}', 'printQrcode')->name('/gudang/penerimaan/printQrcode/{id}')->middleware('log.activity');
    Route::post('getSupir', 'getSupir')->name('getSupir');
    Route::post('storedataVerifikasi', 'storeVerifikasi')->name('storedataVerifikasi')->middleware('log.activity');
    Route::post('gudang/printPenerimaan', 'printPenerimaan')->name('gudang/printPenerimaan');
    Route::get('gudang/printBarcode/{id}', 'printBarcode')->name('gudang/printBarcode/{id}')->middleware('log.activity');
    Route::post('/getLastKendaraanKe', 'getLastKendaraanKe')->name('getLastKendaraanKe');
    Route::post('gudang/batal/proses', 'cancelOrder')->name('gudang.cancelOrder');
    Route::get('getPackage', 'getPackage')->name('getPackage');
    Route::POST('getdriver', 'getdriver')->name('getdriver');
    Route::POST('getDecryptKode', 'getDecryptKode')->name('getDecryptKode');
    Route::post('detail/penerimaan', 'detailPenerimaan')->name('detail.penerimaan');
    Route::POST('checkPrintQR', 'checkPrintQR')->name('checkPrintQR');
    //Scanner
    Route::get('gudang/scanner', 'scanner')->name('gudang.scanner');
    Route::get('gudang/pengolahan', 'pengolahan')->name('gudang/pengolahan');
    Route::post('storedataPengolahan', 'storePengolahan')->name('storedataPengolahan');
    Route::get('gudang/pengolahan/proses/{id}', 'prosesPengolahan')->name('gudang/pengolahan/proses/{id}');
    Route::post('storedataFixPengolahan', 'storeFixPengolahan')->name('storedataFixPengolahan');
});
Route::controller(ProduksiController::class)->group(function () {
    Route::get('produksi/pengebonan', 'pengebonan')->name('produksi.pengebonan');
    Route::POST('produksi/getDecryptBon', 'getDecryptKode')->name('getDecryptKode.decrypt');
    Route::post('Produksi/pengebonan/listItemPengebonan', 'filterItem')->name('pengebonan.getItemPengebonan');
    Route::post('storedataPengebonan', 'storedataPengebonan')->name('Produksi/pengebonan/store');
    Route::post('produksi/pengebonan/detail', 'detailPengebonan')->name('detail.pengebonan');
    Route::delete('produksi/pengebonan/deleteForm', 'deletePengebonan')->name('delete.formPengebonan');
    Route::delete('produksi/pengebonan/deleteExist', 'deletePengebonanExists')->name('delete.deleteExist');
    Route::get('produksi/pengebonan/edit/{id}', 'editPengebonan')->name('produksi/pengebonan/edit/{id}');
    Route::post('storedataEditPengebonan', 'storedataEditPengebonan')->name('Produksi/pengebonan/edit');
});
Route::controller(SettingsController::class)->group(function () {
    Route::get('settings/pengguna', 'pengguna')->name('setting.pengguna');
    Route::post('settings/store', 'store')->name('setting.store')->middleware('log.activity');
    Route::put('settings/update/{id}', 'update')->name('setting.update')->middleware('log.activity');
    Route::post('settings/reset/update/{id}', 'reset')->name('settings.reset')->middleware('log.activity');
    Route::delete('settings/destroy/{id}', 'destroy')->middleware('log.activity');
    Route::get('settings/logActivity', 'logActivity');
    Route::post('settings/viewLog', 'viewLog')->name('view.log');
});
