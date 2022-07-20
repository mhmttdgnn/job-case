<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

Route::get('/', [Controller::class, 'index']);
Route::get('/loadModels', [Controller::class, 'loadModels'])->name('loadModels');
Route::get('/loadAddresses', [Controller::class, 'loadAddresses'])->name('loadAddresses');
Route::get('/checkDate', [Controller::class, 'checkDate'])->name('checkDate');
Route::post('/repairCreate', [Controller::class, 'repairCreate'])->name('repairCreate');
