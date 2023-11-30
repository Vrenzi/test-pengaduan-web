<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'id_tanggapan', 'id');
    }

    protected $fillable = [
        'id',
        'id_pengaduan',
        'tanggapan',
        'id_petugas',
    ];
}
