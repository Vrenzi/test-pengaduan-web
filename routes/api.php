<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PengaduanController;
use App\Http\Controllers\API\MasyarakatController;

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


Route::get('pengaduan', [PengaduanController::class, 'index']);
Route::get('pengaduan/{nik}', [PengaduanController::class, 'getByNik']);
Route::post('pengaduan', [PengaduanController::class, 'store']);
Route::put('pengaduan/edit/{id}', [PengaduanController::class, 'update']);
Route::get('image/{nik}', [PengaduanController::class, 'sendImage']);
Route::delete('pengaduan/delete/{id}', [PengaduanController::class, 'destroy']);
Route::delete('masyarakat/delete/{id}', [MasyarakatController::class, 'destroy']);
Route::get('masyarakat', [MasyarakatController::class, 'index']);
Route::post('register', [MasyarakatController::class, 'register']);
Route::post('login', [MasyarakatController::class, 'login']);
Route::post('logout', [MasyarakatController::class, 'logout'])->middleware('auth:sanctum');
Route::put('masyarakat/edit/{id}', [MasyarakatController::class, 'update']);
Route::get('masyarakat/{id}', [MasyarakatController::class, 'getById']);
