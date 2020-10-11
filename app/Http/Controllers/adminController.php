<?php

namespace App\Http\Controllers;

use App\Models\Absens;
use App\Models\angket_nilai;
use App\Models\asisten;
use App\Models\evaluasi;
use App\Models\file_rapor;
use App\Models\guru_mapel;
use App\Models\kd;
use App\Models\kdMapel;
use App\Models\Kelas;
use App\Models\mapel_kelas;
use App\Models\mapels;
use App\Models\mstUkbm;
use App\Models\ppd;
use App\Models\Role;
use App\Models\ta;
use App\pkd;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\User;
use App\Models\siswa;
use App\Models\Gurus;
use App\Models\kelas_siswa;
use App\Models\mapelKelas;
use App\Models\pa;
use App\Models\ppdb_profile;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation;
use Auth;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class adminController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function showlist()
    {
        $userGuru = Gurus::select('nama')->where('status', 1)->get();

        return view('/admin/showlist', compact('userGuru'));
    }

    public function update(Request $request)
    {
        dd('kesini');
        $user           = User::where('id', $request->id)->first();
        $user->password = bcrypt(123456);
        $user->save();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Sukses Ganti Password (123456)"
        ]);

        return back();
    }

    public function showlistsiswa()
    {
        $siswas = siswa::select('nisn', 'nama', 'kelas_id')->where('status', 1)->get();

        return view('/admin/showlistsiswa', compact('siswas'));
    }

    public function resetSiswa(Request $request)
    {
        dd($request);
        $siswa           = user::where('nis', $request->nis)->first();
        dd($siswa);
        $siswa->password = bcrypt('123456');
        $siswa->save();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Sukses Ganti Password (123456)"
        ]);

        return back();
    }

    public function SetGU()
    {
        $guru  = User::where('subRole', 1)->get();
        $mapel = mapels::where('ket', 'sks')->get();

        return view('admin.admins.setGu', compact('guru', 'mapel'));
    }

    public function simpGU(Request $request)
    {
        //dd($request);
        $cek_guru = mstUkbm::where([
            ['guru_id', $request->guru_id],
            ['mapel_id', $request->mapel_id],
        ])->count();

        if ($cek_guru == 0) {
            $ambil = mstUkbm::where('guru_id', $request->guru_id2)->get();
            foreach ($ambil as $data) {
                $simpan           = new mstUkbm();
                $simpan->kdRpp    = $data->kdRpp;
                $simpan->kdKbm    = $data->kdKbm;
                $simpan->jdlKbm   = $data->jdlKbm;
                $simpan->smt      = $data->smt;
                $simpan->mapel_id = $data->mapel_id;
                $simpan->kode     = $data->kode;
                $simpan->kat      = $data->kat;
                $simpan->guru_id  = $request->guru_id;
                $simpan->save();
            }
        } else {
            Session::flash("flash_notif", [
                "level"   => "danger",
                "message" => "guru sudah ada di master ukbm"
            ]);

            return back();
        }
        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Sukses memasukkan data"
        ]);

        return back();
    }

    public function csb()
    {
        $tas   = ta::where('status', 1)->first();
        $kelas = Kelas::all();
        $siswa = siswa::where('kelas_id', '!=', 0)->get();
        $users = User::where('role', 6)->get();

        return view('admin.admins.csb', compact('kelas', 'siswa', 'users'));
    }

    public function scsb(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required',
            'kelas' => 'required',
            'nis'   => 'unique:siswa,nisn,' . $request->nis,
        ]);
        $tas = ta::where('status', 1)->first();

        /*======= simpan ke tabel siswa =============*/
        $kelas = Kelas::where('id', $request->kelas)->first();

        $siswa           = new siswa();
        $siswa->nisn     = $request->nis;
        $siswa->nama     = $request->name;
        $siswa->kelas_id = $request->kelas;
        $siswa->status   = 1;
        $siswa->kat_kls  = $kelas->kat_kelas;
        $siswa->save();

        /*===============================================*/

        /*================= simpan ke tabel user ==================*/
        $user           = new User();
        $user->name     = $request->name;
        $user->nis      = $request->nis;
        $user->role     = 6;
        $user->password = bcrypt('12345678');
        $user->email    = $request->nis . '@smansa.com';
        $user->subrole  = 0;
        $user->username = $request->nis;
        $user->status   = 'Siswa';
        $user->save();
        /*=========================================================*/

        /*============= simpan ke kelas_siswa =================*/
        $cari = User::where('nis', $request->nis)->first();
        $ta = ta::where('status', 1)->first();
        $cari->kelas_siswas()->create([
            'kelas_id' => $request->kelas,
            'nis' => $cari->nis,
            'tas_id' => $ta->id,
        ]);
        /*=======================================================*/
        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Sukses memasukkan data"
        ]);

        return back();
    }

    public function delsiswa()
    {
        $siswa = user::where('role', 6)->get();

        return view('admin.admins.delsiswa', compact('siswa'));
    }

    public function del(Request $request)
    {
        $siswa = siswa::where('nisn', $request->nis)->first();
        $file_rapor = file_rapor::where('siswa_id', $siswa->id)->delete();
        $siswa->delete();
        $absen = Absens::where('nisn', $request->nis)->delete();
        $ppds = ppd::where('nis', $request->nis)->delete();
        $user           = User::where('nis', $request->nis)->first();
        $kelas_siswa = kelas_siswa::where('user_id', $user->id)->delete();
        $user->delete();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Sukses menghapus data"
        ]);

        return back();
    }

    public function Cuser()
    {
        $role = Role::all();
        $users = User::orderBy('role', 'ASC')->orderBy('name', 'ASC')->get();

        return view('admin.admins.cuser', compact('role', 'users'));
    }

    public function Suser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users,email,' . $request->email,
            'name' => 'required',
            'nip' => 'required',
        ]);

        $role = Role::where('role_id', $request->role)->first();

        $user           = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->role     = $request->role;
        $user->subRole  = 0;
        $user->nis      = 0;
        $user->status   = $role->ket;
        $user->password = bcrypt('123456');
        $user->save();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Sukses Meyimpan data"
        ]);

        return back();
    }

    public function siswanya()
    {
        $siswa = siswa::with('siswa', 'kelas')->where('nisn', 17396)->first();
        dd($siswa->siswa);
    }

    public function key()
    {
        return view('admin.key');
    }

    public function pm(Request $request)
    {
        /*cek dulu apakah ada 2 mapel jika ada maka query harus berbeda*/
        $cek = guru_mapel::where('guru_id', auth()->user()->id)->count('guru_id');
        if ($cek > 1) {
            $kd = kdMapel::where([
                ['mapel_id', $request->mapel],
                ['kat', $request->rombel]
            ])->get();

            return $kd;
        } else {
            $kd = kdMapel::where([
                ['mapel_id', $request->mapel],
                ['kat', $request->rombel]
            ])->get();

            return $kd;
        }
    }

    public function asisten()
    {
        $asisten = asisten::all();
        $user = User::where('role', 2)->get();

        return view('admin.admins.asisten', compact('asisten', 'user'));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $simpan = new asisten();
        $simpan->user_id = $request->name;
        $simpan->save();

        return back();
    }

    public function delusers(Request $request)
    {
        $user = User::findOrFail($request->user_id)->delete();

        return back();
    }
    public function delUser($id)
    {
        $user = asisten::findorFail($id);
        $user->delete();

        return back();
    }
    //
    //    public function kdKat($kat)
    //    {
    //        $kdnya = kdMapel::where([
    //            ['mapel_id', 155],
    //            ['kat', $kat]
    //        ])->get();
    //
    //        return $kdnya;
    //    }
    public function wa()
    {
        $nomor = array(
            '+6282257311352', '+6281213967357', '+6281931069240'
        );
        $nama = 'hairus';
        $jum = count($nomor);
        for ($x = 0; $x < $jum; $x++) {
            $my_apikey = "QP4O2AMRTLIPRVWNKKT1";
            $destination = $nomor[$x];
            $message = "Mohon perhatian saya yang bernama " . $nama . " telah masuk jam 07:00 WIB nama tersebut itu dari variable bukan manual";
            $api_url = "http://panel.rapiwha.com/send_message.php";
            $api_url .= "?apikey=" . urlencode($my_apikey);
            $api_url .= "&number=" . urlencode($destination);
            $api_url .= "&text=" . urlencode($message);
            $my_result_object = json_decode(file_get_contents($api_url, false));
            echo "<br>Result: " . $my_result_object->success;
            echo "<br>Description: " . $my_result_object->description;
            echo "<br>Code: " . $my_result_object->result_code;
        }
        //        $nama = array([
        //           'hairus1', 'hairus2', 'hairus3'
        //        ]);
        //        for ($x = 0; $x < 3; $x++)
        //        {
        ////            dd($nama);
        //            echo $nama[0][$x] .'<br>';
        //        }

    }

    public function inputEva()
    {
        $evas = evaluasi::all();
        $users = User::where('role', 2)->get();
        $mapels = mapels::where([
            ['ket', 'sks']
        ])->get();

        return view('admin.teva', compact('users', 'mapels', 'evas'));
    }

    public function saveEva(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'mapel_id' => 'required'
        ]);

        $simpan = new evaluasi();
        $simpan->user_id = $request->user_id;
        $simpan->mapel_id = $request->mapel_id;
        $simpan->save();

        return back();
    }

    public function DelEva(Request $request)
    {
        evaluasi::findorFail($request->user_id)->delete();

        return back();
    }

    public function mapKel()
    {
        $mapkel = mapel_kelas::orderBy('tas_id', 'DESC')->orderBy('kelas_id', 'ASC')->get();
        $mapels = mapels::where([
            ['ket', 'sks'],
        ])->get();

        $kelas = Kelas::all();

        return view('admin.admins.mapkel', compact('mapels', 'kelas', 'mapkel'));
    }

    public function saveMapKel(Request $request)
    {
        $jum_array = count($request->mapel);
        $ta = ta::where('status', 1)->first();

        for ($x = 0; $x < $jum_array; $x++) {
            $cek = mapel_kelas::where([
                ['mapel_id', $request->mapel[$x]],
                ['kelas_id', $request->kelas],
                ['tas_id', $ta->id]
            ])->count();
            if ($cek >= 1) {
                return back()->with('message', ' Maaf kelas atau mapel di ta sekarang ada');
            } else {
                $simpan           = new mapel_kelas();
                $simpan->kelas_id = $request->kelas;
                $simpan->mapel_id = $request->mapel[$x];
                $simpan->tas_id   = $ta->id;
                $simpan->save();
            }
        }

        return back()->with('pesan', 'Penyimpanan berhasil');
    }

    public function delMapKel($id)
    {
        $del = mapel_kelas::where('id', $id)->delete();

        return back()->with('message', 'Hapus Berhasil');
    }

    public function cata()
    {
        $tas = ta::all();

        return view('admin.cata', compact('tas'));
    }

    public function saveTa(Request $request)
    {
        $this->validate($request, [
            'ta' => 'required',
            'tapel' => 'required',
            'smt'    => 'required',
        ]);

        $ta = new ta();
        $ta->ta = $request->ta;
        $ta->tahun = $request->tapel;
        $ta->semester = $request->smt;
        $ta->status = 0;
        $ta->save();

        return back();
    }

    public function aktifTa($id)
    {
        $ta = ta::all();
        foreach ($ta as $data) {
            $data->status = 0;
            $data->save();
        }

        $aktif = ta::where('id', $id)->first();
        $aktif->status = 1;
        $aktif->save();

        /*  membuat mapel kelas dengan ta baru */
        $cek = mapel_kelas::where('tas_id', $aktif->id)->count();

        if ($cek == 0) {
            $create = mapel_kelas::where('tas_id', 6)->get();
            foreach ($create as $data) {
                $simpan = new mapel_kelas();
                $simpan->tas_id = $aktif->id;
                $simpan->kelas_id = $data->kelas_id;
                $simpan->mapel_id = $data->mapel_id;
                $simpan->save();
            }
        }

        return back();
    }

    public function NonAktifTa($id)
    {
        $ta = ta::where('id', $id)->first();
        $ta->status = 0;
        $ta->save();

        return back();
    }

    public function updatePpd()
    {
        $mapelLawas = mapels::where('ket', 'sks')->get();
        $mapels = mapels::where('id', '>=', 140)->get();

        return view('admin.updatePpd', compact('mapelLawas', 'mapels'));
    }

    public function mapelPpd(Request $request)
    {
        $ppd = ppd::where([
            ['ta_id', 4],
            ['mapel_id', $request->ml]
        ])->count();

        return $ppd;
    }

    public function saveMapelPpd(Request $request)
    {
        $nilai_lama = ppd::where([
            ['ta_id', 4],
            ['mapel_id', $request->mapelLawas]
        ])->get();

        foreach ($nilai_lama as $data) {
            $data->mapel_id = $request->mapelBaru;
            $data->save();
        }

        return back();
    }

    public function resetSiswaAll()
    {
        $siswaAll = User::where('role', 6)->get();
        foreach ($siswaAll as $data) {
            $update = User::where('id', $data->id)->first();
            $update->password = bcrypt('12345678');
            $update->save();
        }

        return 'berhasil mengupdate password seluruh siswa sman 1 sumenep';
    }

    public function DelNilai()
    {
        $siswa = ppdb_profile::whereYear('created_at', 2020)->get();

        return view('admin.siba.delNilai', compact('siswa'));
    }

    public function sibaMipa()
    {
        $siba = ppdb_profile::where('minat_id', 1)->whereYear('created_at', 2020)->get();


        return view('admin.siba.mipa', compact('siba'));
    }

    public function sibaIps()
    {
        $siba = ppdb_profile::where('minat_id', 2)->whereYear('created_at', 2020)->get();


        return view('admin.siba.mipa', compact('siba'));
    }

    public function Dnilai($id)
    {
        $angket = angket_nilai::where('user_id', $id)->delete();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "lana kamu sukses mendelete nilai siswa tersebut"
        ]);

        return back();
    }

    public function stin()
    {
        $user = user::doesnthave('sibaNilai')->where('role', 99)->get();

        return view('admin.siba.stin', compact('user'));
    }

    public function stib()
    {
        $user = user::doesnthave('ppdb')->where('role', 99)->get();

        return view('admin.siba.stib', compact('user'));
    }

    public function skn()
    {
        $user = user::where('role', 99)->get();

        return view('admin.siba.skn', compact('user'));
    }

    public function koperasi()
    {
        $users = User::with('koperasi')->where('role', 6)->get();

        return view('admin.siba.koperasi', compact('users'));
    }
    public function dKsis($id)
    {
        $kelas_siswa = kelas_siswa::where('kelas_id', $id)->get()->sortBy(function ($query) {
            return $query->users->name;
        });
        $kls = Kelas::where('id', $id)->first();

        return view('admin.admins.Ksis', compact('kelas_siswa', 'kls'));
    }

    public function delKsis($id)
    {
        $del = kelas_siswa::where('id', $id)->first();
        $update = User::where('id', $del->user_id)->first();
        $update->role = 99;
        $update->save();

        $name = $del->users->name;
        $del->forceDelete();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Delete Siswa Dari kelas berhasil $name"
        ]);

        return back();
    }

    public function mapSis()
    {
        $kelas = Kelas::get();

        $siswas = kelas_siswa::where('kelas_id', '<>', 31)->orderby('kelas_id')->get();

        return view('admin.admins.mapSis', compact('kelas', 'siswas'));
    }

    public function editKsis($id)
    {
        $kelas_siswa = kelas_siswa::where('id', $id)->first();
        $user_id = User::where('id', $kelas_siswa->user_id)->first();

        return view('admin.editKsis', compact('user_id'));
    }

    public function updateKsis(Request $request)
    {
        // udpate di tabel users
        $user = User::where('id', $request->id)->first();
        $user->nis = $request->nis;
        $user->username = $request->nis;
        $user->save();

        $kelas_siswa = kelas_siswa::where('user_id', $request->id)->first();
        $kelas_siswa->nis = $request->nis;
        $kelas_siswa->save();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "sukses update nis"
        ]);

        return back();
    }

    public function upklsSiswa(Request $request)
    {
        $ta = ta::where('status', 1)->first();

        $kelas_siswa = kelas_siswa::where([
            ['kelas_id', $request->kl],
            ['tas_id', '!=', $ta->id]
        ])->get();
        // dd($kelas_siswa);
        foreach ($kelas_siswa as $data) {
            $upt = kelas_siswa::where('user_id', $data->user_id)->first();
            $upt->kelas_id = $request->kl_br;
            $upt->tas_id = $ta->id;
            $upt->save();
        }

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Sukses Update Siswa"
        ]);

        return back();
    }

    public function role99()
    {
        $kelas = kelas::all();

        $users = User::doesnthave('kelas_siswas')->where('role', 99)->whereYear('updated_at', 2020)->get();

        return view('admin.admins.sisKelas', compact('kelas', 'users'));
    }

    public function sibaRole(Request $request)
    {
        $jumlah = count($request->siba);
        $ta = ta::where('status', 1)->first();
        for ($x = 0; $x < $jumlah; $x++) {
            $simpan = new kelas_siswa();
            $simpan->user_id = $request->siba[$x];
            $simpan->kelas_id = $request->kelas_id;
            $simpan->tas_id = $ta->id;


            $user = User::where('id', $request->siba[$x])->first();
            $user->role = 6;
            $simpan->nis = $user->nis;
            $simpan->save();
            $user->save();
        }

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Sukses Input  Siswa"
        ]);

        return back();
    }

    public function skkls()
    {
        dd('kesini');
    }

    public function downloadSiswa($id)
    {
        $kls = kelas_siswa::where('kelas_id', $id)->get();
        $nm_kelas = Kelas::where('id', $id)->first();
        foreach ($kls as $data) {
            $gg[] = User::select('nis', 'username', 'name')->where('id', $data->user_id)->orderBy('name')->first();
        }
        $jadi = collect($gg);

        return Excel::create($nm_kelas->nm_kelas, function ($excel) use ($jadi, $nm_kelas) {
            $excel->sheet($nm_kelas->nm_kelas, function ($sheet) use ($jadi) {
                $sheet->fromArray($jadi);
            });
        })->download('xlsx');
    }

    public function updateNis(Request $request)
    {
        // dd($request);
        Excel::load(Input::file('file'), function ($reader) {
            foreach ($reader->toArray() as $row) {
                $user = User::where('username', $row['username'])->first();
                $user->nis = $row['nis'];
                $user->save();
            }
        });

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Sukses Update Nis"
        ]);

        return back();
    }

    public function setinganPa()
    {
        $user = User::where('role', '<', 5)->get();
        $kelas = Kelas::all();
        $pa = pa::all()->sortBy(function ($query) {
            return $query->kelas->id;
        });

        return view('admin.admins.pa', compact('pa', 'user', 'kelas'));
    }

    public function savePa(Request $request)
    {
        $simPa = new pa();
        $simPa->guru_id = $request->guru_id;
        $simPa->kelas_id = $request->kelas_id;
        $simPa->save();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Sukses Menambah Wali"
        ]);

        return back();
    }

    public function delPa($id)
    {
        $pa = pa::find($id);
        $pa->delete();

        Session::flash("flash_notif", [
            "level"   => "danger",
            "message" => "Sukses Menghapus Wali"
        ]);


        return back();
    }

    public function gm()
    {
        $guru = User::where('role', '<', 5)->get();
        $gm = guru_mapel::orderBy('nama', 'ASC')->get();
        $mapels = mapels::all();

        return view('admin.admins.gm', compact('gm', 'guru', 'mapels'));
    }

    public function saveGm(Request $request)
    {

        $this->validate($request, [
            'user_id' => 'required',
            'mapel_id' => 'required'
        ]);

        $user = User::where('id', $request->user_id)->first();
        $mapel = mapels::where('id', $request->mapel_id)->first();

        $sim = new guru_mapel();
        $sim->guru_id = $request->user_id;
        $sim->mapel_id = $request->mapel_id;
        $sim->nama = $user->name;
        $sim->mapel = $mapel->mapel;
        $sim->save();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Sukses Input  Guru Mapel"
        ]);

        return back();
    }

    public function delgm($id)
    {
        $del = guru_mapel::find($id);
        $del->delete();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Sukses Delete Guru Mapel"
        ]);

        return back();
    }

    public function kls()
    {
        $kelas = Kelas::where('id', '<>', 31)->get();

        return view('admin.admins.kelas', compact('kelas'));
    }

    public function saveKls(Request $request)
    {
        $this->validate($request, [
            'kelas' => 'required'
        ]);

        $kelas = new Kelas();
        $kelas->kd_kelas = random_int(1, 50);
        $kelas->nm_kelas = $request->kelas;
        $kelas->tas_id = 0;
        $kelas->sks = 1;
        $kelas->jur_id = 0;
        $kelas->save();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "penyimpanan Kelas Sukses"
        ]);

        return back();
    }

    public function setMapKel()
    {
        $ta = ta::where('status', 1)->first();
        $mapel_kelas = mapelKelas::where('tas_id', $ta->id)->orderBy('kelas_id', 'ASC')->get();
        $kelas = Kelas::where('id', '<>', 31)->get();
        $mapels = mapels::all();

        return view('admin.admins.mapelKelas', compact('mapel_kelas', 'kelas', 'mapels'));
    }

    public function saveMapelKelas(Request $request)
    {
        $this->validate($request, [
            'kelas_id' => 'required',
            'mapel_id' => 'required'
        ]);

        $ta = ta::where('status', 1)->first();
        $jum = count($request->mapel_id);
        for ($x = 0; $x < $jum; $x++) {
            $sim = new mapel_kelas();
            $sim->tas_id = $ta->id;
            $sim->mapel_id = $request->mapel_id[$x];
            $sim->kelas_id = $request->kelas_id;
            $sim->save();
        }
        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "penyimpanan Mapel kelas Sukses"
        ]);

        return back();
    }

    public function delMapelKelas($id)
    {
        mapel_kelas::find($id)->delete();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Delete Mapel kelas Sukses"
        ]);

        return back();
    }

    public function spa()
    {
        return view('admin.spa');
    }
}
