<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\mapel_kelas;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class administrasiController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kelas = Kelas::all();

        return view('/admin/admins/index', compact('kelas'));
    }

    public function showSis(Request $request)
    {
        $siswa_kelas = Kelas::with(['siswas'=>function($query){
            $query->where('status', 1);
        }])->where('id', $request->kls)->get();

        return view('/admin/admins/showSiswa', compact('siswa_kelas'));
    }

    public function indexKelas()
    {
        $kelas = Kelas::all();

        return view('/admin/admins/indexKelas', compact('kelas'));
    }

    public function redir(Request $request)
    {
    $user = '';
        if(Auth::user()->role == 1)
        {
            $user = 'admin';
        }
        elseif(Auth::user()->role == 2)
        {
            $user = 'guru';
        }
        elseif(Auth::user()->role == 3)
        {
            $user = 'piket';
        }
        elseif(Auth::user()->role == 4)
        {
            $user = 'bk';
        }
        elseif(Auth::user()->role == 5)
        {
            $user = 'Kepala/wakasek';
        }
        elseif(Auth::user()->role == 6)
        {
            $user = 'siswa';
        }
        elseif(Auth::user()->role == 7) {
            $user = 'pengawas';
        }

        return redirect('/'.$user.'/redir/'.$request->kls);
    }

    public function show($kls)
    {
        $siswa_kelas = Kelas::with(['siswas'=>function($query){
            $query->where('status', 1);
        }])->where('id', $kls)->get();
        
        return view('/admin/admins/showSiswa1', compact('siswa_kelas'));
    }

    public function pindah($nis)
    {
        $siswa = siswa::where('nisn', $nis)->first();
        $kelas = Kelas::all();

        return view('/admin/admins/formUpdate',compact('siswa', 'kelas'));
    }

    public function update(Request $request)
    {
        /*ini update di table siswa */
//        $siswa = siswa::where('nisn', $request->nis)->first();
//        $siswa->kelas_id = $request->kls;
//        $siswa->save();
//
//        /*ini update di table mapel_kelas*/
//        $mapel_kelas = mapel_kelas::where('nis', $request->nis)->get();
//        foreach ($mapel_kelas as $kelas)
//        {
//            $kelas->kelas_id = $request->kls;
//            $kelas->save();
//        }

        /*sebelum di update semuanya
        * cek semua mapel di kelas yang akan di upate
        */
        //$map_kelass = mapel_kelas::select('mapel_id')->where('kelas_id', )

        return back();
    }
}
