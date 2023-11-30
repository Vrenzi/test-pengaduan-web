<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tanggapan') }}
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
                                <th style="padding: 8px; text-align: center;">ID Pengaduan</th>
                                <th style="padding: 8px; text-align: center;">Tanggal Tanggapan</th>
                                <th style="padding: 8px; text-align: center;">Tanggapan</th>
                                <th style="padding: 8px; text-align: center;">ID Petugas</th>
                                <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                            </tr>
                        </thead>
                        <tbody style="background-color: #7B66FF;">
                            @foreach ($data as $item)
                                    <tr>
                                        <td style="padding: 8px; text-align: center;">{{ $item->id_pengaduan }}</td>
                                        <td style="padding: 8px; text-align: center;">{{ $item->created_at }}</td>
                                        <td style="padding: 8px; text-align: center;">{{ $item->tanggapan }}</td>
                                        <td style="padding: 8px; text-align: center;">{{ $item->id_petugas }}</td>
                                        <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
