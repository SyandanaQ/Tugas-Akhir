<?php

use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\ManajemenPenjualanController;
use App\Admin\Controllers\ARIMAController;
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
Route::get('/admin/sales-forecast', [ARIMAController::class, 'forecast']);
Route::get('/admin/sales-chart', [ManajemenPenjualanController::class, 'chartData']);
Route::get('/', function () {
    return view('welcome');
});
