<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\_01_Datatables\Daftar\TipeList;
use App\Http\Controllers\_01_Datatables\Daftar\WarnaList;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\_01_Datatables\Daftar\SupplierList;

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
    Route::post('storedataEditSupplier', 'storeEditSupplier')->name('storedataEditSupplier');
    Route::post('storedataWarna', 'storeWarna')->name('storedataWarna');
    Route::post('storedataSupplier', 'storeSupplier')->name('storedataSupplier');
    Route::get('getkodetipe', 'getkodetipe')->name('getkodetipe');
    Route::post('viewEdittipe', 'viewEdittipe')->name('viewEdittipe');
    Route::post('viewEditwarna', 'viewEditwarna')->name('viewEditwarna');
    Route::post('viewEditsupplier', 'viewEditsupplier')->name('viewEditsupplier');
});

Route::controller(KontrakController::class)->group(function () {
    Route::get('kontrak/suratkontrak', 'suratKontrak')->name('kontrak/suratkontrak');
    Route::post('storedataSuratkontrak', 'store')->name('storedataSuratkontrak');
});
