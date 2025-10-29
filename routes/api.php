<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Manajer\AdminController;
use App\Http\Controllers\Manajer\ManajerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    Route::get('admin', [AdminController::class, 'index']);
    Route::get('admin/{id}', [AdminController::class, 'show']);  // Untuk detail
    Route::post('admin', [AdminController::class, 'store']);  // Ubah dari 'admin/store' jadi 'admin'
    Route::put('admin/{id}', [AdminController::class, 'update']);
    Route::put('admin/{id}/password', [AdminController::class, 'updatePassword']);
    Route::delete('admin/{id}', [AdminController::class, 'destroy']);


    Route::post('manajer', [ManajerController::class, 'store']);
    Route::put('manajer/{id}', [ManajerController::class, 'update']);
    Route::put('manajer/{id}/password', [ManajerController::class, 'updatePassword']);
    Route::delete('manajer/{id}', [ManajerController::class, 'destroy']);

