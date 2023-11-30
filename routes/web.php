<?php

use App\Models\Pengaduan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Website\PengaduanController;
use App\Http\Controllers\Website\TanggapanController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    $data = Pengaduan::all();
    return view('dashboard', ['data' => $data]); // Mengirimkan data ke view 'dashboard'
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tanggapan', [TanggapanController::class, 'index'])->middleware(['auth', 'verified'])->name('tanggapan');
Route::post('/tanggapan', [TanggapanController::class, 'store'])->middleware(['auth', 'verified'])->name('tanggapan.store');
Route::get('/tanggapan/create/{id}', [TanggapanController::class, 'create'])->middleware(['auth', 'verified'])->name('tanggapan.create');
Route::post('/proses-pengaduan/{id}', [TanggapanController::class, 'prosespengaduan'])->name('proses.pengaduan');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
