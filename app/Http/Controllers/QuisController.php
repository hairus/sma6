<?php

namespace App\Http\Controllers;

use App\Models\guru_mapel;
use App\Models\kdMapel;
use App\Models\mst_operator;
use App\Models\penelaah;
use App\Models\soal;
use App\Models\uploadKisi;
use App\User;
use Illuminate\Http\Request;
use DB;
use App\Models\Kelas;
use App\Models\mapels;
use App\Models\jurusan;
use App\Models\ta;
use App\Models\ju;
use App\mst_soal;
use App\Models\set_ujian;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Auth;
use Validator;

class QuisController extends Controller {
    public function index() {
        $tas     = \App\Models\ta::where( 'status', 1 )->first();
        $ju      = DB::table( 'ju' )->get();
        $jurusan = DB::table( 'jurusans' )->get();
        $kelas   = Kelas::select( 'kat_kelas' )->distinct()->get();
        $mapel   = mapels::select( 'id', 'mapel' )->where( [
            [ 'tas_id', $tas->id ],
            [ 'ket', 'sks' ]
        ] )->get();

        $op   = mst_operator::all();
        $data = set_ujian::all();

        return view( 'admin.quiz.index', [ 'ju'      => $ju,
                                           'jurusan' => $jurusan,
                                           'kelas'   => $kelas,
                                           'mapel'   => $mapel,
                                           'op'      => $op,
                                           'data'    => $data
        ] );
    }

    public function setQ( Request $request ) {
        $op = mst_operator::updateOrCreate( [
            'tgl_start' => $request->tgl,
            'ju_id'     => $request->ju,
            'jur_id'    => $request->jurusan,
            'kelas_id'  => $request->kelas,
            'kat'       => $request->kat,
            'status'    => 1,
        ], [
            'mapel_id' => $request->mapel,
        ] );

        Session::flash( "flash_notif", [
            "level"   => "success",
            "message" => "Penyimpanan sukses !!!"
        ] );

        return back();
    }

    public function status( $id ) {
        $data         = mst_operator::findOrFail( $id );
        $data->status = 0;
        $data->save();

        return back();
    }

    public function statusA( $id ) {
        $data         = mst_operator::findOrFail( $id );
        $data->status = 1;
        $data->save();

        return back();
    }

    public function soal() {
        return view( 'quis.soal' );
    }

    public function csoal() {
        $tas   = ta::where( 'status', 1 )->first();
        $kelas = Kelas::where( 'tas_id', $tas->id )->get();
        /* saya ambil sks karena semua mapel sama */
        $mapel = mapels::where( 'ket', 'sks' )->get();
        /*----------------------------------------- */
        $jurusan    = jurusan::all();
        $ju         = ju::all();
        $kat        = Kelas::select( 'kat_kelas' )->distinct()->where( 'tas_id', $tas->id )->get();
        $data_ujian = set_ujian::where( 'creator', Auth::user()->id )->get();

        return view( 'quis.cSoal', compact( 'kelas', 'mapel', 'jurusan', 'kat', 'ju', 'data_ujian' ) );
    }

    public function setUj( Request $request ) {
        /*cek dulu mapel di operator sama dengan yang akan di ujikan */
        $data = mst_operator::where( [
            [ 'mapel_id', $request->mapel_id ],
            [ 'ju_id', $request->ju_id ],
            [ 'status', 1 ]
        ] )->count();

        if ( $data == 1 ) {
            $sim           = new set_ujian();
            $sim->ju_id    = $request->ju_id;
            $sim->jur_id   = $request->jur_id;
            $sim->mapel_id = $request->mapel_id;
            $sim->kat      = $request->kat;
            $sim->kelas_id = $request->kelas_id;
            $sim->creator  = Auth::user()->id;
            $sim->save();

            Session::flash( "flash_notif", [
                "level"   => "success",
                "message" => "Set Ujian sukses"
            ] );

            return back();
        }
        Session::flash( "flash_notif", [
            "level"   => "danger",
            "message" => "Silakan Hubungi Admin untuk Mapel yg akan di ujikan"
        ] );

        return back();
    }

