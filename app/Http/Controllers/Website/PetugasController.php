<?php

namespace App\Http\Controllers\Website;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PetugasController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('petugas', compact('data'));
    }
}
