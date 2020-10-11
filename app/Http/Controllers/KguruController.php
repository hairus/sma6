<?php

namespace App\Http\Controllers;

use App\Models\evaluasi;
use App\Models\file_rapor;
use App\Models\guru_mapel;
use App\Models\Siswa_Lengkap;
use App\Models\soal;
use App\Models\upUm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\Kelas;
use App\Models\siswa;
use App\Models\Absens;
use App\Models\ta;
use App\Models\Gurus;
use App\Models\jurnals;
use App\Models\AbsenGuru;
use App\Models\jam;
use App\User;
use App\Models\upload;
use App\Models\mapels;
use File;
use DB;
use Illuminate\Support\Facades\Validator;


class KguruController extends Controller
{
    //semua kepentingan dari menu guru menggunakan controller disini
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $ta     = ta::where('status', 1)->first();
        $kelas  = Kelas::where('tas_id', $ta->id)->paginate(10);
        //==== filter tampilan absen agar absen di hari kemarin tidak muncul di hari ini========//
        $absens = Absens::where('date', date('Ymd'))->orderBy('jam_ke')->orderBy('kelas_id')->get();
        //$absens = Absens::where('date',date('Ymd'))->get();
        return view('guru/Adminabsen', ['kelas' => $kelas, 'absens' => $absens]);
    }

    public function absen($id)
    {
        $ta     = ta::where('status', 1)->first();
        $kelas  = Kelas::where('tas_id', $ta->id);
        dd($kelas);
        return View('guru/ACreateAbsen', ['kelas' => Kelas::findOrFail($id), 'ta' => $ta]);
    }

    public function store(Request $request)
    {
        //cek dulu di database where kelas = inputan kelas dan jam = inputan jam jika ada maka
        $cekAbsen = DB::table('absens')->where([
            ['date', '>=', $request->input('date')],
            ['kelas_id', '=', $request->input('kelas')],
            ['jam_ke', '=', $request->input('jam')]
        ])->count();

        if ($cekAbsen > 0) {
            Session::flash("flash_notif", [
                "level"   => "danger",
                "message" => "Maaf kelas ini sudah di absen"
            ]);

            return redirect('guru');
        } else {
            $query = DB::table('siswa')->where('kelas_id', $request->input('kelas'))->get();
            //loping semua data yang ada dari post dan simpan dengan methode menggunankan
            //array yang berada di $data[];
            foreach ($query as $list) {
                $data[] = array(
                    'nisn'        => $request->input('nisn' . $list->nisn),
                    'user'        => $request->input('user'),
                    'kondisi'     => $request->input('radio' . $list->nisn),
                    'kelas_id'    => $request->input('kelas'),
                    'tas_id'      => $request->input('ta'),
                    'ket'         => $request->input('ket' . $list->nisn),
                    'jam_ke'      => $request->input('jam'),
                    'smt'         => $request->input('smt'),
                    'date'        => $request->input('date'),
                    'created_at'  =>  \Carbon\Carbon::now(),
                    'updated_at'  =>  \Carbon\Carbon::now(),
                );
            }
            DB::table('absens')->insert($data);

            Session::flash("flash_notif", [
                "level"   => "success",
                "message" => "Absen Berhasil"
            ]);
            return back();
        }
    }


    public function Jindex()
    {
        //=====pengisian jurnal untuk guru===//
        $kelas = Kelas::where('nm_kelas', '<>', 'Lulus')->paginate(10);
        //untuk memunculkan tahun ajaran
        $ta = ta::where('status', 1)->first();
        //dd($ta);
        $jurnal = jurnals::where([
            ['user', Auth::user()->name],
            ['tas_id', $ta->id],
            ['tgl', date('Ymd')]
        ])->get();
        return view('guru/Jindex', ['kelas' => $kelas, 'jurnals' => $jurnal]);
    }

    public function create($id)
    {
        //cek ta yang aktif
        $tas    = ta::where('status', 1)->first();
        //jika ta ada maka filter mapel dimana ta dan semester yang aktif, maka mapel akan di munculkan
        $mapel  = mapels::where('tas_id', $tas->id)->get();
        //cek siswa dengan parameter id kelas dan munculkan
        $siswas = siswa::where('kelas_id', $id)->get();
        return view('guru/create', ['kelas' => Kelas::findOrFail($id), 'Mapel' => $mapel, 'ta' => $tas, 'siswas' => $siswas]);
    }

    public function simpan(Request $request)
    {
        $jurnal = new jurnals;
        $jurnal->semester = $request->semester;
        $jurnal->tas_id   = $request->ta;
        $jurnal->jam_ke   = $request->jam;
        $jurnal->mapel    = $request->mapel;
        $jurnal->user     = $request->user;
        $jurnal->gurus_id = $request->user_id;
        $jurnal->hari     = $request->hari;
        $jurnal->kikd_ke  = $request->kikd;
        $jurnal->materi   = $request->materi;
        $jurnal->siswa    = $request->siswa;
        $jurnal->spi      = $request->spi;
        $jurnal->sos      = $request->sos;
        $jurnal->sikap    = $request->sikap;
        $jurnal->kelas    = $request->kelas;
        $jurnal->tgl      = $request->tgl;
        $jurnal->save();
        //dd($jurnal);
        return redirect('/guru/jurnal');
    }

    public function formPass()
    {
        return view('/guru/formPass');
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
            return view('/guru/formPass');
        } else {
            Auth::user()->fill(['password' => Hash::make($new)])->save();
        }

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Ganti Password Berhasil"
        ]);

        return view('/guru/formPass');
    }

    public function show()
    {

        $ta     = ta::where('status', 1)->first();
        $kelas  = Kelas::where('tas_id', $ta->id)->paginate(10);

        //==== filter tampilan absen agar absen di hari kemarin tidak muncul di hari ini========//
        $absens = Absens::where([
            ['date', date('Ymd')],
            ['user', Auth::user()->name]
        ])->orderBy('jam_ke')->orderBy('kelas_id')->get();

        $absenSaya = Absens::select('kelas_id', 'jam_ke', 'user')->whereDate('created_at', date('Y-m-d'))
            ->where('user', Auth::user()->name)
            ->groupBy('jam_ke', 'kelas_id', 'user')
            ->orderBy('jam_ke', 'ASC')
            ->get();


        return view('guru/show', ['kelas' => $kelas, 'absens' => $absens, 'absSaya' => $absenSaya]);
    }

    public function delJam($jam)
    {
        $absen = Absens::whereDate('created_at', date('Y-m-d'))
            ->where([
                ['user', Auth::user()->name],
                ['jam_ke', $jam]
            ])->delete();

        return back();
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

    public function UploadIndex()
    {
        $guru = Gurus::where('nama', Auth::user()->name)->first();
        $tas = ta::where('status', 1)->first();
        $files = upload::where([
            ['gurus_id', $guru->id],
            ['tas', $tas->id]
        ])->get();
        $mapel = guru_mapel::where('guru_id', Auth::user()->id)->get();
        return view('/guru/UploadIndex', ['files' => $files, 'mapels' => $mapel]);
    }

    public function simpanUpload(Request $request)
    {
        //==================== cek ta id yang aktif ==============//
        //    dd($request);
        $ta = ta::where('status', 1)->first();

        $guru_id = Gurus::where('nama', Auth::user()->name)->first();
        //============ cara membuat session di laravel ==================//
        $coba = session()->put('gurus_id', $guru_id->id);

        $this->validate($request, [
            'nama_file' => 'required',
            'nama_type' => 'required|mimes:doc,docx,xls,xlsx,pdf,ppt,pptx,jpg,jpeg'
        ]);

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
        return redirect('/guru/uploadG');
    }

    public function edit($id)
    {
        $absen = Absens::find($id);
        return view('/guru/edit', ['absens' => $absen]);
    }

    public function updateSiswa(Request $request, $id)
    {
        $data = Absens::find($id);
        $data->kondisi = $request->kondisi;
        $data->user    = $request->user;
        $simpan = $data->save();
        if ($simpan) {
            Session::flash("flash_notif", [
                "level"   => "success",
                "message" => "Edit data sukses"
            ]);
        } else {
            Session::flash("flash_notif", [
                "level"   => "danger",
                "message" => "Gagal Edit data"
            ]);
        }
        return Redirect('/guru/absen');
    }

    public function editJ($id)
    {
        $ta = ta::where('status', 1)->first();
        $jurnal = jurnals::find($id);
        $mapel = mapels::where('tas_id', $ta->id)->get();
        return view('/guru/editJur', ['kelas' => $jurnal, 'Mapel' => $mapel]);
    }

    public function hapus(Request $request, $id)
    {
        $jurnal = jurnals::where('id', $id)->delete();
        return redirect('guru/jurnal');
    }

    public function hapusUpload(Request $request, $id)
    {
        $file = upload::where('id', $id)->first();
        //dd($file->file);
        File::delete('upload/' . $file->file);
        $upload = upload::where('id', $id)->delete();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Hapus Berhasil"
        ]);

        return back();
    }

    public  function doc()
    {
        $guru = Gurus::where('nama', Auth::user()->name)->first();
        $tas = ta::where('status', 1)->first();
        $files = upUm::all();
        return view('/guru/dk', ['files' => $files]);
    }

    public function soalnya()
    {
        $evas = evaluasi::where('user_id', Auth::user()->id)->get();

        return view('guru.evaluasi.index', compact('evas'));
    }

    public function mapels(Request $request)
    {
        $soals = soal::where('mapel_id', $request->mapel_id)->orderBy('rombel', 'ASC')->get();
        $mapels = mapels::where('id', $request->mapel_id)->first();

        return view('guru.evaluasi.soal', compact('soals', 'mapels'));
    }

    public function uploadRapor()
    {
        $kls = Kelas::where([
            ['kat_kelas', '!=', 'XII']
        ])->get();

        return view('guru.evaluasi.uploadRapor', compact('kls'));
    }

    public function kelas_id(Request $request)
    {
        $step = 1;
        $siswas = siswa::where('kelas_id', $request->kelas_id)->get();
        $kls = Kelas::where([
            ['kat_kelas', '!=', 'XII']
        ])->get();
        $kelas_terpilih = Kelas::where('id', $request->kelas_id)->first();

        return view('guru.evaluasi.uploadRapor', compact('kls', 'step', 'siswas', 'kelas_terpilih'));
    }

    public function saveFileRapor(Request $request)
    {
        $tempatUpload = 'file_rapor';
        $siswa_id = siswa::where('kelas_id', $request->kelas_id)->get();
        $validation = $request->validate([
            'rapor.*' => 'required|file|mimes:pdf'
        ]);

        //        $cek = count($request->nis);
        //        if($cek >= 1)
        //        {
        //            Session::flash("flash_notif", [
        //                "level"   => "danger",
        //                "message" => "Data di kelas tersebut sudah ada silakan cek di Hasil unggahan rapor"
        //            ]);
        //
        //            return redirect('/guru/evaluasi/uploadRapor');
        //        }

        for ($x = 0; $x < count($request->nis); $x++) {
            $file = $request->file('rapor')[$x];
            $file->move($tempatUpload, $file->getClientOriginalName());

            $sim = new file_rapor();
            $sim->siswa_id = $request->nis[$x];
            $sim->user_id = Auth::user()->id;
            $sim->rapor = $file->getClientOriginalName();
            $sim->save();
        }

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Upload data rapor sukses"
        ]);

        return redirect('/guru/evaluasi/uploadRapor');
    }

    public function HUR()
    {
        $my_unggahan = file_rapor::where('user_id', Auth::user()->id)->get();

        $kls = Kelas::where([
            ['kat_kelas', '!=', 'XII']
        ])->get();

        return view('guru.evaluasi.hur', compact('my_unggahan', 'kls'));
    }

    public function delHur($id)
    {
        $del = file_rapor::where([
            ['user_id', Auth::user()->id],
            ['id', $id]
        ])->delete();

        Session::flash("flash_notif", [
            "level"   => "danger",
            "message" => "Delete data rapor sukses"
        ]);

        return back();
    }

    public function upSatuRapor(Request $request)
    {

        $siswas = siswa::where('kelas_id', $request->kelas_id)->get();

        return view('guru.evaluasi.uploadRaporSatu', compact('siswas'));
    }

    public function saveSatuFileRapor(Request $request)
    {
        $id_siswa = file_rapor::where('siswa_id', $request->siswa_id)->get();
        if (count($id_siswa) >= 1) {
            Session::flash("flash_notif", [
                "level"   => "danger",
                "message" => "Maaf user ini datanya sudah ada"
            ]);
            return redirect('guru/evaluasi/HUR');
        }


        $tempatUpload = 'file_rapor';
        $file = $request->file('rapor');
        $file->move($tempatUpload, $file->getClientOriginalName());

        $sim = new file_rapor();
        $sim->siswa_id = $request->siswa_id;
        $sim->user_id = Auth::user()->id;
        $sim->rapor = $file->getClientOriginalName();
        $sim->save();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Upload data satuan sukses"
        ]);

        return redirect('guru/evaluasi/HUR');
    }

    public function casisLeng()
    {
        $siswa_leng = Siswa_Lengkap::all();
        $siswa_nl = User::doesnthave('ppdbSiswaLeng')->where('role', 98)->get();
        //        dd($siswa_nl);

        return view('ppdb.siswa_leng', compact('siswa_leng', 'siswa_nl'));
    }
}
