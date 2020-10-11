<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ppdb_agama;
use App\Models\ppdb_inklusi;
use App\Models\ppdb_pekerjaaanA;
use App\Models\ppdb_pekerjaaanb;
use App\Models\ppdb_pekerjaaanW;
use App\Models\ppdb_pendidikanA;
use App\Models\ppdb_pendidikanB;
use App\Models\ppdb_pendidikanW;
use App\Models\ppdb_profile;
use App\Models\ppdb_range_gajiA;
use App\Models\ppdb_range_gajiB;
use App\Models\ppdb_range_gajiW;
use App\Models\ppdb_tinggal;
use App\Models\ppdb_transportasi;
use App\Models\ppdb_jk;
use App\Models\ppdb_minat;
use App\Models\ppdb_osn;
use Auth;
use Session;
use App\User;

class siba1Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function formKosong()
    {
        // kita membuat dulu insert ke table ppdb_profile
        $cek = ppdb_profile::where('email', Auth::user()->email)->count();
        if ($cek === 0) {
            $simpan = new ppdb_profile();
            $simpan->email = Auth::user()->email;
            $simpan->nama = Auth::user()->nama;
            $simpan->nun = Auth::user()->username;
            $simpan->save();
        }
        $edit                   = User::with('ppdb')->where('id', Auth::user()->id)->first();
        if ($edit->ppdb->status_edit == 0) {
            $agama                  = ppdb_agama::all();
            $tinggal                = ppdb_tinggal::all();
            $transport              = ppdb_transportasi::all();
            $pk_ayah                = ppdb_pekerjaaanA::all();
            $pen_ayah               = ppdb_pendidikanA::all();
            $gaji_ayah              = ppdb_range_gajiA::all();
            $pk_ibu                 = ppdb_pekerjaaanB::all();
            $pen_ibu                = ppdb_pendidikanB::all();
            $gaji_ibu               = ppdb_range_gajiB::all();
            $pk_wali                = ppdb_pekerjaaanW::all();
            $pen_wali               = ppdb_pendidikanW::all();
            $gaji_wali              = ppdb_range_gajiW::all();
            $kebutuhan              = ppdb_inklusi::all();
            $minat                  = ppdb_minat::all();
            $osn                    = ppdb_osn::all();
            //$jenis_kelamin          = ppdb_jk::all();

            //dd($edit);
            //$edit                   = ppdb_profile::where('email', $user->email)->first();
            return view('siba.index', compact(
                'agama',
                'tinggal',
                'transport',
                'pk_ayah',
                'pen_ayah',
                'gaji_ayah',
                'pk_ibu',
                'pen_ibu',
                'gaji_ibu',
                'pk_wali',
                'pen_wali',
                'gaji_wali',
                'kebutuhan',
                'edit',
                'minat',
                'osn'
            ));
        } else {
            $edit                   = User::with('ppdb')->where('id', Auth::user()->id)->first();
            $agama                  = ppdb_agama::all();
            $tinggal                = ppdb_tinggal::all();
            $transport              = ppdb_transportasi::all();
            $pk_ayah                = ppdb_pekerjaaanA::all();
            $pen_ayah               = ppdb_pendidikanA::all();
            $gaji_ayah              = ppdb_range_gajiA::all();
            $pk_ibu                 = ppdb_pekerjaaanB::all();
            $pen_ibu                = ppdb_pendidikanB::all();
            $gaji_ibu               = ppdb_range_gajiB::all();
            $pk_wali                = ppdb_pekerjaaanW::all();
            $pen_wali               = ppdb_pendidikanW::all();
            $gaji_wali              = ppdb_range_gajiW::all();
            $kebutuhan              = ppdb_inklusi::all();
            $minat                  = ppdb_minat::all();
            $osn                    = ppdb_osn::all();

            return view('siba.edit', compact(
                'agama',
                'tinggal',
                'transport',
                'pk_ayah',
                'pen_ayah',
                'gaji_ayah',
                'pk_ibu',
                'pen_ibu',
                'gaji_ibu',
                'pk_wali',
                'pen_wali',
                'gaji_wali',
                'kebutuhan',
                'edit',
                'minat',
                'osn'
            ));
        }
    }

    public function formBiodata(Request $request)
    {
        $update                      = ppdb_profile::where('id', $request->id)->first();
        $update->tl                  = $request->tempat_lahir;
        $update->ttl                 = $request->tanggal_lahir;
        $update->jk                  = $request->jk;
        $update->nisn                = $request->nisn;
        $update->agama               = $request->agama;
        $update->alamat              = $request->alamat;
        $update->rt                  = $request->rt;
        $update->rw                  = $request->rw;
        $update->dusun               = $request->dusun;
        $update->kelurahan           = $request->kelurahan;
        $update->kec_kota            = $request->kec_kota;
        $update->kode_pos            = $request->kode_pos;
        $update->jenis_tinggal       = $request->tinggal;
        $update->alat_transportasi   = $request->transport;
        //data ayah
        $update->nama_ayah           = $request->namaa;
        $update->tahun_lahira        = $request->tahun_lahira;
        $update->jenjang_pendidikana = $request->jenjangp_a;
        $update->pekerjaana          = $request->pk_ayah;
        $update->penghasilana        = $request->gaji_ayah;
        $update->nika                = $request->nika;
        //data ibu
        $update->nama_ibu            = $request->namai;
        $update->tahun_lahiri        = $request->tahun_lahiri;
        $update->jenjang_pendidikani = $request->jenjangp_i;
        $update->pekerjaani          = $request->pk_ibu;
        $update->penghasilani        = $request->gaji_ibu;
        $update->niki                = $request->niki;
        //data wali
        $update->nama_wali           = $request->namaw;
        $update->tahun_lahirw        = $request->tahun_lahir;
        $update->jenjang_pendidikanw = $request->jenjangp_w;
        $update->pekerjaanw          = $request->pk_wali;
        $update->penghasilanw        = $request->gaji_wali;
        $update->nikw                = $request->nikw;
        //data kelengkapan
        $update->telepon             = $request->telepon;
        $update->hp                  = $request->hp;
        $update->skhun               = $request->skhun;
        $update->penerima_kps        = $request->penerima_kps;
        $update->no_kps              = $request->no_kps;
        $update->no_ijazah           = $request->no_ijazah;
        $update->penerima_kip        = $request->penerima_kip;
        $update->no_kip              = $request->no_kip;
        $update->nama_kip            = $request->nama_kip;
        $update->no_kks              = $request->no_kks;
        $update->no_reg_akta         = $request->no_reg_akta;
        $update->bank                = $request->bank;
        $update->no_rek              = $request->no_rek;
        $update->rek_atas_nama       = $request->rek_atas_nama;
        $update->asal_sekolah        = $request->asal_sekolah;
        $update->anak_ke             = $request->anak_ke;
        $update->minat_id            = $request->minat_id;
        $update->osn_id              = $request->osn_id;
        $update->status_edit         = 1;
        $update->save();

        $agama                  = ppdb_agama::all();
        $tinggal                = ppdb_tinggal::all();
        $transport              = ppdb_transportasi::all();
        $pk_ayah                = ppdb_pekerjaaanA::all();
        $pen_ayah               = ppdb_pendidikanA::all();
        $gaji_ayah              = ppdb_range_gajiA::all();
        $pk_ibu                 = ppdb_pekerjaaanB::all();
        $pen_ibu                = ppdb_pendidikanB::all();
        $gaji_ibu               = ppdb_range_gajiB::all();
        $pk_wali                = ppdb_pekerjaaanW::all();
        $pen_wali               = ppdb_pendidikanW::all();
        $gaji_wali              = ppdb_range_gajiW::all();
        $kebutuhan              = ppdb_inklusi::all();
        $minat                  = ppdb_minat::all();
        $osn                    = ppdb_osn::all();
        $edit                   = User::with('ppdb')->where('id', Auth::user()->id)->first();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Penyimpanan Sukses"
        ]);

        return view('siba.edit', compact(
            'agama',
            'tinggal',
            'transport',
            'pk_ayah',
            'pen_ayah',
            'gaji_ayah',
            'pk_ibu',
            'pen_ibu',
            'gaji_ibu',
            'pk_wali',
            'pen_wali',
            'gaji_wali',
            'kebutuhan',
            'edit',
            'osn',
            'minat'
        ));
    }

    public function updateForm(Request $request)
    {
        $update                      = ppdb_profile::where('id', $request->id)->first();
        $update->tl                  = $request->tempat_lahir;
        $update->nun                 = $request->nun;
        $update->ttl                 = $request->tanggal_lahir;
        $update->jk                  = $request->jk;
        $update->nisn                = $request->nisn;
        $update->agama               = $request->agama;
        $update->alamat              = $request->alamat;
        $update->rt                  = $request->rt;
        $update->rw                  = $request->rw;
        $update->dusun               = $request->dusun;
        $update->kelurahan           = $request->kelurahan;
        $update->kec_kota            = $request->kec_kota;
        $update->kode_pos            = $request->kode_pos;
        $update->jenis_tinggal       = $request->tinggal;
        $update->alat_transportasi   = $request->transport;
        //data ayah
        $update->nama_ayah           = $request->namaa;
        $update->tahun_lahira        = $request->tahun_lahira;
        $update->jenjang_pendidikana = $request->jenjangp_a;
        $update->pekerjaana          = $request->pk_ayah;
        $update->penghasilana        = $request->gaji_ayah;
        $update->nika                = $request->nika;
        //data ibu
        $update->nama_ibu            = $request->namai;
        $update->tahun_lahiri        = $request->tahun_lahiri;
        $update->jenjang_pendidikani = $request->jenjangp_i;
        $update->pekerjaani          = $request->pk_ibu;
        $update->penghasilani        = $request->gaji_ibu;
        $update->niki                = $request->niki;
        //data wali
        $update->nama_wali           = $request->namaw;
        $update->tahun_lahirw        = $request->tahun_lahir;
        $update->jenjang_pendidikanw = $request->jenjangp_w;
        $update->pekerjaanw          = $request->pk_wali;
        $update->penghasilanw        = $request->gaji_wali;
        $update->nikw                = $request->nikw;
        //data kelengkapan
        $update->telepon             = $request->telepon;
        $update->hp                  = $request->hp;
        $update->skhun               = $request->skhun;
        $update->penerima_kps        = $request->penerima_kps;
        $update->no_kps              = $request->no_kps;
        $update->no_ijazah           = $request->no_ijazah;
        $update->penerima_kip        = $request->penerima_kip;
        $update->no_kip              = $request->no_kip;
        $update->nama_kip            = $request->nama_kip;
        $update->no_kks              = $request->no_kks;
        $update->no_reg_akta         = $request->no_reg_akta;
        $update->bank                = $request->bank;
        $update->no_rek              = $request->no_rek;
        $update->rek_atas_nama       = $request->rek_atas_nama;
        $update->asal_sekolah        = $request->asal_sekolah;
        $update->anak_ke             = $request->anak_ke;
        $update->minat_id            = $request->minat_id;
        $update->osn_id              = $request->osn_id;
        $update->save();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Pengeditan Sukses"
        ]);

        return redirect('/admin');
    }


    public function cek()
    {
        $tampil = ppdb_profile::whereYear('created_at', 2020)->get();

        return view('siba.entri', compact('tampil'));
    }

    public function tampilkan($id)
    {
        //dd('kesini');
        $tampil            = ppdb_profile::with(
            'agama1',
            'transportasi',
            'tinggal1',
            'jenjanga',
            'gajia',
            'pekerjaan_a',
            'jenjangb',
            'gajib',
            'pekerjaan_i',
            'jenjangw',
            'gajiw',
            'pekerjaan_w1',
            'minat1',
            'osn1'
        )->where('id', $id)->first();
        //dd($tampil);
        return view('siba.tampil', compact('tampil'));
    }

    public function pengecheckan()
    {
        dd('Kesini');
    }

    public function del($id)
    {
        $del = ppdb_profile::findorFail($id);
        $email = $del->email;

        $db2 = User::where('email', $email)->first();

        $db2->delete();
        $del->delete();

        return back();
    }
}
