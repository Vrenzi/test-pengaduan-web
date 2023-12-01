<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Petugas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="text-lg font-semibold mt-4 pb-7 text-center mb-7">Data Petugas</h2>
                <h2 class="text-lg font-semibold mt-4 pb-7 text-center mb-7"><a href="/register">Tambah Petugas</a></h2>
                <div class="p-6 text-red-900 dark:text-red-100">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead style="background-color: #5FBDFF;">
                            <tr>
                                <th style="padding: 8px; text-align: center;">ID</th>
                                <th style="padding: 8px; text-align: center;">Nama</th>
                                <th style="padding: 8px; text-align: center;">Email</th>
                                <th style="padding: 8px; text-align: center;">Role</th>
                                {{-- <th style="padding: 8px; text-align: center;">Aksi</th> --}}
                                <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                            </tr>
                        </thead>
                        <tbody style="background-color: #7B66FF;">
                            @foreach ($data as $item)
                                    <tr>
                                        <td style="padding: 8px; text-align: center;">{{ $item->id }}</td>
                                        <td style="padding: 8px; text-align: center;">{{ $item->name }}</td>
                                        <td style="padding: 8px; text-align: center;">{{ $item->email }}</td>
                                        <td style="padding: 8px; text-align: center;">{{ $item->role }}</td>
                                        {{-- <td style="padding: 8px; text-align: center;"> --}}
                                            <!-- Tampilkan tombol Edit hanya jika role pengguna adalah admin -->
                                            <!-- Tampilkan tombol Delete hanya jika role pengguna adalah admin -->
                                            {{-- @if(auth()->check() && auth()->user()->role === 'admin')
                                                <a href="{{ route('delete.petugas', ['id' => $item->id]) }}">Delete</a>
                                            @endif --}}
                                        {{-- </td> --}}
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
