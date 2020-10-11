<?php

namespace App\Http\Controllers;

use App\Models\guru_mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\jurnals;
use App\Models\Kelas;
use App\Models\ta;
use App\Models\kd;
use App\Models\mapels;
use App\Models\Gurus;
use App\Models\siswa;
use App\Models\AbsenGuru;
use App\Models\kelas_siswa;
use App\User;
use Auth;
use DB;

class JurnalController extends Controller
{
    public function index()
    {
        $kelas = Kelas::paginate(10);
        //untuk memunculkan tahun ajaran
        $ta = ta::where('status', 1)->first();
        //dd($ta);
        $jurnal = jurnals::where([
            ['user', Auth::user()->name],
            ['tas_id', $ta->id],
            ['tgl', date('Ymd')]
        ])->get();
        //dd($jurnal);
        return view('admin/jurnal/index', ['kelas' => $kelas, 'jurnals' => $jurnal]);
    }

    public function create($id)
    {

        //cek ta yang aktif
        $tas    = ta::where('status', 1)->first();
        //jika ta ada maka filter mapel dimana ta dan semester yang aktif, maka mapel akan di munculkan
        $mapel  = guru_mapel::where('guru_id', Auth::user()->id)->get();
        //cek siswa dengan parameter id kelas dan munculkan
        $siswas = kelas_siswa::where('kelas_id', $id)->get();

        return view('admin.jurnal.create', ['kelas' => Kelas::findOrFail($id), 'Mapel' => $mapel, 'ta' => $tas, 'siswas' => $siswas]);
    }

