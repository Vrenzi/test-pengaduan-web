<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function index()
    {
        $data = Pengaduan::all(); // Mengambil semua data dari model
        return view('nama_view', ['data' => $data]); // Mengirim data ke view
    }
}
