<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Masyarakat extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'nik',
        'nama',
        'email',
        'no_telp',
        'password',
    ];
}
