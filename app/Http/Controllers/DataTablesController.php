<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;
use App\Models\siswa;
use App\Models\Absens;
use App\Models\ta;
use App\Models\upload;
use App\Models\Gurus;
use App\Models\AbsenGuru;
use App\Models\jam;
use App\Models\mapels;
use App\User;
use Datatables;
use DB;
use URL;

class DataTablesController extends Controller
{
  public function DataAbsen(Request $request)
  {
      if($request->ajax()){
         $mahasiswa = Absens::select('nisn','kondisi', 'kelas_id', 'user')->where('date', date('Ymd'))->get();
         return Datatables::of($mahasiswa)
                 // tambah kolom untuk aksi edit dan hapus
                 ->make(true);
     } else {
         exit("Not an AJAX request -_-");
     }
  }
}
