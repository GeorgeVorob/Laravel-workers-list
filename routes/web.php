<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;
use App\UseCases\WorkersCases;
use App\UseCases\SpecsCases;

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

Route::resource('workers', WorkerController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);



Route::get('/', function () {
    return view('workers.index', [
        'workers' => WorkersCases::GetWorkers(),
        'specs' => SpecsCases::GetSpecs()
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
