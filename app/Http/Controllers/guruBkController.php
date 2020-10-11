<?php

namespace App\Http\Controllers;

use App\Models\kelas_siswa;
use Illuminate\Http\Request;

class guruBkController extends Controller
{
    public function index()
    {
        $kelas_siswa = kelas_siswa::where('kelas_id', '<>', '31')->orderBy('kelas_id')->get();
        return view('guru.bk.ss', compact('kelas_siswa'));
    }
}
