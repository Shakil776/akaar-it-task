<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\DB;

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


// import csv file records
Route::match(['get', 'post'], '/', [CustomerController::class, 'import_csv_data'])->name('import');

// stored procedure
Route::get('call-procedure', function () {
  
    $gender = 'M';

    $getCount = DB::select('CALL get_count('.$gender.')');

  	return $getCount;
      
});


// task 2
Route::match(['get', 'post'], '/task2', [CustomerController::class, 'task2'])->name('task2');