    public function test() {
        $jumMapelSaya = guru_mapel::where( 'guru_id', Auth::user()->id )->count();
        if ( $jumMapelSaya > 1 ) {
            $mapel_saya = guru_mapel::where( 'guru_id', Auth::user()->id )->get();

            return view( 'quis.duaMapel', compact( 'mapel_saya' ) );
        } else {
            $mapel_saya = guru_mapel::where( 'guru_id', Auth::user()->id )->first();

            return view( 'quis.test', compact( 'mapel_saya' ) );
        }

    }

    public function saveSoal( Request $request ) {
        $this->validate( $request, [
            'soal'  => 'required',
            'a'     => 'required',
            'b'     => 'required',
            'c'     => 'required',
            'd'     => 'required',
            'e'     => 'required',
            'jawab' => 'required',
        ] );

        if ( $request->jawab == 'a' ) {
            $simpan           = new soal();
            $simpan->soal     = $request->soal;
            $simpan->a        = $request->a;
            $simpan->b        = $request->b;
            $simpan->c        = $request->c;
            $simpan->d        = $request->d;
            $simpan->e        = $request->e;
            $simpan->jawab    = $request->jawab;
            $simpan->jawaban  = $request->a;
            $simpan->guru_id  = Auth::user()->id;
            $simpan->mapel_id = $request->mapel;
            $simpan->kd_id    = $request->kd;
            $simpan->rombel   = $request->rombel;
            $simpan->save();
        } elseif ( $request->jawab == 'b' ) {
            $simpan           = new soal();
            $simpan->soal     = $request->soal;
            $simpan->a        = $request->a;
            $simpan->b        = $request->b;
            $simpan->c        = $request->c;
            $simpan->d        = $request->d;
            $simpan->e        = $request->e;
            $simpan->jawab    = $request->jawab;
            $simpan->jawaban  = $request->b;
            $simpan->guru_id  = Auth::user()->id;
            $simpan->mapel_id = $request->mapel;
            $simpan->kd_id    = $request->kd;
            $simpan->rombel   = $request->rombel;
            $simpan->save();
        } elseif ( $request->jawab == 'c' ) {
            $simpan           = new soal();
            $simpan->soal     = $request->soal;
            $simpan->a        = $request->a;
            $simpan->b        = $request->b;
            $simpan->c        = $request->c;
            $simpan->d        = $request->d;
            $simpan->e        = $request->e;
            $simpan->jawab    = $request->jawab;
            $simpan->jawaban  = $request->c;
            $simpan->guru_id  = Auth::user()->id;
            $simpan->mapel_id = $request->mapel;
            $simpan->kd_id    = $request->kd;
            $simpan->rombel   = $request->rombel;
            $simpan->save();
        } elseif ( $request->jawab == 'd' ) {
            $simpan           = new soal();
            $simpan->soal     = $request->soal;
            $simpan->a        = $request->a;
            $simpan->b        = $request->b;
            $simpan->c        = $request->c;
            $simpan->d        = $request->d;
            $simpan->e        = $request->e;
            $simpan->jawab    = $request->jawab;
            $simpan->jawaban  = $request->d;
            $simpan->guru_id  = Auth::user()->id;
            $simpan->mapel_id = $request->mapel;
            $simpan->kd_id    = $request->kd;
            $simpan->rombel   = $request->rombel;
            $simpan->save();
        } elseif ( $request->jawab == 'e' ) {
            $simpan           = new soal();
            $simpan->soal     = $request->soal;
            $simpan->a        = $request->a;
            $simpan->b        = $request->b;
            $simpan->c        = $request->c;
            $simpan->d        = $request->d;
            $simpan->e        = $request->e;
            $simpan->jawab    = $request->jawab;
            $simpan->jawaban  = $request->e;
            $simpan->guru_id  = Auth::user()->id;
            $simpan->mapel_id = $request->mapel;
            $simpan->kd_id    = $request->kd;
            $simpan->rombel   = $request->rombel;
            $simpan->save();
        }

        $kdnya = kdMapel::where( 'id', $request->kd )->first();

        Session::flash( "flash_notif", [
            "level"   => "success",
            "message" => "Penulisan Soal sukses di simpan dengan kd = " . $kdnya->kd
        ] );

        return back();
    }

