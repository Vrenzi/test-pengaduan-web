<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px; /* Adjust the font size as needed */
    }

    .container {
        max-width: 600px; /* Adjust the max-width as needed */
        margin: 0 auto;
    }

    h2 {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        padding: 8px; /* Adjust the padding as needed */
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    thead {
        background-color: #343a40;
        color: #fff;
    }

    tbody tr:hover {
        background-color: #f5f5f5;
    }

    img {
        max-width: 80px; /* Adjust the max-width as needed */
        height: auto;
    }
</style>
<h2>Laporan Data Pengaduan</h2>
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col" class="align-middle">NIK</th>
            <th scope="col" class="align-middle">Isi Laporan</th>
            <th scope="col" class="align-middle">Tanggal Pengaduan</th>
            <th scope="col" class="align-middle">Kategori</th>
            <th scope="col" class="align-middle">Status</th>
            <th scope="col" class="align-middle">Tanggapan</th>
            <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
        </tr>
    </thead>
    <tbody>
        @foreach ($pengaduans as $pengaduan)
            <tr>
                <td class="align-middle">{{ $pengaduan->nik }}</td>
                <td class="align-middle">{{ $pengaduan->isi_laporan }}</td>
                <td class="align-middle">{{ \Carbon\Carbon::parse($pengaduan->tgl_pengaduan)->format('d, M Y H:i') }}</td>
                <td class="align-middle">{{ $pengaduan->kategori }}</td>
                <td class="align-middle">{{ $pengaduan->status }}</td>
                <td class="align-middle">
                    @foreach ($pengaduan->tanggapan as $tanggapan)
                        {{ $tanggapan->tanggapan }}
                    @endforeach
                </td>
                <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
            </tr>
        @endforeach
    </tbody>
</table>
</div>