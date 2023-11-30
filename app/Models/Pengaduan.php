<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_pengaduan', 'id');
    }

    protected $fillable = [
        'nik',
        'tgl_pengaduan',
        'isi_laporan',
        'kategori',
        'foto',
        'status',
    ];
}
