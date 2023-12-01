<?php

namespace App\Http\Controllers\Website;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengaduanController extends Controller
{
    public function index()
    {
        $data = Pengaduan::all();
        return view('dashboard', ['data' => $data]);
    }

    public function exportToPdf()
    {
        $pengaduans = Pengaduan::all();
        $data = ['pengaduans' => $pengaduans];
        $pdf = pdf::loadView('pdf', $data);
        return $pdf->download('pengaduan_report_all.pdf');
    }
}
