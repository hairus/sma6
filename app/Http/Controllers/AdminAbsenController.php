<?php

namespace App\Http\Controllers;

use App\Models\jurnals;
use App\Models\RgHarian;
use App\Models\upUm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;
use App\Models\siswa;
use App\Models\Absens;
use App\Models\ta;
use App\Models\upload;
use App\Models\Gurus;
use App\Models\AbsenGuru;
use App\Models\jam;
use App\Models\kelas_siswa;
use App\Models\mapels;
use App\Models\UpPem;
use App\User;
use Datatables;
use File;
use DB;
use URL;

class AdminAbsenController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ta     = ta::where('status', 1)
            ->first();
        $kelas  = Kelas::where('nm_kelas', '<>', 'Lulus')->paginate(10);
        //==== filter tampilan absen agar absen di hari kemarin tidak muncul di hari ini========//
        $absens = Absens::where('date', date('Ymd'))
            ->orderBy('jam_ke')
            ->orderBy('kelas_id')
            ->get();

        //=============================================//
        return view('admin/absen/AdminAbsen', ['kelas' => $kelas, 'absens' => $absens]);
    }

    public function absen($id)
    {
        $ta = ta::where('status', 1)->first();
        $kelas  = kelas_siswa::where('kelas_id', $id)->get()->sortBy(function ($query) {
            return $query->users->name;
        });
        $kls = Kelas::where('id', $id)->first();

        return View('admin.absen.ACreateAbsen', ['kelas' => $kelas, 'ta' => $ta, 'kelas_id' => $id, 'kls' => $kls]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jam' => 'required'
        ]);

        $jum_siswa = count($request->nisn);
        $jam = count($request->jam);

        for ($x = 0; $x < $jam; $x++) {
            $cek = Absens::where([
                ['jam_ke', $request->jam[$x]],
                ['kelas_id', $request->kelas]
            ])->whereDay('created_at', date('d'))->count();
            if ($cek == 0) {
                for ($y = 0; $y < $jum_siswa; $y++) {
                    $simpan = new Absens();
                    $simpan->nisn = $request->nisn[$y];
                    $simpan->user = Auth::user()->name;
                    $simpan->kondisi = $request->input('radio' . $request->nisn[$y]);
                    $simpan->kelas_id = $request->kelas;
                    $simpan->tas_id = $request->ta;
                    $simpan->ket = $request->ket[$y];
                    $simpan->jam_ke = $request->jam[$x];
                    $simpan->smt = $request->smt;
                    $simpan->date = $request->date;
                    $simpan->save();
                }
            } else {
                Session::flash("flash_notif", [
                    "level"   => "danger",
                    "message" => "Maaf Kelas Sudah di absen"
                ]);

                return back();
            }
        }

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Absen Berhasil"
        ]);

        return redirect('guru/jurnal/kelas/' . $request->input('kelas'));
    }

    public function store1(Request $request)
    {
        $this->validate($request, [
            'jam' => 'required',
            'check' => 'required'
        ]);

        $jum_check = count($request->check);

        $jam = count($request->jam);

        for ($x = 0; $x < $jam; $x++) {
            $cek = Absens::where([
                ['jam_ke', $request->jam[$x]],
                ['kelas_id', $request->kelas],
                ['user', auth()->user()->name]
            ])->whereDay('created_at', date('d'))->count();

            if ($cek == 0) {
                for ($y = 0; $y < $jum_check; $y++) {
                    $simpan = new Absens();
                    $simpan->nisn = $request->nisn[$y];
                    $simpan->user = auth()->user()->name;
                    $simpan->kondisi = $request->input('radio' . $request->nisn[$y]);
                    $simpan->kelas_id = $request->kelas;
                    $simpan->tas_id = $request->ta;
                    $simpan->ket = $request->ket[$y];
                    $simpan->jam_ke = $request->jam[$x];
                    $simpan->smt = $request->smt;
                    $simpan->date = $request->date;
                    $simpan->save();
                }
            } else {
                Session::flash("flash_notif", [
                    "level"   => "danger",
                    "message" => "Maaf Kelas Sudah di absen"
                ]);

                return back();
            }
        }

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Absen Berhasil"
        ]);

        return redirect('guru/jurnal/kelas/' . $request->input('kelas'));
    }

    public function edit($id)
    {
        $data1 = absens::find($id);

        return view('admin/absen/edit', ['data1' => $data1]);
    }

    public function update1(Request $request, $id)
    {
        $data = Absens::find($id);
        $data->kondisi = $request->kondisi;
        $data->user = $request->user;
        $data->save();

        return redirect('/admin/AdminAbsen');
    }

    public function cetak()
    {
        $ta = ta::where('status', 1)
            ->first();
        $kelas  = Kelas::where('tas_id', $ta->id)
            ->get();
        return View('admin.absen.rekap', ['kelas' => $kelas]);
    }

    public function cetakabsen($id)
    {
        //cetak absennya masih belum ada, ini hanya view atau tampilan
        $ta = ta::where('status', 1)
            ->first();
        $absens = Absens::where([
            ['tas_id', $ta->id],
            ['kelas_id', $id],
            ['date', date('Ymd')]
        ])->get();

        $catatan = Absens::where([
            ['ket', '!=', ''],
            ['tas_id', $ta->id],
            ['kelas_id', $id],
            ['date', date('Ymd')]
        ])->get();

        return View('admin.absen.print', [
            'kelas' => Kelas::findOrFail($id),
            'absens' => $absens,
            'catn' => $catatan
        ]);
    }

    public function update(Request $request)
    {
    }

    public function printer($id)
    {
        //====================== menghitung kondisi per jam ke samping===============//
        $tanggal = date('Ymd');
        $pusing = DB::select(DB::raw("SELECT absens.kelas_id AS kelas_id , absens.nisn AS nisn, siswa.nama AS nama,
		(SELECT
		t2.kondisi FROM absens t2
         WHERE (
				(t2.date = $tanggal)
            AND (t2.kelas_id = $id)
            AND (t2.nisn = absens.nisn)
            AND (t2.jam_ke = 0)
				)
       ) AS jamKe0,
	   (SELECT
		t2.kondisi FROM absens t2
         WHERE (
				(t2.date = $tanggal)
            AND (t2.kelas_id = $id)
            AND (t2.nisn = absens.nisn)
            AND (t2.jam_ke = 1)
				)
       ) AS jamKe1,
	   (SELECT
		t2.kondisi FROM absens t2
         WHERE (
				(t2.date = $tanggal)
            AND (t2.kelas_id = $id)
            AND (t2.nisn = absens.nisn)
            AND (t2.jam_ke = 2)
				)
       ) AS jamKe2,
	   (SELECT
		t2.kondisi FROM absens t2
         WHERE (
				(t2.date = $tanggal)
            AND (t2.kelas_id = $id)
            AND (t2.nisn = absens.nisn)
            AND (t2.jam_ke = 3)
				)
       ) AS jamKe3,
	   (SELECT
		t2.kondisi FROM absens t2
         WHERE (
				(t2.date = $tanggal)
            AND (t2.kelas_id = $id)
            AND (t2.nisn = absens.nisn)
            AND (t2.jam_ke = 4)
				)
       ) AS jamKe4,
	   (SELECT
		t2.kondisi FROM absens t2
         WHERE (
				(t2.date = $tanggal)
            AND (t2.kelas_id = $id)
            AND (t2.nisn = absens.nisn)
            AND (t2.jam_ke = 5)
				)
       ) AS jamKe5,
	   (SELECT
		t2.kondisi FROM absens t2
         WHERE (
				(t2.date = $tanggal)
            AND (t2.kelas_id = $id)
            AND (t2.nisn = absens.nisn)
            AND (t2.jam_ke = 6)
				)
       ) AS jamKe6,
	   (SELECT
		t2.kondisi FROM absens t2
         WHERE (
				(t2.date = $tanggal)
            AND (t2.kelas_id = $id)
            AND (t2.nisn = absens.nisn)
            AND (t2.jam_ke = 7)
				)
       ) AS jamKe7,
	   (SELECT
		t2.kondisi FROM absens t2
         WHERE (
				(t2.date = $tanggal)
            AND (t2.kelas_id = $id)
            AND (t2.nisn = absens.nisn)
            AND (t2.jam_ke = 8)
				)
       ) AS jamKe8,
	   (SELECT
		t2.kondisi FROM absens t2
         WHERE (
				(t2.date = $tanggal)
            AND (t2.kelas_id = $id)
            AND (t2.nisn = absens.nisn)
            AND (t2.jam_ke = 9)
				)
       ) AS jamKe9,
	   (SELECT
		t2.kondisi FROM absens t2
         WHERE (
				(t2.date = $tanggal)
            AND (t2.kelas_id = $id)
            AND (t2.nisn = absens.nisn)
            AND (t2.jam_ke = 10)
				)
       ) AS jamKe10,
	   (SELECT
		t2.kondisi FROM absens t2
         WHERE (
				(t2.date = $tanggal)
            AND (t2.kelas_id = $id)
            AND (t2.nisn = absens.nisn)
            AND (t2.jam_ke = 11)
				)
       ) AS jamKe11,
	   (SELECT
		t2.kondisi FROM absens t2
         WHERE (
				(t2.date = $tanggal)
            AND (t2.kelas_id = $id)
            AND (t2.nisn = absens.nisn)
            AND (t2.jam_ke = 12)
				)
       ) AS jamKe12,
       (SELECT
		t2.kondisi FROM absens t2
         WHERE (
				(t2.date = $tanggal)
            AND (t2.kelas_id = $id)
            AND (t2.nisn = absens.nisn)
            AND (t2.jam_ke = 13)
				)
       ) AS jamKe13
		FROM absens , siswa
	   WHERE ((absens.date = $tanggal)
		  AND (absens.kelas_id = $id)
		  AND (absens.nisn = siswa.nisn))
	   GROUP
		  BY absens.nisn;
		  "));
        //=========================================================//

        $cariAlpa = absens::whereMonth('created_at', date('m'))
            ->where([
                ['kelas_id', $id],
                ['kondisi', 'like', 'alpa']
            ])
            ->get(array('nisn', 'kondisi', 'updated_at'));

        return View('admin.absen.printer', ['siswas' => $pusing, 'alpa' => $cariAlpa]);
    }

    public function formPass()
    {
        return view('/admin/formPass');
    }

    public function updatePass(Request $request)
    {
        $old = $request->old;
        $new = $request->newP;

        if (!Hash::check($old, Auth::user()->password)) {
            Session::flash("flash_notif", [
                "level"   => "danger",
                "message" => "password lama tidak cocok"
            ]);
            return view('/admin/formPass');
        } else {
            Auth::user()->fill(['password' => Hash::make($new)])->save();
        }

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Ganti Password Berhasil"
        ]);

        return view('/admin/formPass');
    }

    public function UploadIndex()
    {
        $guru = Gurus::where('nama', Auth::user()->name)->first();
        $tas = ta::where('status', 1)->first();
        $files = upload::where([
            ['gurus_id', $guru->id],
            ['tas', $tas->id],
        ])->get();
        $mapel = mapels::all();
        return view('/admin/jurnal/UploadIndex', ['files' => $files, 'mapels' => $mapel]);
    }

    public function saveUpload(Request $request)
    {
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

        $tempatUpload = 'upload';
        $file = $request->file('nama_type');
        $file->move($tempatUpload, $rename);

        $simpan = DB::table('uploads')->insert([
            [
                'gurus_id' => session('gurus_id'),
                'file' => $rename,
                'tas' => $ta->id,
                'nama_file' => $request->nama_file,
                'kelas' => $request->kelas,
                'mapel' => $request->mapel
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

    public function RekapUpload()
    {
        $ta = ta::where('status', 1)
            ->first();
        $data = upload::where([
            ['tas', $ta->id],
            ['kelas', 'not like', 'ekstra'],
            ['mapel', 'not like', '----------']
        ])
            ->orderBy('gurus_id')
            ->get();
        return view('admin/jurnal/RekapUpload', ['data' => $data]);
    }

    public function noPerangkat()
    {
        $ta = ta::where('status', 1)
            ->first();
        $data = upload::where([
            ['tas', $ta->id],
            ['kelas', 'like', 'ekstra']
        ])
            ->orwhere('mapel', 'like', '----------')
            ->get();
        return view('admin/jurnal/RekapUpload', ['data' => $data]);
    }

    public function Idata()
    {
        /*============
     untuk datablesnya ada di DataTablesController dikarenakan data tabel
     tidak bisa membaca data yang harus menggunakna login jadi harus di taruk di luar dari sesi LoginController
     ==========*/
        return view('/admin/absen/IdataTables');
    }

    public function delete(Request $request, $id)
    {
        $file = upload::where('id', $id)->first();
        File::delete('upload/' . $file->file);
        $upload = upload::where('id', $id)
            ->delete();
        return redirect('/admin/perangkat')->with('message', 'hapus berhasil');
    }

    public function Rjurnal()
    {
        $kelas = Kelas::paginate(10);

        return view('/admin/jurnal/Rjurnal', ['kelas' => $kelas]);
    }

    public function rekapJur($id)
    {
        $jurnal = jurnals::where('kelas', $id)
            ->orderBy('created_at')
            ->orderBy('jam_ke')
            ->get();

        return view('/admin/jurnal/rekap', ['jurnals' => $jurnal]);
    }

    public function iRekapGuru()
    {
        return view('/admin/absen/IrekapGuru');
    }

    /**
     * @param Request $request
     */
    public function rekapGuru(Request $request)
    {
        $bulan = (substr($request->tgl, 4, 2));

        $absen = absens::whereMonth('created_at', $bulan)
            ->distinct()
            ->get(array('user'));
        $jumlah = absens::whereMonth('created_at', $bulan)
            ->distinct()
            ->count('user');


        $jurnals = jurnals::whereMonth('created_at', $bulan)
            ->distinct()
            ->get(array('user'));

        echo 'ini data mentah Pengabsen dari bulan berjumlah <b>' . $jumlah . '</b> <br>';
        echo 'bulan ' . date('F') . '</br>';
        //echo 'jumlah pengabsen berjumlah  '.$jumlah .' terdiri dari: <br>';
        $no = 1;
        $urut = 1;
        foreach ($absen as $jur) {
            echo $no++ . ' ';
            echo $jur->user . ' - ';
            echo $jur->kelas_id;
            echo '<br>';
        }
        echo '<hr>';
        echo 'yang mengisi jurnal di bulan sekrang <br>';
        foreach ($jurnals as $jurr) {
            echo $urut++ . ' ';
            echo $jurr->user . ' - ';
            echo '<br>';
        }
    }

    public function RGharian()
    {
        return view('/admin/absen/FormRekapHarian');
    }

    public function rekapGuruHarian()
    {
        return '';
    }

    public  function upUm()
    {
        $guru = Gurus::where('nama', Auth::user()->name)->first();
        $tas = ta::where('status', 1)->first();
        $files = upUm::all();
        return view('/admin/jurnal/UploadIndexUm', ['files' => $files]);
    }

    public function saveUpload1(Request $request)
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
        return redirect('/admin/UpUm');
    }

    public function del(Request $request, $id)
    {
        $file = upUm::where('id', $id)->first();
        //dd($file->file);
        File::delete('upUm/' . $file->file);
        $upload = upUm::where('id', $id)
            ->delete();
        return redirect('/admin/UpUm')->with('message', 'hapus berhasil');
    }

    public function RGB()
    {
        $bulan = date('m');
        //$bulan = 7;
        $rekaps = DB::select(DB::raw("SELECT DISTINCT a.user ,(SELECT SUM(jum) FROM RgHarian WHERE user = a.user AND SUBSTR(created_at, 6, 2) = $bulan) as jumlah
                                      FROM RgHarian a WHERE SUBSTR(created_at, 6, 2) = $bulan ORDER BY jumlah DESC"));
        return view('admin/absen/RGB', ['rekaps' => $rekaps]);
    }

    public function cRole()
    {
        $users = User::select('id', 'name')->where('status', 'guru')->orderBy('name', 'asc')->get();
        $gurus = Gurus::select('nama')->where('status', 1)->get();
        dd($gurus);
        // foreach($guru as $gurus)
        // {
        //     dd($gurus->gurus->nama);
        // }
        return view('/admin/cRole', compact('guru'));
    }

    public function listSiswa()
    {
        $user = user::where('status', 'Siswa')->get();
        $siswa = user::select('id', 'name', 'nis')->where('ket', 'A')->get();
        //dd($siswa);

        return view('admin.absen.listSiswa', compact('siswa', 'user'));
    }

    public function sisDisable($id)
    {
        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Siswa Berhasil di Disable!!!"
        ]);

        $user = user::where('id', $id)->first();
        $user->ket = '';
        $user->save();

        return back();
    }

    public function sisA(Request $request)
    {
        $cek = user::select('nis')->where([
            ['nis', $request->nis],
            ['ket', 'A']
        ])->count();
        if ($cek >= 1) {
            Session::flash("flash_notif", [
                "level"   => "danger",
                "message" => "Siswa Sudah Terdaftar !!!"
            ]);
            return back();
        }

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Siswa Berhasil!!!"
        ]);

        $user = user::where('nis', $request->nis)->first();
        $user->ket = 'A';
        $user->save();

        return back();
    }

    public function Fpoin()
    {
        $siswa = siswa::select('nisn', 'nama', 'kelas_id')->get();

        return view('admin.absen.fpoin', compact('siswa'));
    }

    public function addSsisA()
    {
        $siswa = siswa::where('status', 1)->get();

        return view('admin.absen.addSsisA', compact('siswa'));
    }

    public function saveAddSis(Request $request)
    {
        //dd($request);
        $siswa = siswa::where('nisn', $request->nis)->first();

        $simpan = new User();
        $simpan->name = $siswa->nama;
        $simpan->nis = $siswa->nisn;
        $simpan->role = 6;
        $simpan->subRole = 0;
        $simpan->ket = 'A';
        $simpan->status = 'Siswa';
        $simpan->password = bcrypt('123456');
        $simpan->email = $siswa->nisn . '@sumenepsmansa.sch.id';
        $simpan->save();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Berhasil!!!"
        ]);

        return back();
    }
}
