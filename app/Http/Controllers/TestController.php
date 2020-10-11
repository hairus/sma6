<?php

namespace App\Http\Controllers;

use App\Models\Gurus;
use App\Models\mapels;
use App\Models\mstUkbm;
use App\Models\NA;
use App\Models\PenKd;
use App\Models\RgHarian;
use App\Models\ta;
use App\Models\upload;
use App\Models\upUm;
use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\Kelas;
use App\Models\Absens;
use App\Models\access;
use App\Models\kelas_siswa;
use App\Models\ppd;
use Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use File;
use DB;

class TestController extends Controller
{
    protected $connection = 'mysql2';
    //=========== percobaan mengganti password user tanpa email ==========================//
    public function index()
    {
        $kelas = kelas::all();
        return view('tester/tester', ['kelas' => $kelas]);
    }

    public function carisiswa(Request $request)
    {
        $siswa = siswa::where('kelas_id', $request->id)->take(100)->get();
        return Response()->json($siswa);
    }

    public function absen()
    {
        $absen = Absens::all();

        return view('tester/absen');
    }

    public function literasi()
    {
        return 'ini mau di isi apa ya pak haji';
    }

    public function add()
    {
        for ($x = 1; $x <= 90; $x++) {
            $data[] = array(
                'name'       => 'user' . $x,
                'role'       => '6',
                'password'   => bcrypt('123456'),
                'status'     => 'siswa',
                'email'      => $x . '@siswa.com'
            );
        }
        /*
            kenapa di tutup di karenakan sudah di jalankan di databse
       */
        //User::insert($data);
    }

    public function hari()
    {
        //       setlocale(LC_TIME, 'Indonesia');
        //       echo \Carbon\Carbon::now()->format('l, d F Y H:i');
        //       echo \Carbon\Carbon::parse('23-03-2017 11:23:45')->formatLocalized('%A %d %B %Y');
        return 'warwerwor';
    }

    public function udik()
    {
        var_dump('udik1111111111111111');
    }

    public function sumjam()
    {
        $rekapB = RgHarian::whereMonth('created_at', '09')->get();
        dd($rekapB);
    }

    public  function upUm()
    {
        $guru = Gurus::where('nama', Auth::user()->name)->first();
        $tas = ta::where('status', 1)->first();
        $files = upUm::all();
        return view('/admin/jurnal/UploadIndexUm', ['files' => $files]);
    }

    public function saveUpload(Request $request)
    {
        //dd($request);
        //==================== cek ta id yang aktif ==============//
        $ta = ta::where('status', 1)
            ->first();

        $guru_id = Gurus::where('nama', Auth::user()->name)
            ->first();
        //============ cara membuat session di laravel ==================//
        $coba = session()->put('gurus_id', $guru_id->id);

        $this->validate($request, [
            'nama_file' => 'required',
            'nama_type' => 'required|mimes:doc,docx,xls,xlsx,pdf,ppt,pptx,jpg,jpeg,png|max:25000',
        ]);
        //================== mengambil ekstensi dari file ======================//
        $ekstensi = $request->nama_type->getClientOriginalExtension();
        //====== mengubah nama file =====================//
        $rename = 'smansa' . rand(11111, 99999) . '.' . $ekstensi;

        $tempatUpload = 'upUm';
        $file = $request->file('nama_type');
        $file->move($tempatUpload, $rename);

        $simpan = DB::table('UpUm')->insert([
            [
                'gurus_id' => session('gurus_id'),
                'file' => $rename,
                'tas_id' => $ta->id,
                'nama_file' => $request->nama_file,
                'ket'   => $request->ket,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);
        if ($simpan) {
            Session::flash("flash_notif", [
                "level"   => "success",
                "message" => "Upload data sukses"
            ]);
        } else {
            Session::flash("flash_notif", [
                "level"   => "danger",
                "message" => "Gagal Upload data"
            ]);
        }
        return redirect('/admin/upload');
    }

    public function posang()
    {
        $ukbm = mstUkbm::select(['id', 'jdlKbm', 'mapel_id'])->get();
        foreach ($ukbm as $ukmbs) {
            dump($ukmbs->id);
            $nilai = PenKd::select(['nilai', 'nis'])->where('kd', $ukmbs->id)->get();
            foreach ($nilai as $nilais) {
                dump($nilais->nis . '----' . $nilais->nilai);
            }
        }
    }

    public function attach()
    {
        $user = User::find(1);
        dd($user->role);
    }

    public function testing($nis)
    {
        //$siswa = User::with('siswas')->where('id', Auth::user()->id)->first();
        //$kelas = $siswa->siswas[0]->kelas_id;
        $nis  = 16687;
        /* data base tolong di rubah di user berikan nis*/
        $na = mapels::with(['NA' => function ($query) use ($nis) {
            $query->where('nis', $nis);
        }])->with(['nilai_kd' => function ($nisnya) use ($nis) {
            $nisnya->where('nis', $nis);
        }])->where('ket', 'sks')->get();
        //dd($na);
        foreach ($na as $gg) {
            echo '<li>' . $gg->mapel . '</li>';
            foreach ($gg->nilai_kd as $nilai) {
                echo '<li> nilai perKD:' . $nilai->nilai . '</li>';
            }
            foreach ($gg->NA as $nilai) {
                echo '<li> nilai NA:' . $nilai->nilai . '</li>';
            }
        }
    }

    public function finger()
    {
        //$jum = DB::connection('mysql2')->select('select count(pin) as jum FROM att_log');
        $data = DB::connection('mysql2')->select('SELECT * FROM att_log ORDER BY att_id DESC LIMIT 1');

        $user_id = $data[0]->pin;

        $user = User::where('id', $user_id)->first();

        // echo '<meta http-equiv="Refresh" content="300">';
        // echo $user->name. '<br>';
        // echo $data[0]->scan_date;

        return view('admin/absen/monitor', compact('data', 'user'));
    }

    public function cekSort()
    {
        $kelas_siswa = ppd::with('siswa')->where([
            ['guru_id', 11],
            ['kelas_id', 5],
            ['smt', 1],
            ['ta_id', 7]
        ])->get()->sortBy('siswa.name');

        foreach ($kelas_siswa as $data) {
            dump($data->siswa->name . '-' . $data->kd);
        }
    }
}
