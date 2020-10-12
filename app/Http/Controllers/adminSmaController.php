<?php

namespace App\Http\Controllers;

use App\Imports\UsersGuruImport;
use App\Imports\UsersSiswaImport;
use App\User;
use Illuminate\Http\Request;
use App\Exports\UsersSiswaExport;
use App\Exports\UsersGuruExport;
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
}
