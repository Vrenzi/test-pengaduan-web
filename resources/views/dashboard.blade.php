    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Pengaduan') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="text-lg font-semibold mt-4 pb-7 text-center mb-7">Daftar Pengaduan</h2>
                    <div class="p-6 text-red-900 dark:text-red-100">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead style="background-color: #5FBDFF;">
                                <tr>
                                    <th style="padding: 8px; text-align: center;">NIK</th>
                                    <th style="padding: 8px; text-align: center;">Isi Laporan</th>
                                    <th style="padding: 8px; text-align: center;">Tanggal Pengaduan</th>
                                    <th style="padding: 8px; text-align: center;">Foto</th>
                                    <th style="padding: 8px; text-align: center;">Kategori</th>
                                    <th style="padding: 8px; text-align: center;">Tanggapan</th>
                                    <th style="padding: 8px; text-align: center;">Status</th>
                                    <th style="padding: 8px; text-align: center;">Action</th>
                                    <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                                </tr>
                            </thead>
                            <tbody style="background-color: #7B66FF;">
                                @foreach ($data as $item)
                                    @if(auth()->user()->role == 'admin' || auth()->user()->role == $item->kategori)
                                        <tr>
                                            <td style="padding: 8px; text-align: center;">{{ $item->NIK }}</td>
                                            <td style="padding: 8px; text-align: center;">{{ $item->isi_laporan }}</td>
                                            <td style="padding: 8px; text-align: center;">{{ $item->tgl_pengaduan }}</td>
                                            <td class="align-middle">
                                                @if ($item->foto)
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" style="max-width:100px;">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td style="padding: 8px; text-align: center;">{{ $item->kategori }}</td>
                                            <td style="padding: 8px; text-align: center;">
                                                @foreach ($item->tanggapan as $tanggapan)
                                                    {{ $tanggapan->tanggapan }}
                                                    <!-- Jika Anda ingin menampilkan beberapa tanggapan yang terkait dengan pengaduan tertentu -->
                                                @endforeach
                                            </td>
                                            <td style="padding: 8px; text-align: center;">{{ $item->status }}</td>
                                            <td style="padding: 8px; text-align: center;">
                                                @if ($item->status === 'selesai')
                                                    <!-- Jika status pengaduan sudah selesai, tombol dinonaktifkan -->
                                                    <button class="bg-gray-400 text-white font-bold py-2 px-4 rounded cursor-not-allowed" disabled>Tidak dapat ditanggapi</button>
                                                @else
                                                    <!-- Tombol untuk melakukan tanggapan jika status belum selesai -->
                                                    <a href="{{ route('tanggapan.create', $item->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Tanggapi</a>
                                                @endif
                                            </td>
                                            
                                            <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
