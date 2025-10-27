<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manajer\AdminController;
use App\Http\Controllers\Manajer\ManajerController;

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

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/testing', function () {
    return view('pages.dashboard');
});


Route::get('/manajer/admin',[AdminController::class,'index'])->name('manajer.admin.index');
Route::post('/manajer/admin',[AdminController::class,'store'])->name('manajer.admin.store');
Route::get('/manajer/admin/{id}/edit',[AdminController::class,'edit'])->name('manajer.admin.edit');
Route::put('/manajer/admin/{id}',[AdminController::class,'update'])->name('manajer.admin.update');
Route::delete('/manajer/admin/{id}',[AdminController::class,'destroy'])->name('manajer.admin.destroy');


Route::get('/manajer/manajer',[ManajerController::class,'index'])->name('manajer.manajer.index');
Route::post('manajer/manajer', [ManajerController::class, 'store'])->name('manajer.manajer.store');
Route::put('manajer/manajer/{id}', [ManajerController::class, 'update'])->name('manajer.manajer.update');
Route::put('manajer/manajer/{id}/password', [ManajerController::class, 'updatePassword'])->name('manajer.manajer.updatePassword');
Route::delete('manajer/manajer/{id}', [ManajerController::class, 'destroy'])->name('manajer.manajer.destroy');

