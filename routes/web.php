<?php

use App\Http\Controllers\SpecController;
use App\Http\Controllers\WorkerController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('specs', SpecController::class)
    ->only(['index', 'store']);

Route::resource('workers', WorkerController::class)
    ->only(['index', 'store', 'edit', 'update']);
