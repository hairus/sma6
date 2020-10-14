<?php

namespace App\Http\Controllers;

use App\Imports\UsersGuruImport;
use App\Imports\UsersSiswaImport;
use App\User;
use Illuminate\Http\Request;
use App\Exports\UsersSiswaExport;
use App\Exports\UsersGuruExport;
use App\Models\kelas;
use Maatwebsite\Excel\Facades\Excel;

class adminSmaController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::all();

        return view('adminNew.index', compact('user'));
    }

    public function exim()
    {
        return view('adminNew.exim');
    }

    public function exportSiswa()
    {
        return (new UsersSiswaExport)->siswaId(3)->download('Usersiswa.xlsx');
    }

    public function ImportSiswa(Request $request)
    {
        if ($request->siswa) {
            Excel::import(new UsersSiswaImport, request()->file('siswa'));

            return redirect('/admin/exim')->with('success', 'All good!');
        }
    }

    public function exportGuru()
    {
        return (new UsersGuruExport)->guruId(2)->download('UserGuru.xlsx');
    }

    public function ImportGuru(Request $request)
    {
        if ($request->guru) {

            Excel::import(new UsersGuruImport, request()->file('guru'));

            return redirect('/admin/exim')->with('success', 'All good!');
        }
    }


    /** setting kelas */
    public function kelas()
    {
        $kelas = kelas::all();

        return view('adminNew.kelas', compact('kelas'));
    }

    public function ck(Request $request)
    {
        $request->validate([
            'kelas' => 'required'
        ]);

        kelas::create([
            'kelas' => $request->kelas
        ]);

        return back()->with('message', 'berhasil menambah kelas');
    }

    public function delKelas(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required'
        ]);
        $kelas = kelas::findorFail($request->kelas_id);
        $kelas->delete();

        return back()->with('message', 'sukses menghapus kelas');
    }
}
