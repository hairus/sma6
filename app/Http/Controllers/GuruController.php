<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;

class guruController extends Controller
{
    public function index()
    {
        return view('guru.index');
    }

    public function plhKls()
    {
        $kelas = kelas::orderBy('kelas', 'ASC')->get();

        return view('guru.plhKls');
    }
}
