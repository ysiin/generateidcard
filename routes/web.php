<?php

use App\Http\Controllers\datakaryawanController;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\pdfDownloadController;
use Illuminate\Support\Facades\Route;

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


Route::resource('idcard', karyawanController::class);
Route::get('/idcard/{id}/download', [pdfDownloadController::class, 'idcardOpen']);


