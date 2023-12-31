<?php

namespace App\Http\Controllers\Website;

use App\Models\Pengaduan;
use App\Models\User;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TanggapanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $data = Tanggapan::with('petugas')->get();
        } else {
            $idPetugas = $user->id;
            $data = Tanggapan::with('petugas')->where('id_petugas', $idPetugas)->get();
        }

        return view('tanggapan', compact('data'));
    }
    public function create($id)
    {
        // Mengirimkan ID pengaduan ke halaman form tanggapan
        return view('form-tanggapan', ['id_pengaduan' => $id]);
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_pengaduan' => 'required|numeric',
            'tanggapan' => 'required|string',
        ]);

        // Mengambil ID petugas dari pengguna yang login
        $idPetugas = auth()->id();

        // Menambahkan ID petugas ke dalam data yang akan disimpan
        $validatedData['id_petugas'] = $idPetugas;

        // Simpan data tanggapan ke dalam database
        $tanggapan = Tanggapan::create($validatedData);

        // Ubah status pengaduan menjadi "selesai"
        $pengaduan = Pengaduan::find($validatedData['id_pengaduan']);
        $pengaduan->status = 'selesai';
        $pengaduan->save();

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('home')
            ->with('success', 'Tanggapan berhasil disimpan.');
    }
}