    public function view() {
        $soal = soal::where( 'guru_id', Auth::user()->id )->get();

//        dd($soal);

        return view( 'quis.view', compact( 'soal' ) );
    }

    public function delsoal( $id ) {
        $soal = soal::where( [
            [ 'guru_id', Auth::user()->id ],
            [ 'id', $id ]
        ] )->delete();

        Session::flash( "flash_notif", [
            "level"   => "danger",
            "message" => "Hapus soal berhasil"
        ] );

        return back();
    }

    public function editSoal( $id ) {
        $soalSaya = soal::where( [
            [ 'guru_id', Auth::user()->id ],
            [ 'id', $id ]
        ] )->first();

        return view( 'quis.edit', compact( 'soalSaya' ) );
    }

    public function updateSoal( Request $request, $id ) {
        $validator = Validator::make( $request->all(), [
            'rombel' => 'required',
            'kd'     => 'required',
            'jawab'  => 'required'
        ] );

        if ( $validator->fails() ) {

            Session::flash( "flash_notif", [
                "level"   => "danger",
                "message" => "Update Gagal karena Rombel, KD  atau Jawaban masih kosong"
            ] );

            return redirect( '/guru/eva/view' );
        }

        if ( $request->jawab == 'a' ) {
            $update          = soal::findorFail( $id );
            $update->soal    = $request->soal;
            $update->a       = $request->a;
            $update->b       = $request->b;
            $update->c       = $request->c;
            $update->d       = $request->d;
            $update->e       = $request->e;
            $update->jawab   = $request->jawab;
            $update->kd_id   = $request->kd;
            $update->rombel  = $request->rombel;
            $update->guru_id = Auth::user()->id;
            $update->jawaban = $request->a;
            $update->save();
        } elseif ( $request->jawab == 'b' ) {
            $update          = soal::findorFail( $id );
            $update->soal    = $request->soal;
            $update->a       = $request->a;
            $update->b       = $request->b;
            $update->c       = $request->c;
            $update->d       = $request->d;
            $update->e       = $request->e;
            $update->jawab   = $request->jawab;
            $update->kd_id   = $request->kd;
            $update->rombel  = $request->rombel;
            $update->guru_id = Auth::user()->id;
            $update->jawaban = $request->b;
            $update->save();
        } elseif ( $request->jawab == 'c' ) {
            $update          = soal::findorFail( $id );
            $update->soal    = $request->soal;
            $update->a       = $request->a;
            $update->b       = $request->b;
            $update->c       = $request->c;
            $update->d       = $request->d;
            $update->e       = $request->e;
            $update->jawab   = $request->jawab;
            $update->kd_id   = $request->kd;
            $update->rombel  = $request->rombel;
            $update->guru_id = Auth::user()->id;
            $update->jawaban = $request->c;
            $update->save();
        } elseif ( $request->jawab == 'd' ) {
            $update          = soal::findorFail( $id );
            $update->soal    = $request->soal;
            $update->a       = $request->a;
            $update->b       = $request->b;
            $update->c       = $request->c;
            $update->d       = $request->d;
            $update->e       = $request->e;
            $update->jawab   = $request->jawab;
            $update->kd_id   = $request->kd;
            $update->rombel  = $request->rombel;
            $update->guru_id = Auth::user()->id;
            $update->jawaban = $request->d;
            $update->save();
        } elseif ( $request->jawab == 'e' ) {
            $update          = soal::findorFail( $id );
            $update->soal    = $request->soal;
            $update->a       = $request->a;
            $update->b       = $request->b;
            $update->c       = $request->c;
            $update->d       = $request->d;
            $update->e       = $request->e;
            $update->jawab   = $request->jawab;
            $update->kd_id   = $request->kd;
            $update->rombel  = $request->rombel;
            $update->guru_id = Auth::user()->id;
            $update->jawaban = $request->e;
            $update->save();
        }

        Session::flash( "flash_notif", [
            "level"   => "success",
            "message" => "Update Soal berhasil"
        ] );

        return redirect( '/guru/eva/view' );
    }

