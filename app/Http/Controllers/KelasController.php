<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use lluminate\Support\Facades\DB;
use App\Models\Kelas;
use App\Models\siswa;


class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //dd($this);
    }

    public function index()
    {
        $Kelas = Kelas::paginate(10);
        return view('admin/kelas', ['Kelas' => $Kelas ]);
    }

    public function create()
    {
      $Kelas = Kelas::all();
      return view('admin/create', ['Kelas' => $Kelas ]);
    }

    public function store(Request $request)
    {
      //dd($request);
      $this->validate($request,[
        'nm_kelas'   =>  'required',
        'kd_kelas'   =>  'required'
      ]);

      $Kelas = New Kelas;
      $Kelas->nm_kelas     = $request->nm_kelas;
      $Kelas->kd_kelas     = $request->kd_kelas;
      $Kelas->save();

      return redirect('/admin/kelas');
    }

    public function cekSiswa($id)
    {
      return View('admin.groupSiswa',['kelas' => Kelas::findOrFail($id)]);
    }
}