    public function store(Request $request)
    {
        $data[] = array(
            $request->jam1,
            $request->jam2,
            $request->jam3,
            $request->jam4,
            $request->jam5,
            $request->jam6,
            $request->jam7,
            $request->jam8,
            $request->jam9,
            $request->jam10,
            $request->jam11,
            $request->jam12,
            $request->jam13
        );
        for ($x = 0; $x <= 13; $x++) {
            if (!empty($data[0][$x])) {
                $jurnal = new jurnals;
                $jurnal->semester = $request->semester;
                $jurnal->tas_id   = $request->ta;
                $jurnal->jam_ke   = $data[0][$x];
                $jurnal->mapel    = $request->mapel;
                $jurnal->user     = $request->user;
                $jurnal->gurus_id = $request->user_id;
                $jurnal->hari     = $request->hari;
                $jurnal->kikd_ke  = $request->kikd;
                $jurnal->materi   = $request->materi;
                $jurnal->siswa    = $request->siswa;
                $jurnal->sos      = $request->sos;
                $jurnal->sikap    = $request->sikap;
                $jurnal->spi      = $request->tindak;
                $jurnal->kelas    = $request->kelas;
                $jurnal->tgl      = $request->tgl;
                $jurnal->save();
            }
        }
        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Pengisian Jurnal Berhasil"
        ]);
        return back();
    }

    public function test()
    {
        //============= ini menggunakan metode raw ================//
        // keunggunlannya bisa select field tertentu agar database tidak berat
        $user_id = User::where('email', Auth::user()->email)->first();
        $parameter = $user_id->gurus->id;
        //dd($parameter);
        $jurnal = DB::select("select kelas from jurnals where gurus_id = $parameter AND jam_ke = 0");
        return view('admin/jurnal/test', ['jurnal' => $jurnal]);
    }

    public function formRekap()
    {
        return view('admin/jurnal/rekapJ');
    }

    public function rekap(Request $request)
    {
        $tglA     = $request->tglA;
        //================= disini pakai strtotime untuk merubah format waktu dari timepicker ==============//
        $convert = date("Y-m-d", strtotime($tglA));
        $rekaps   = jurnals::wheredate('created_at', $convert)->get();
        return view('admin/jurnal/cetak', ['rekaps' => $rekaps]);
    }

    public function idmapel(Request $request)
    {

        $kd = kd::where('mapels_id', $request->id)->get();
        return response()->json($kd);
    }

    public function cetak()
    {
        $ta = ta::where('status', 1)->first();
        $jurnal = jurnals::where([
            ['user', Auth::user()->name],
            ['tas_id', $ta->id],
            ['semester', $ta->semester]
        ])->OrderBy('kelas')->get();
        //dd($jurnal);
        return view('/admin/jurnal/cetak', ['datas' => $jurnal]);
    }

    public function show()
    {
        $cek = AbsenGuru::where('date', date('Ymd'))->latest()->first();

        $k1 = AbsenGuru::where([
            ['kelas_id', 1],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k1 === null) {
            $k1 = null;
        } else {
            $k1 = AbsenGuru::where([
                ['kelas_id', 1],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k2 = AbsenGuru::where([
            ['kelas_id', 2],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k2 === null) {
            $k2 = null;
        } else {
            $k2 = AbsenGuru::where([
                ['kelas_id', 2],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k3 = AbsenGuru::where([
            ['kelas_id', 3],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k3 === null) {
            $k3 = null;
        } else {
            $k3 = AbsenGuru::where([
                ['kelas_id', 3],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k4 = AbsenGuru::where([
            ['kelas_id', 4],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k4 === null) {
            $k4 = null;
        } else {
            $k4 = AbsenGuru::where([
                ['kelas_id', 4],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k5 = AbsenGuru::where([
            ['kelas_id', 5],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k5 === null) {
            $k5 = null;
        } else {
            $k5 = AbsenGuru::where([
                ['kelas_id', 5],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k6 = AbsenGuru::where([
            ['kelas_id', 6],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k6 === null) {
            $k6 = null;
        } else {
            $k6 = AbsenGuru::where([
                ['kelas_id', 6],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k7 = AbsenGuru::where([
            ['kelas_id', 7],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k7 === null) {
            $k7 = null;
        } else {
            $k7 = AbsenGuru::where([
                ['kelas_id', 7],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k8 = AbsenGuru::where([
            ['kelas_id', 8],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k8 === null) {
            $k8 = null;
        } else {
            $k8 = AbsenGuru::where([
                ['kelas_id', 8],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k9 = AbsenGuru::where([
            ['kelas_id', 9],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k9 === null) {
            $k9 = null;
        } else {
            $k9 = AbsenGuru::where([
                ['kelas_id', 9],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k10 = AbsenGuru::where([
            ['kelas_id', 10],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k10 === null) {
            $k10 = null;
        } else {
            $k10 = AbsenGuru::where([
                ['kelas_id', 10],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k11 = AbsenGuru::where([
            ['kelas_id', 11],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k11 === null) {
            $k11 = null;
        } else {
            $k11 = AbsenGuru::where([
                ['kelas_id', 11],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k12 = AbsenGuru::where([
            ['kelas_id', 12],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k12 === null) {
            $k12 = null;
        } else {
            $k12 = AbsenGuru::where([
                ['kelas_id', 12],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k13 = AbsenGuru::where([
            ['kelas_id', 13],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k13 === null) {
            $k13 = null;
        } else {
            $k13 = AbsenGuru::where([
                ['kelas_id', 13],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k14 = AbsenGuru::where([
            ['kelas_id', 14],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k14 === null) {
            $k14 = null;
        } else {
            $k14 = AbsenGuru::where([
                ['kelas_id', 14],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k15 = AbsenGuru::where([
            ['kelas_id', 15],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k15 === null) {
            $k15 = null;
        } else {
            $k15 = AbsenGuru::where([
                ['kelas_id', 15],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k16 = AbsenGuru::where([
            ['kelas_id', 16],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k16 === null) {
            $k16 = null;
        } else {
            $k16 = AbsenGuru::where([
                ['kelas_id', 16],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k17 = AbsenGuru::where([
            ['kelas_id', 17],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k17 === null) {
            $k17 = null;
        } else {
            $k17 = AbsenGuru::where([
                ['kelas_id', 17],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k18 = AbsenGuru::where([
            ['kelas_id', 18],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k18 === null) {
            $k18 = null;
        } else {
            $k18 = AbsenGuru::where([
                ['kelas_id', 18],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k19 = AbsenGuru::where([
            ['kelas_id', 19],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k19 === null) {
            $k19 = null;
        } else {
            $k19 = AbsenGuru::where([
                ['kelas_id', 19],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k20 = AbsenGuru::where([
            ['kelas_id', 20],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k20 === null) {
            $k20 = null;
        } else {
            $k20 = AbsenGuru::where([
                ['kelas_id', 20],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k21 = AbsenGuru::where([
            ['kelas_id', 21],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k21 === null) {
            $k21 = null;
        } else {
            $k21 = AbsenGuru::where([
                ['kelas_id', 21],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k22 = AbsenGuru::where([
            ['kelas_id', 22],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k22 === null) {
            $k22 = null;
        } else {
            $k22 = AbsenGuru::where([
                ['kelas_id', 22],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k23 = AbsenGuru::where([
            ['kelas_id', 23],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k23 === null) {
            $k23 = null;
        } else {
            $k23 = AbsenGuru::where([
                ['kelas_id', 23],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k24 = AbsenGuru::where([
            ['kelas_id', 24],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k24 === null) {
            $k24 = null;
        } else {
            $k24 = AbsenGuru::where([
                ['kelas_id', 24],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k25 = AbsenGuru::where([
            ['kelas_id', 25],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k25 === null) {
            $k25 = null;
        } else {
            $k25 = AbsenGuru::where([
                ['kelas_id', 25],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k26 = AbsenGuru::where([
            ['kelas_id', 26],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k26 === null) {
            $k26 = null;
        } else {
            $k26 = AbsenGuru::where([
                ['kelas_id', 26],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k27 = AbsenGuru::where([
            ['kelas_id', 27],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k27 === null) {
            $k27 = null;
        } else {
            $k27 = AbsenGuru::where([
                ['kelas_id', 27],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k28 = AbsenGuru::where([
            ['kelas_id', 28],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k28 === null) {
            $k28 = null;
        } else {
            $k28 = AbsenGuru::where([
                ['kelas_id', 28],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k29 = AbsenGuru::where([
            ['kelas_id', 29],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k29 === null) {
            $k29 = null;
        } else {
            $k29 = AbsenGuru::where([
                ['kelas_id', 29],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        $k30 = AbsenGuru::where([
            ['kelas_id', 30],
            ['date', date('Ymd')]
        ])->latest()->first();

        if ($k30 === null) {
            $k30 = null;
        } else {
            $k30 = AbsenGuru::where([
                ['kelas_id', 30],
                ['date', date('Ymd')]
            ])->latest()->first();
        }

        return view(
            'admin/jurnal/denah',
            [
                'k1' => $k1, 'k2' => $k2, 'k3' => $k3, 'k4' => $k4, 'k5' => $k5,
                'k6' => $k6, 'k7' => $k7, 'k8' => $k8, 'k9' => $k9, 'k10' => $k10,
                'k11' => $k11, 'k12' => $k12, 'k13' => $k13, 'k14' => $k14, 'k15' => $k15,
                'k16' => $k16, 'k17' => $k17, 'k18' => $k18, 'k19' => $k19, 'k20' => $k20,
                'k21' => $k21, 'k22' => $k22, 'k23' => $k23, 'k24' => $k24, 'k25' => $k25,
                'k26' => $k26, 'k27' => $k27, 'k28' => $k28, 'k29' => $k29, 'k30' => $k30
            ]
        );
    }
}
