<?php

use App\Models\Pengaduan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Website\PetugasController;
use App\Http\Controllers\Website\PengaduanController;
use App\Http\Controllers\Website\TanggapanController;
use App\Http\Controllers\Website\MasyarakatController;
use App\Http\Controllers\Auth\RegisteredUserController;


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

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware(['auth', 'verified'])->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])->middleware(['auth', 'verified']);
// Route::get('/edit-petugas/{id}', [RegisteredUserController::class, 'edit'])->middleware(['auth', 'verified'])->name('edit.petugas');
// Route::post('/delete-petugas/{id}', [RegisteredUserController::class, 'delete'])->middleware(['auth', 'verified'])->name('delete.petugas');

Route::get('/home', function () {
    $data = Pengaduan::all();
    return view('dashboard', ['data' => $data]); // Mengirimkan data ke view 'dashboard'
})->middleware(['auth', 'verified'])->name('home');

Route::get('/tanggapan', [TanggapanController::class, 'index'])->middleware(['auth', 'verified'])->name('tanggapan');
Route::post('/tanggapan', [TanggapanController::class, 'store'])->middleware(['auth', 'verified'])->name('tanggapan.store');
Route::get('/export', [PengaduanController::class, 'exportToPdf']);
Route::get('/tanggapan/create/{id}', [TanggapanController::class, 'create'])->middleware(['auth', 'verified'])->name('tanggapan.create');
Route::post('/proses-pengaduan/{id}', [TanggapanController::class, 'prosespengaduan'])->name('proses.pengaduan');

Route::get('/masyarakat', [MasyarakatController::class, 'index'])->middleware(['auth', 'verified'])->name('masyarakat');
Route::get('/petugas', [PetugasController::class, 'index'])->middleware(['auth', 'verified'])->name('petugas');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