    public function inputKD() {
        $kdBahsa = kdMapel::where( 'mapel_id', '156' )->get();

        return view( 'quis.inputKd', compact( 'kdBahsa' ) );
    }

    public function saveKd( Request $request ) {
        $this->validate( $request, [
            'kd'     => 'required',
            'rombel' => 'required'
        ] );

        $simpan           = new  kdMapel();
        $simpan->kd       = $request->kd;
        $simpan->kat      = $request->rombel;
        $simpan->jur_id   = 0;
        $simpan->mapel_id = 156;
        $simpan->save();

        Session::flash( "flash_notif", [
            "level"   => "success",
            "message" => "Input Kd sukses"
        ] );

        return back();
    }

    public function delKd( $id ) {
        $kd = kdMapel::where( [
            [ 'mapel_id', 156 ],
            [ 'id', $id ]
        ] )->delete();

        Session::flash( "flash_notif", [
            "level"   => "success",
            "message" => "Delete Kd sukses"
        ] );

        return back();
    }

    public function uploadKisi() {
        $jum = guru_mapel::where( 'guru_id', Auth::user()->id )->count( 'guru_id' );
        if ( $jum == 1 ) {

            $mapel      = guru_mapel::where( 'guru_id', Auth::user()->id )->first();
            $uploadKisi = uploadKisi::where( 'user_id', Auth::user()->id )->get();

            return view( 'quis.uploadKisi', compact( 'mapel', 'jum', 'uploadKisi' ) );
        } else {
            $mapel = guru_mapel::where( 'guru_id', Auth::user()->id )->get();

            $uploadKisi = uploadKisi::where( 'user_id', Auth::user()->id )->get();

            return view( 'quis.uploadKisi', compact( 'mapel', 'jum', 'uploadKisi' ) );
        }

    }

    public function upKisi( Request $request ) {
        $this->validate( $request, [
            'file' => 'required|mimes:docx,doc,xls,xlsx,pdf'
        ] );

        $ekstensi = $request->file->getClientOriginalExtension();
        $rename   = 'Skisikisi' . rand( 11111, 99999 ) . '.' . $ekstensi;

        $tempatUpload = 'uploadKisi';
        $file         = $request->file( 'file' );
        $file->move( $tempatUpload, $rename );

        $tas = ta::where( 'status', 1 )->first();

        $simpan           = new uploadKisi();
        $simpan->nama     = $request->nama;
        $simpan->tas_id   = $tas->id;
        $simpan->user_id  = Auth::user()->id;
        $simpan->mapel_id = $request->mapel_id;
        $simpan->file     = $rename;
        $simpan->save();

        Session::flash( "flash_notif", [
            "level"   => "success",
            "message" => "Berhasil Upload file"
        ] );

        return back();
    }

    public function downloadKisi( $id ) {
        $file = uploadKisi::where( [
            [ 'user_id', Auth::user()->id ],
            [ 'id', $id ]
        ] )->first();

        $patch = public_path( "/uploadKisi/" . $file->file );

        return Response::download( $patch );
    }

    public function delKisi( $id ) {
        $file = uploadKisi::where( [
            [ 'user_id', Auth::user()->id ],
            [ 'id', $id ]
        ] )->delete();

        Session::flash( "flash_notif", [
            "level"   => "success",
            "message" => "Berhasil Menghapus File"
        ] );

        return back();
    }

    public function penelaah()
    {
        $ta = ta::where('status', 1)->first();
        $penelaah = penelaah::orderby('user_id', 'ASC')->get();
        $mapel = mapels::where([
            ['tas_id', $ta->id],
            ['ket', 'sks']
        ])->get();

        $users = User::where('role', 2)->get();

        return view('quis.penelaah', compact('penelaah', 'mapel', 'users'));
    }

    public function savePenelaah(Request $request)
    {
        $jum = count($request->mapels);
        for($x = 0; $x < $jum; $x++){
            $simpan = new penelaah();
            $simpan->user_id = $request->user;
            $simpan->mapel_id = $request->mapels[$x];
            $simpan->save();
        }

        return back();
    }

    public function delPenelaah($id)
    {
       penelaah::where('id', $id)->delete();

       return back();
    }
}
