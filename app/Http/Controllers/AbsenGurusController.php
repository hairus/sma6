<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Models\Kelas;
use App\Models\Absens;
use App\Models\ta;
use App\Models\Gurus;
use App\Models\AbsenGuru;
use App\User;
use App\Models\mapels;
use DB;

class AbsenGurusController extends Controller
{
  public function index()
  {
    $ta     = ta::where('status',1)->first();
    $kelas  = Kelas::where('tas_id', $ta->id)->get();
    $mapel  = mapels::where('tas_id', $ta->id)->get();
    //==== filter tampilan absen agar absen di hari kemarin tidak muncul di hari ini========//
    $guru   = Gurus::where('status','1')->orderBy('nama')->get();
    //=============================================//
    return view('admin/absen/AdminAbsenG',[
      'kelass' => $kelas,
      'gurus' => $guru,
      'ta' => $ta,
      'mapels' => $mapel
    ]);
  }

  public function store(Request $request)
  {

    $absenGuru = AbsenGuru::where([
      ['date', $request->date],
      ['jam_ke', $request->jam],
      ['gurus_id', $request->guru],
      ['kelas_id', $request->kelas],
      ])->count();


    if($absenGuru > 0 )
    {
      Session::flash("flash_notif",[
        "level"   => "danger",
        "message" => "Absen Guru Gagal karena guru sudah di absen di jam ini"
      ]);

      return redirect()->action('AbsenGurusController@index');
    }
    else
    {
    $simpan = new AbsenGuru;
    $simpan->tas_id   = $request->ta;
    $simpan->smt      = $request->smt;
    $simpan->date     = $request->date;
    $simpan->gurus_id = $request->guru;
    $simpan->mapel    = $request->mapel;
    $simpan->jam_ke   = $request->jam;
    $simpan->kelas_id = $request->kelas;
    $simpan->ket      = $request->ket;
    $simpan->catatan  = $request->catatan;
    $simpan->pengabsen  = $request->pengabsen;
    $simpan->save();

      Session::flash("flash_notif",[
        "level"   => "success",
        "message" => "Absen Guru Berhasil"
      ]);
      //dd($simpan);
    }
    return redirect()->action('AbsenGurusController@index');
  }

  public function show()
  {
    $absenGuru = AbsenGuru::where('date', date('Ymd'))->orderBy('kelas_id')->get();
    return view('/admin/absen/show', ['Ag' => $absenGuru]);
  }

  public function edit($id)
  {
    $db = AbsenGuru::where('id', $id)->first();
    //=============================================//
    return view('admin/absen/editGuru',["data" => $db]);
  }

  public function update(Request $request, $id)
  {

    $db = AbsenGuru::find($id);
    $db->ket = $request->ket;
    $db->pengabsen = $request->user;
    $db->save();
      //============= jika update sudah di simpan maka akan di redirect ke show ==============//
    $absenGuru = AbsenGuru::where('date', date('Ymd'))->orderBy('kelas_id')->get();
    return view('/admin/absen/show', ['Ag' => $absenGuru]);
    
    Session::flash("flash_notif",[
      "level"   => "success",
      "message" => "Edit Guru Berhasil"
    ]);
  }
}
