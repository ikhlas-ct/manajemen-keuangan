<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Manajer\AdminController;
use App\Http\Controllers\Manajer\ManajerController;
use App\Http\Controllers\Admin\Transaksi\PengeluaranController;

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



Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login_post'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/manajer-dashboard', [DashboardController::class, 'index'])->name('manajer.dashboard');
Route::get('/home', [DashboardController::class, 'index'])->name('home');



Route::get('/manajer/admin',[AdminController::class,'index'])->name('manajer.admin.index');
Route::get('/manajer/admin/data',[AdminController::class,'data'])->name('manajer.admin.data');
Route::post('/manajer/admin',[AdminController::class,'store'])->name('manajer.admin.store');
Route::get('/manajer/admin/{id}/edit',[AdminController::class,'edit'])->name('manajer.admin.edit');
Route::put('/manajer/admin/{id}',[AdminController::class,'update'])->name('manajer.admin.update');
Route::delete('/manajer/admin/{id}',[AdminController::class,'destroy'])->name('manajer.admin.destroy');


// ========================================= Manajer Routes ========================================= //
Route::get('/manajer/manajer',[ManajerController::class,'index'])->name('manajer.manajer.index');
Route::get('/manajer/data',[ManajerController::class,'data'])->name('manajer.data');
Route::post('manajer/manajer', [ManajerController::class, 'store'])->name('manajer.manajer.store');
Route::put('manajer/manajer/{id}', [ManajerController::class, 'update'])->name('manajer.manajer.update');
Route::get('manajer/manajer/{id}', [ManajerController::class, 'edit'])->name('manajer.manajer.edit');
Route::put('manajer/manajer/{id}/password', [ManajerController::class, 'updatePassword'])->name('manajer.manajer.update-password');
Route::delete('manajer/manajer/{id}', [ManajerController::class, 'destroy'])->name('manajer.manajer.destroy');



// ========================================= Categorie Routes ========================================= //
Route::get('/categories', [CategorieController::class, 'index'])->name('manajer.categories.index');
Route::post('/categories', [CategorieController::class, 'store'])->name('manajer.categories.store');
Route::get('/categories/{id}/edit', [CategorieController::class, 'edit'])->name('manajer.categories.edit');
Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('manajer.categories.update');
Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('manajer.categories.destroy');



// ======================================== Pengeluaran Keuangan Route ========================================= //
Route::get('/pengeluaran-keuangan',[PengeluaranController::class,'index'])->name('admin.transaksi.pengeluaran.index');
Route::get('/pengeluaran-keuangan-summary',[PengeluaranController::class,'summary'])->name('admin.transaksi.pengeluaran.summary');
Route::get('/pengeluaran-keuangan/data',[PengeluaranController::class,'data'])->name('admin.transaksi.pengeluaran.data');
Route::post('/pengeluaran-keuangan',[PengeluaranController::class,'store'])->name('admin.transaksi.pengeluaran.store');
Route::put('/pengeluaran-keuangan/{id}', [PengeluaranController::class, 'update'])->name('admin.transaksi.pengeluaran.update');
Route::get('/pengeluaran-keuangan/{id}', [PengeluaranController::class, 'edit'])->name('admin.transaksi.pengeluaran.edit');
Route::delete('/pengeluaran-keuangan/{id}', [PengeluaranController::class, 'destroy'])->name('admin.transaksi.pengeluaran.destroy');
