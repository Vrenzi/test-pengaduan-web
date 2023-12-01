<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        // Periksa apakah pengguna yang mencoba mengakses halaman pendaftaran adalah admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('auth.register');
        } else {
            // Pengguna bukan admin, alihkan ke halaman yang sesuai atau beri pesan kesalahan
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        // Redirect kembali ke halaman sebelumnya
        return redirect()->back();
    }

    public function edit($id)
    {
        // Cek apakah pengguna yang sedang login adalah admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            // Logika untuk mengambil data petugas berdasarkan ID dan menampilkan form edit
            $petugas = User::find($id);
            return view('edit_petugas', ['petugas' => $petugas]);
        } else {
            // Pengguna bukan admin, kembalikan ke halaman lain atau tampilkan pesan kesalahan
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }

    // Fungsi untuk menghapus petugas
    public function delete($id)
    {
        // Cek apakah pengguna yang sedang login adalah admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            // Logika untuk menghapus petugas berdasarkan ID
            User::destroy($id);
            // Redirect ke halaman lain atau tampilkan pesan sukses
            return redirect()->route('petugas')->with('success', 'Petugas berhasil dihapus.');
        } else {
            // Pengguna bukan admin, kembalikan ke halaman lain atau tampilkan pesan kesalahan
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }
}
