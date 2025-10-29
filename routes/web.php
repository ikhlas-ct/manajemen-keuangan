<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Transactions\IncomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manajer\AdminController;
use App\Http\Controllers\Manajer\ManajerController;
use App\Http\Controllers\CategorieController;


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
    return view('welcome');
});

Route::get('/testing', function () {
    return view('pages.dashboard');
});


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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('admin.layouts.app');
    })->name('dashboard');
    Route::resource('income', IncomeController::class);
});

require __DIR__.'/auth.php';
