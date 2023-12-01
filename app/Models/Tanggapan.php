<?php

namespace App\Models;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tanggapan extends Model
{
    use HasFactory;

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'id_tanggapan', 'id');
    }

    // Di dalam model Tanggapan.php

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas');
    }



    protected $fillable = [
        'id',
        'id_pengaduan',
        'tanggapan',
        'id_petugas',
    ];
}
