<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Manajer\AdminController;

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



Route::prefix('manajer')->group(function () {
    Route::get('admin', [AdminController::class, 'index']);
    Route::get('admin/{id}', [AdminController::class, 'show']);  // Untuk detail
    Route::post('admin', [AdminController::class, 'store']);  // Ubah dari 'admin/store' jadi 'admin'
    Route::put('admin/{id}', [AdminController::class, 'update']);
    Route::post('admin/{id}/password', [AdminController::class, 'updatePassword']);
    Route::delete('admin/{id}', [AdminController::class, 'destroy']);
});
