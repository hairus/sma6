<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\point;
use App\Models\siswa;
use App\Models\ta;
use Illuminate\Http\Request;
use Auth;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    public function index()
    {
        $ta = ta::where('status', 1)->first();
    	$siswa = siswa::where('status', 1)->get();

    	$point = point::where('tas_id', $ta->id)->orderBy('created_at', 'DESC')->get();

    	return view('tatib.index', compact('siswa', 'point'));
    }

    public function simpan(Request $request)
    {
    	$nis = $request->nis;
    	$kelas = siswa::where('nisn', $nis)->first();
    	$tas = ta::where('status', 1)->first();

    	$simpan = new point();
    	$simpan->nis = $request->nis;
    	$simpan->kelas_id = $kelas->kelas_id;
    	$simpan->guru_id = Auth::user()->id;
    	$simpan->point = $request->point;
    	$simpan->tas_id = $tas->id;
    	$simpan->ket = $request->ket;
    	$simpan->save();

    	return redirect('guru/Cpoin');
    }

    public function jumpoin()
    {
//        $ta = ta::where()
        $jum = point::select('nis', 'kelas_id')->distinct('nis')->orderBy('kelas_id', 'ASC')->get('nis');
        $jumlah = point::get();

        return view('tatib.point', compact('jum', 'jumlah'));
    }

    public function Ppoint()
    {
        return view('admin.guru.Ppoin');
    }

    public function cetak(Request $request)
    {
        Date::setLocale('id');
        $tgl = $request->tgl;
        $posang = explode(" " , $tgl);
        $start = $posang[0];
        $end = $posang[2];
        $token = $request->_token;

        $datas = point::whereBetween('created_at',[$start, $end])->orderBy('nis', 'ASC')->orderBy('created_at', 'DESC')->get();

        return view('admin.guru.ctkPoint', compact('datas', 'start', 'end', 'token', 'hari'));
    }

    public function dPoint($nis)
    {
        $datas = point::where('nis', $nis)->get();

        return view('admin.guru.dPoint', compact('datas'));
    }
}
