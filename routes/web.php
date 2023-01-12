<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataKtpController;
use App\Http\Controllers\DataRiwayatController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Pendaftaran;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'admin'],function(){

    Route::get('admin', [HomeController::class, 'index'])->name('home.admin');

    Route::prefix('ktp')->group(function(){
        Route::get('/', [DataKtpController::class, 'index']);
        Route::post('import', [DataKtpController::class, 'importCSV'])->name('ktp.exportcsv');
        Route::get('exp-csv', [DataKtpController::class, 'exportCSV'])->name('ktp.exportcsv');
        Route::get('exp-excel', [DataKtpController::class, 'exportExcel'])->name('ktp.exportexcel');
        Route::get('print-pdf', [DataKtpController::class, 'printPDF'])->name('ktp.printpdf');
        Route::get('create', [DataKtpController::class, 'create']);
        Route::post('create', [DataKtpController::class, 'store']);
        Route::get('edit/{id}', [DataKtpController::class, 'edit']);
        Route::get('show/{id}', [DataKtpController::class, 'show']);
        Route::post('edit/{id}', [DataKtpController::class, 'update']);
        Route::get('delete/{id}', [DataKtpController::class, 'destroy']);
    });

    Route::prefix('riwayat')->group(function(){
        Route::get('/', [DataRiwayatController::class, 'index']);
        Route::get('delete/{id}', [DataRiwayatController::class, 'delete']);
    });

});

Route::group(['middleware' => 'user'],function(){

    Route::get('user', [HomeController::class, 'index'])->name('home.user');

    Route::prefix('ktp2')->group(function(){
        Route::get('/', [DataKtpController::class, 'index']);
        Route::get('exp-csv2', [DataKtpController::class, 'exportCSV'])->name('ktp2.exportcsv2');
        Route::get('exp-excel', [DataKtpController::class, 'exportExcel'])->name('ktp2.exportexcel');
        Route::get('print-pdf2', [DataKtpController::class, 'printPDF'])->name('ktp2.printpdf2');
        Route::get('show/{id}', [DataKtpController::class, 'show']);
    });

});