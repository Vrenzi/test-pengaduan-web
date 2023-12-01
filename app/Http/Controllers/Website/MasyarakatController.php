<?php

namespace App\Http\Controllers\Website;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MasyarakatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Periksa peran pengguna sebelum menampilkan halaman 'masyarakat'
        if ($user->role !== 'admin') {
            // Jika pengguna bukan admin, redirect ke halaman lain atau tampilkan pesan error
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Jika pengguna adalah admin, izinkan akses ke halaman 'masyarakat'
        $data = Masyarakat::all();
        return view('masyarakat', ['data' => $data]);
    }
}
