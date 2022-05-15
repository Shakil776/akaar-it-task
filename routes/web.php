<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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

// home route
Route::get('/', [CustomerController::class, 'index'])->name('index');

// import csv file records
Route::match(['get', 'post'], 'import', [CustomerController::class, 'import_csv_data'])->name('import');

// stored procedure
Route::match(['get', 'post'], 'call-procedure', [CustomerController::class, 'call_procedure'])->name('call-procedure');

// task 2 file transfer
Route::match(['get', 'post'], 'file-transfer', [CustomerController::class, 'file_transfer'])->name('file-transfer');
