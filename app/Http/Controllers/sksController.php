<?php

namespace App\Http\Controllers;

use App\Models\file_rapor;
use App\Models\file_siswa;
use App\Models\guru_mapel;
use App\Models\imateri;
use App\Models\mapels;
use App\Models\mstUkbm;
use App\Models\NA;
use App\Models\NilaiPerKd;
use App\Models\pa;
use App\Models\PenKd;
use App\Models\ppd;
use App\Models\siswa;
use App\Models\mapel_kelas;
use App\pkd;
use File;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\kelas_siswa;
use App\Models\log_materi;
use App\Models\log_view_pkpd;
use App\Models\UpPem;
use Illuminate\Support\Facades\Auth;
use App\Models\make_kd;
use App\Models\ta;
use App\Models\mstSmt;
use App\Notifications\TaskComplate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;

use function PHPSTORM_META\map;

class sksController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //kategori memory dump (2337160858)
        /* -------- ilmu baru ternyata dengan model seperti ini kita bisa mengambil get dari html di atas--------*/
        $id_mapel = $request->mapel;
        $smt1 = $request->smt;
        /*---------------------------------------*/

        $kelas = Kelas::where('sks', 1)->paginate(10);
        $smt = mstSmt::all();
        $mapel = mstUkbm::select('mapel_id')->where('guru_id', Auth::user()->id)->distinct()->get();
        $mapelSks = mstUkbm::where([
            ['mapel_id', $id_mapel],
            ['smt', $smt1],
            ['guru_id', Auth::user()->id]
        ])->orderBy('kat', 'asc')->get();

        return view('/admin/sks/sks', [
            'kelas' => $kelas,
            'smt' => $smt,
            'mapels' => $mapel,
            'mapelSks' => $mapelSks
        ]);
    }

    public function rancMapel(Request $request, $id)
    {
        $id_mapel = mstUkbm::find($id);
        $kd_guru = $request->kdgr;
        $ukbm = mstUkbm::findOrFail($request->idUkbm);
        /* cek apakah ada nilai yg ada di mstUkb kalo ada ambil data relasi dengan tabel siswa jika tidak ada maka ambil data dari mstsiswa */
        $cekData = PenKD::select('mapel_id')->where([
            ['kd', $id],
            ['kelas_id', $request->kls],
            ['guru_id', Auth::user()->id]
        ])->count();
        $adaData = PenKd::where([
            ['mapel_id', $request->mapel],
            ['kelas_id', $request->kls],
            ['guru_id', Auth::user()->id]
        ])->count();

        if ($cekData >= 1) {
            $cekNilai = PenKD::where([
                ['guru_id', Auth::user()->id],
                ['kelas_id', $request->kls],
                ['mapel_id', $request->mapel],
                ['kd', $id],
            ])->get();
            //dd($cekNilai);
        } else {
            /*
             untuk memunculkan nilai dari kd sebelumnya maka kita cek dulu apakah ada nilai dari kd sebelumnya
             jika nilai nya ada maka kita sertakan dengan menggunakan relasi di bawah ini
             tujuannya agar nilai yang tidak tuntas tidak bisa di input
            */
            $cariMapel = PenKd::where([
                ['mapel_id', $request->mapel],
                ['guru_id', Auth::user()->id],
                ['kelas_id', $request->kls]
            ])->count();
            //dd($cariMapel);
            if ($cariMapel == 0) {
                $siswa = siswa::where('kelas_id', $request->kls)->get();
            } else {
                $cekNi = PenKD::select('nis')->where([
                    ['guru_id', Auth::user()->id],
                    ['kd', $id],
                    ['mapel_id', $request->mapel],
                    ['kelas_id', $request->kls],
                ])->count();
                if ($cekNi == 0) {
                    $cekNiSiswa = PenKD::select(['nis', 'nilai'])->where([
                        ['guru_id', Auth::user()->id],
                        ['kd', $id - 1], //ini nilai sebelumnya dengan tanda -1
                        ['kelas_id', $request->kls],
                    ])->get();
                    //dd($cekNiSiswa);
                } else {
                    $siswa = siswa::where('kelas_id', $request->kls)->get();
                }
                $siswa = siswa::where('kelas_id', $request->kls)->get();
            }
            $siswa = siswa::where('kelas_id', $request->kls)->get();
        }
        return view('admin/sks/penilaian', compact(['siswa', 'ukbm', 'cekNilai', 'cekData', 'cekNiSiswa', 'adaData', 'cariMapel']));
    }

    public function save(Request $request)
    {
        $smt = mstUkbm::select('smt')->where([
            ['mapel_id', $request->mapel],
            ['guru_id', $request->guru_id]
        ])->first();
        $acuan = mstUkbm::find($request->input('idUkbm'));
        $jum = mstUkbm::where('kdRpp', $acuan->kdRpp)->count();
        $siswa = siswa::where('kelas_id', $request->input('kelas_id'))->get();

        foreach ($siswa as $siswas1) {
            $data[] = array(
                'nis'       => $request->input('nis' . $siswas1->nisn),
                'kd'        => $request->input('idUkbm'),
                'nilai'     => $request->input('rpp' . $siswas1->nisn),
                'kelas_id'  => $request->input('kelas_id'),
                'guru_id'   => $request->input('guru_id'),
                'mapel_id'  => $request->input('mapel'),
                'kat'       => $request->input('kat'),
                'smt'       => $smt->smt,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            );
        }
        DB::table('PenKD')->insert($data);

        return back();
    }

    public function Pukbm(Request $request)
    {
        $cek_id = $request->smt;
        $smt = mstSmt::all();
        $mapel = mapels::where('ket', 'sks')->get();

        return view('admin/sks/Pukbm', compact(['smt', 'mapel']));
    }

    public function formUkbm(Request $request)
    {
        /* disini sudah di relasikan dari table mapel -> mstUkbm bisa di lihat di models->mapels */
        $mapels = mapels::find($request->mapel)->kdRpp()->where('smt', $request->smt)->get();

        if (isset($_GET['idMap'])) {
            $lists = mstUkbm::where([['mapel_id', $request->mapel], ['smt', $request->smt], ['id', $request->idMap]])->first();
            $subRpp = mstUkbm::where([
                ['kat', $lists->kat],
                ['smt', $lists->smt],
                ['mapel_id', $lists->mapel_id],
                ['kdRpp', $lists->kdRpp]
            ])->get();
            $add = mstUkbm::where([
                ['kat', $lists->kat],
                ['smt', $lists->smt],
                ['mapel_id', $lists->mapel_id],
                ['kdRpp', $lists->kdRpp]
            ])->first();
        }
        return view('admin/sks/formAdd', compact(['mapels', 'subRpp', 'add']));
    }

    public function SaveUkbm(Request $request)
    {
        /*jika pada tabel mstUkbm di kolom kdKbm = null maka di update, jika tidak maka di insert*/
        $cek = mstUkbm::where('kdRpp', $request->input('kdKbm1'))->whereNull('kdKbm')->count();
        if ($cek == 1) {
            $update = mstUkbm::where('kdRpp', $request->input('kdKbm1'))->first();
            $update->kdKbm = $request->input('kdKbm');
            $update->kat = $request->input('kat');
            $update->jdlKbm = $request->input('jdlKbm');
            $update->save();
        } else {
            $acuan = mstUkbm::where('kdRpp', $request->input('kdKbm1'))->first();
            $simpan = new mstUkbm;
            $simpan->kdRpp  = $request->input('kdKbm1');
            $simpan->kat = $request->input('kat');
            $simpan->kdKbm = $request->input('kdKbm');
            $simpan->jdlKbm = $request->input('jdlKbm');
            $simpan->smt = $acuan->smt;
            $simpan->mapel_id = $acuan->mapel_id;
            $simpan->guru_id = auth::user()->id;
            $simpan->save();
        }

        return back();
    }

    public function addKD()
    {
        $list_mapel = mapels::where('ket', 'SKS')->get();

        return view('admin/sks/formAddKd', compact('list_mapel'));
    }

    public function save1(Request $request)
    {
        $simpan = db::table('mstKd')->insert([
            [
                'kode_kd'     => $request->input('kode_kd'),
                'smt'         => $request->input('smt'),
                'kelas'       => $request->input('kelas'),
                'guru_id'     => $request->input('guru_id'),
                'mapel_id'    => $request->input('mapel'),
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now()
            ]
        ]);

        $simpanMstUkbm = DB::table('mstUkbm')->insert([
            [
                'kdRpp'       => $request->input('kode_kd'),
                'smt'         => $request->input('smt'),
                'guru_id'     => $request->input('guru_id'),
                'mapel_id'    => $request->input('mapel'),
            ]
        ]);

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Tambah KD Berhasil"
        ]);

        return back();
    }

    public function hasil()
    {

        $kelas = Kelas::select(['nm_kelas', 'id'])->where('sks', 1)->get();
        $semesters = mstSmt::select(['smt', 'id'])->get();
        $ukbm = mstUkbm::select(['id', 'jdlKbm'])->where('guru_id', Auth::user()->id)->get();

        return view('admin/sks/hasil', compact('kelas', 'semesters', 'ukbm'));
    }

    public function detail(Request $request)
    {
        $guru_id = Auth::user()->id;
        $nilais = PenKd::select(['kd', 'mapel_id', 'nis', 'nilai', 'smt', 'kat', 'id'])->where([
            ['guru_id', $guru_id],
            ['smt', $request->semester],
            ['kelas_id', $request->kelas]
        ])->get();
        return view('/admin/sks/nilai', compact('nilais'));
    }

    public function file($id)
    {
        $data = PenKd::where('id', $id)->first();
        /*query  di bawah hanya untuk menampilakan data saja*/
        $view = PenKd::with('Pfile')->where([
            ['kelas_id', $data->kelas_id],
            ['guru_id', Auth::user()->id],
            ['mapel_id', $data->mapel_id],
        ])->get();

        return view('/admin/sks/file1', compact('view'));
    }

    public function infile(Request $request)
    {
        $link = UpPem::where([
            ['mapel_id', $request->mapel],
            ['kd_id', $request->kd + 1],
            ['guru_id', Auth::user()->id]
        ])->first();

        $simpan = DB::table('file_siswa')->insert([
            'nis'       => $request->nis,
            'kd_id'     => $request->kd + 1,
            'mapel_id'  => $request->mapel,
            'link'      => $link->link,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        return back();
    }

    public function formUpt($kd, $nis)
    {
        $nilaiEdit = PenKD::select('nilai', 'kd', 'mapel_id', 'nis', 'id', 'kelas_id')->where([
            ['kd', $kd],
            ['nis', $nis],
        ])->first();

        return view('/admin/sks/formEdit', compact('nilaiEdit'));
    }

    public function update(Request $request)
    {
        $kd = $request->kd;
        $guru_id = Auth::user()->id;
        $kelas = $request->kelas_id;
        $mapel = $request->mapel_id;

        $update = PenKD::findorFail($request->id);
        $update->nilai = $request->nilai;
        $update->save();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Update Nilai Sukses"
        ]);

        return redirect('guru/sks/tempSks/' . $kd . '?kls=' . $kelas . '&kdgr=' . $guru_id . '&mapel=' . $mapel . '&idUkbm=' . $kd);
    }

    public function lengkap()
    {

        $kelas = Kelas::select(['nm_kelas', 'id'])->where('sks', 1)->get();
        $semesters = mstSmt::select(['smt', 'id'])->get();
        $ukbm = mstUkbm::select(['id', 'jdlKbm'])->where('guru_id', Auth::user()->id)->get();


        return view('admin/sks/hasil1', compact('kelas', 'semesters', 'ukbm'));
    }

    public function olah(Request $request)
    {
        $siswa = siswa::select('nisn', 'nama')->where('kelas_id', $request->kelas)->get();

        $cekAdaNilai = NilaiPerKd::select('nilai')->where([
            ['guru_id', Auth::user()->id],
            ['kelas_id', $request->kelas]
        ])->count();

        $jumKat = mstUkbm::select('kat')->where([
            ['guru_id', Auth::user()->id],
            ['smt', $request->semester]
        ])->distinct('kat')->count('kat');

        $countKat = PenKd::select('kat')->where([
            ['guru_id', Auth::user()->id],
            ['kelas_id', $request->kelas],
        ])->distinct('kat')->count('kat');

        $mapel = PenKd::select('mapel_id')->where('guru_id', Auth::user()->id)->first();
        if ($cekAdaNilai > 1) {
            DB::table('NilaiPerKd')->where([
                ['guru_id',  Auth::user()->id],
                ['smt', $request->semester],
                ['kelas_id', $request->kelas],
            ])->delete();
            foreach ($siswa as $siswas) {
                for ($x = 1; $x <= $countKat; $x++) {
                    $jumKd = PenKd::select('kd')->where([
                        ['guru_id', Auth::user()->id],
                        ['kat', $x],
                        ['smt', $request->semester],
                        ['kelas_id', $request->kelas],
                    ])->distinct('kat')->count('kd'); //hasilnya 2

                    $nilaiPerKd = PenKd::select('nilai')->where([
                        ['guru_id', Auth::user()->id],
                        ['nis', $siswas->nisn],
                        ['kat', $x],
                        ['smt', $request->semester],
                    ])->sum('nilai');
                    $olah = $nilaiPerKd / $jumKd;

                    $simpan[] = array(
                        'nis'       => $siswas->nisn,
                        'nilai'     => $olah,
                        'kat'       => $x,
                        'mapel_id'  => $mapel->mapel_id,
                        'guru_id'   => Auth::user()->id,
                        'smt'       => $request->semester,
                        'kelas_id'  => $request->kelas,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now()
                    );
                }
            }
            DB::table('NilaiPerKd')->insert($simpan);
            Session::flash("flash_notif", [
                "level"   => "success",
                "message" => "Pengolahan Nilai Sukses"
            ]);
        } else {
            foreach ($siswa as $siswas) {
                for ($x = 1; $x <= $countKat; $x++) {
                    $jumKd = PenKd::select('kd')->where([
                        ['guru_id', Auth::user()->id],
                        ['kat', $x],
                        ['smt', $request->semester],
                        ['kelas_id', $request->kelas],
                    ])->distinct('kat')->count('kd'); //masuk sini
                    //dd($jumKd);

                    $nilaiPerKd = PenKd::select('nilai')->where([
                        ['guru_id', Auth::user()->id],
                        ['nis', $siswas->nisn],
                        ['kat', $x],
                        ['smt', $request->semester],
                        ['kelas_id', $request->kelas],
                    ])->sum('nilai');
                    $olah = $nilaiPerKd / $jumKd;

                    $simpan[] = array(
                        'nis'       => $siswas->nisn,
                        'nilai'     => $olah,
                        'kat'       => $x,
                        'mapel_id'  => $mapel->mapel_id,
                        'guru_id'   => Auth::user()->id,
                        'smt'       => $request->semester,
                        'kelas_id'  => $request->kelas,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now()
                    );
                }
            }
            DB::table('NilaiPerKd')->insert($simpan);
            Session::flash("flash_notif", [
                "level"   => "success",
                "message" => "Pengolahan Nilai Sukses"
            ]);
        }

        /*
         * koding di bawah untuk menampilkan data row to coloum
         */
        for ($x = 1; $x <= $countKat; $x++) {
            $tesss[] = NilaiPerKd::select('nilai', 'nis', 'id')->where([
                ['kat', $x],
                ['guru_id', Auth::user()->id],
                ['smt', $request->semester],
                ['kelas_id', $request->kelas],
            ])->get();
        }
        //============================== disini menghitung nilai akhir ========================//
        $sis = siswa::select('nisn')->where([
            ['kelas_id', $request->kelas]
        ])->get();
        $cekNA = NA::select('nilai')->where([
            ['guru_id', Auth::user()->id],
            ['kelas_id', $request->kelas],
            ['smt', $request->semester]
        ])->count();
        $udik[] = NA::select('nilai', 'nis')->where([
            ['guru_id', Auth::user()->id],
            ['kelas_id', $request->kelas],
            ['smt', $request->semester]
        ])->get();
        if ($cekNA > 1) {
            DB::table('NA')->where([
                ['guru_id',  Auth::user()->id],
                ['smt', $request->semester],
                ['kelas_id', $request->kelas],
            ])->delete();

            foreach ($sis as $siswas) {
                $na = NilaiPerKd::select('nilai', 'nis')->where([
                    ['guru_id', Auth::user()->id],
                    ['kelas_id', $request->kelas],
                    ['nis', $siswas->nisn]
                ])->avg('nilai');

                $data[] = array(
                    'nis'       => $siswas->nisn,
                    'nilai'     => round($na),
                    'mapel_id'  => $mapel->mapel_id,
                    'guru_id'   => Auth::user()->id,
                    'smt'       => $request->semester,
                    'kelas_id'  => $request->kelas,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now()
                );
            }
            $simpan = DB::table('NA')->insert($data);
        } else {
            foreach ($sis as $siswas) {
                $na = NilaiPerKd::select('nilai', 'nis')->where([
                    ['guru_id', Auth::user()->id],
                    ['kelas_id', $request->kelas],
                    ['nis', $siswas->nisn]
                ])->avg('nilai');

                $data[] = array(
                    'nis'       => $siswas->nisn,
                    'nilai'     => round($na),
                    'mapel_id'  => $mapel->mapel_id,
                    'guru_id'   => Auth::user()->id,
                    'smt'       => $request->semester,
                    'kelas_id'  => $request->kelas,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now()
                );
            }
            $simpan = DB::table('NA')->insert($data);
        }

        //--------------------------------------------------------------------------------------//

        return view('/admin/sks/nilai1', compact('siswa', 'countKat', 'tesss', 'udik'));
    }

    public function formUh()
    {
        $kelas = Kelas::select('id', 'nm_kelas')->where('sks', 1)->get();
        $kd = mstUkbm::select('kdRpp', 'kat', 'smt')->where('guru_id', Auth::user()->id)->distinct('kdRpp')->get();

        return view('admin/sks/formUh', compact('kelas', 'kd', 'semesters'));
    }

    public function kelasid(Request $request)
    {
        $user = '';
        if (Auth::user()->role == 1) {
            $user = 'admin';
        } elseif (Auth::user()->role == 2) {
            $user = 'guru';
        } elseif (Auth::user()->role == 3) {
            $user = 'piket';
        } elseif (Auth::user()->role == 4) {
            $user = 'bk';
        } elseif (Auth::user()->role == 5) {
            $user = 'Kepala/wakasek';
        } elseif (Auth::user()->role == 6) {
            $user = 'siswa';
        } elseif (Auth::user()->role == 7) {
            $user = 'pengawas';
        }
        $adaData = PenKd::where([
            ['guru_id', Auth::user()->id],
            ['kelas_id', $request->kelas]
        ])->count();
        if ($adaData > 0) {
            return redirect($user . '/sks/showKelas/' . $request->kelas . '?kd=' . $request->kd);
        } else {
            Session::flash("flash_notif", [
                "level"   => "danger",
                "message" => "Silakan Isi Penilaian Ukbm"
            ]);
            return redirect($user . '/sks/formuh/');
        }
    }

    public function showKelas(Request $request, $kelas_id)
    {

        $cekdulu = PenKd::where([
            ['kd', 'UH-' . $request->kd],
            ['kelas_id', $kelas_id],
            ['guru_id', Auth::user()->id]
        ])->count();
        //dd($cekdulu);
        if ($cekdulu > 1) {
            $showDatas = PenKd::select('nis', 'nilai', 'kd', 'guru_id', 'kelas_id', 'id')->where([
                ['kd', 'UH-' . $request->kd],
                ['kelas_id', $kelas_id],
                ['guru_id', Auth::user()->id]
            ])->get();

            return view('admin/sks/upUH', compact('showDatas'));
        } else {
            $cariKat = mstUkbm::select('kat', 'smt', 'kdRpp')->where('KdRpp', $request->kd)->first();
            $siswa = siswa::where('kelas_id', $kelas_id)->get();

            return view('admin/sks/PenUH', compact('siswa', 'cariKat'));
        }
    }

    public function updateUH(Request $request)
    {
        $upUH = PenKd::where([
            ['kd', $request->kd],
            ['guru_id', $request->guru_id],
            ['kelas_id', $request->kelas_id],
        ])->get();

        foreach ($upUH as $siswa) {
            //dump($request->input('nilai'.$siswa->nis));
            DB::table('PenKD')
                ->where('id', $request->id . $siswa->id)
                ->where('guru_id', $request->guru_id)
                ->where('kelas_id', $request->kelas_id)
                ->update([
                    'nilai' => $request->input('nilai' . $siswa->nis)
                ]);
        }

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Berhasil Edit Nilai Ulangan Harian"
        ]);

        return back();
    }

    public function simUH(Request $request)
    {
        $user = '';
        if (Auth::user()->role == 1) {
            $user = 'admin';
        } elseif (Auth::user()->role == 2) {
            $user = 'guru';
        } elseif (Auth::user()->role == 3) {
            $user = 'piket';
        } elseif (Auth::user()->role == 4) {
            $user = 'bk';
        } elseif (Auth::user()->role == 5) {
            $user = 'Kepala/wakasek';
        } elseif (Auth::user()->role == 6) {
            $user = 'siswa';
        } elseif (Auth::user()->role == 7) {
            $user = 'pengawas';
        }

        $kd = mstUkbm::where([
            ['kdRpp', $request->kd],
            ['guru_id', Auth::user()->id],
        ])->first();

        $siswas = siswa::select('nisn')->where('kelas_id', $request->kelas)->get();

        foreach ($siswas as $siswa) {
            $data[] = array(
                'nis'       => $request->input('nis' . $siswa->nisn),
                'kelas_id'  => $request->kelas,
                'kat'       => $kd->kat,
                'kd'        => 'UH-' . $request->kd,
                'nilai'     => $request->input('nilai' . $siswa->nisn),
                'smt'       => $kd->smt,
                'mapel_id'  => $kd->mapel_id,
                'guru_id'   => $kd->guru_id,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            );
        }
        $simpan = DB::table('PenKD')->insert($data);

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "BERHASIL MEMASUKKAN NILAI ULANGAN HARIAN"
        ]);

        return back();
    }

    public function indexUp()
    {
        $kelas = Kelas::select('kat_kelas')->where('sks', 1)->distinct('kat_kelas')->get();
        //dd($kelas);
        $ukbms = mstUkbm::where('guru_id', Auth::user()->id)->get();
        $UpPems = UpPem::where('guru_id', Auth::user()->id)->OrderBy('kd_id', 'asc')->get();

        return view('/admin/sks/UploadIndex', compact('kelas', 'UpPems', 'ukbms'));
    }

    public function saveUp(Request $request)
    {
        $cekFile = UpPem::select('id')->where('guru_id', Auth::user()->id)->count();

        $guru_id = User::where('id', Auth::user()->id)->first();
        $mapel = mstUkbm::where('guru_id', Auth::user()->id)->first();
        //============ cara membuat session di laravel ==================//
        $coba = session()->put('gurus_id', $guru_id->id);

        $this->validate($request, [
            'nama_file' => 'required',
            'nama_type' => 'required|mimes:doc,docx,xls,xlsx,pdf,ppt,pptx,jpg,jpeg,png|max:250000',
        ]);
        //================== mengambil ekstensi dari file ======================//
        $ekstensi = $request->nama_type->getClientOriginalExtension();
        //====== mengubah nama file =====================//
        $rename = 'smansaPem' . rand(11111, 99999) . '.' . $ekstensi;

        $tempatUpload = 'UpPem';
        $file = $request->file('nama_type');
        $file->move($tempatUpload, $rename);

        $simpan = DB::table('UpPem')->insert([
            [
                'guru_id' => Auth::user()->id,
                'namaFile' => $request->nama_file,
                'kat_kls' => $request->kelas,
                'mapel_id' => $mapel->mapel_id,
                'kd_id'     => $request->kd,
                'link'      => $rename,
                'smt'       => $request->semester,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
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
        $user = '';
        if (Auth::user()->role == 1) {
            $user = 'admin';
        } elseif (Auth::user()->role == 2) {
            $user = 'guru';
        } elseif (Auth::user()->role == 3) {
            $user = 'piket';
        } elseif (Auth::user()->role == 4) {
            $user = 'bk';
        } elseif (Auth::user()->role == 5) {
            $user = 'Kepala/wakasek';
        } elseif (Auth::user()->role == 6) {
            $user = 'siswa';
        } elseif (Auth::user()->role == 7) {
            $user = 'pengawas';
        }

        return redirect('/' . $user . '/sks/up');
    }
    public function hapusUpload(Request $request, $id)
    {
        $file = UpPem::where('id', $id)->first();
        //dd($file->link);
        File::delete('UpPem/' . $file->link);
        $upload = UpPem::where('id', $id)->delete();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Hapus Berhasil"
        ]);

        return back();
    }

    public function respon(Request $request)
    {
        $ukbm = mstUkbm::where([
            ['mapel_id', $request->mapel],
            ['smt', $request->smt],
            ['id', $request->idMap]
        ])->first();
        $data = mstUkbm::where([
            ['mapel_id', $ukbm->mapel_id],
            ['kat', $ukbm->kat],
        ])->count();

        return ($request->smt);
    }

    public function inkel()
    {
        $user = '';
        if (Auth::user()->role == 1) {
            $user = 'admin';
        } elseif (Auth::user()->role == 2) {
            $user = 'guru';
        } elseif (Auth::user()->role == 3) {
            $user = 'piket';
        } elseif (Auth::user()->role == 4) {
            $user = 'bk';
        } elseif (Auth::user()->role == 5) {
            $user = 'Kepala/wakasek';
        } elseif (Auth::user()->role == 6) {
            $user = 'siswa';
        } elseif (Auth::user()->role == 7) {
            $user = 'pengawas';
        }

        $kelas = Kelas::where('sks', 1)->get();
        $smt = mstSmt::all();

        return view('/admin/sks/inkel', compact('kelas', 'smt'));
    }

    public function header(Request $request)
    {
        $user = '';
        if (Auth::user()->role == 1) {
            $user = 'admin';
        } elseif (Auth::user()->role == 2) {
            $user = 'guru';
        } elseif (Auth::user()->role == 3) {
            $user = 'piket';
        } elseif (Auth::user()->role == 4) {
            $user = 'bk';
        } elseif (Auth::user()->role == 5) {
            $user = 'Kepala/wakasek';
        } elseif (Auth::user()->role == 6) {
            $user = 'siswa';
        } elseif (Auth::user()->role == 7) {
            $user = 'pengawas';
        }
        $kls = $request->kls;
        $smt = $request->smt;

        return redirect('/' . $user . '/sks/penkd/' . $kls . '/' . $smt);
    }

    public function showPenKd(Request $request, $kls, $smt)
    {
        $user = '';
        if (Auth::user()->role == 1) {
            $user = 'admin';
        } elseif (Auth::user()->role == 2) {
            $user = 'guru';
        } elseif (Auth::user()->role == 3) {
            $user = 'piket';
        } elseif (Auth::user()->role == 4) {
            $user = 'bk';
        } elseif (Auth::user()->role == 5) {
            $user = 'Kepala/wakasek';
        } elseif (Auth::user()->role == 6) {
            $user = 'siswa';
        } elseif (Auth::user()->role == 7) {
            $user = 'pengawas';
        }
        $mapel_guru = mstUkbm::where('guru_id', Auth::user()->id)->first();
        $cekAdaNilai = PenKD::where([
            ['guru_id', Auth::user()->id],
            ['mapel_id', $mapel_guru->mapel_id],
        ])->count();
        if ($cekAdaNilai == 0) {
            return back();
        } else {
            $penKd = PenKd::where([
                ['guru_id', Auth::user()->id],
                ['mapel_id', $mapel_guru->mapel_id],
                ['kelas_id', $kls],
                ['smt', $smt],
                ['kd', '<>', is_int('kd')]
            ])->get();
            return view('/admin/sks/showPenKd', compact('penKd'));
        }
    }
    //==================================== sksController Murid ========================//
    public function materi1()
    {
        $myMapels = mapel_kelas::where('nis', Auth::user()->nis)->get();
        //dd($myMapels);
        return view('/admin/sks/materi1', compact('myMapels'));
    }

    public function fileLanjutan()
    {
        $mapels = file_siswa::where('nis', Auth::user()->nis)->get();
        return view('/admin/sks/file', compact('mapels'));
    }

    public function showNilai()
    {
        $myMapels = mapel_kelas::with(['NA' => function ($query) {
            $query->where('nis', Auth::user()->nis);
        }])->where('nis', Auth::user()->nis)->get();

        return view('/admin/sks/showNilai', compact('myMapels'));
    }

    public function showKelasSks()
    {
        $kelas = Kelas::select('id', 'nm_kelas')->where('sks', 1)->paginate(10);

        return view('/admin/sks/showKelasSks', compact('kelas'));
    }

    public function showKelasSksid($id)
    {
        $mapel_kelas = mapel_kelas::select('mapel_id')->where('kelas_id', $id)->distinct('mapel_id')->get();
        $nilai_ukbm = PenKd::select('nilai', 'nis', 'mapel_id', 'guru_id', 'kd')->where('kelas_id', $id)->get();
        $penKds = PenKd::select('nis', 'nilai', 'id', 'kd', 'mapel_id', 'guru_id')->with('mapel_kelas')->where('kelas_id', $id)->get();

        return view('/admin/sks/NiUkbmKls', compact('penKds', 'mapel_kelas', 'nilai_ukbm'));
    }

    public function khs()
    {
        return view('/admin/sks/khs');
    }

    public function testHitung($gid)
    {
    }

    public function formKD()
    {
        $mapel = mapels::where('ket', 'sks')->get();
        $hasils = make_kd::where('user_id', Auth::user()->id)->get();

        return view('guru/formKD', compact('mapel', 'hasils'));
    }

    public function sKD(Request $request)
    {
        for ($x = 1; $x <= $request->kd; $x++) {
            $save = new make_kd();
            $save->user_id = Auth::user()->id;
            $save->mapel_id = $request->mapel;
            $save->smt = $request->smt;
            $save->kd = $x;
            $save->save();
        }

        return back();
    }

    public function penilaian()
    {
        $mapel = mapels::where('ket', 'sks')->get();

        return view('guru/penilaian', ['mapel' => $mapel]);
    }


    public function nilaiProfile()
    {
        return view('murid.smt');
    }

    public function fixCetak(Request $request)
    {
        $smt = $request->smt;

        $nis = auth()->user()->nis;

        $ta = ta::where('status', 1)->first();

        $cek_kelas = kelas_siswa::where([
            ['nis', $nis]
        ])->first();

        $siswa = mapel_kelas::where([
            ['kelas_id', $cek_kelas->kelas_id],
            ['tas_id', $ta->id]
            ])->get();

        $maxKd = ppd::where([
            ['smt', $smt],
            ['kelas_id', $cek_kelas->kelas_id]
        ])->max('kd');

        $bio = kelas_siswa::where('nis', $nis)->first();

        $fast = ppd::where([
            ['ta_id', $ta->id],
            ['nis', $nis],
            ['smt', $smt],
            ['kelas_id', $cek_kelas->kelas_id]
        ])->count();

        $code = md5(date('YMD, h:i:s:m'));
        $log = log_view_pkpd::where('user_id', auth()->user()->id)->count();
        if($log >= 1){
            // udpate log
            $user = User::find(auth()->user()->id);
            $user->log_view_pkpd()->update([
                'code' => $code,
            ]);
        }else{
            // simpan log
            $user = User::find(auth()->user()->id);
            $user->log_view_pkpd()->create([
                'code' => $code,
            ]);
        }
        $code = md5(date('YMD, h:i:s:m'));

        return view('guru.fixCetak', compact('siswa', 'maxKd', 'bio', 'smt', 'fast', 'nis', 'ta', 'code'));
    }

    public function pk()
    {
        $pa = pa::where('guru_id', Auth::user()->id)->first();

        return view('guru.cp');
    }

    public function cetakProf(Request $request)
    {
        $smt = $request->smt;
        $myClass = pa::where('guru_id', Auth::user()->id)->first();
        $siswa = kelas_siswa::with(['nilaiKd1' => function ($query) use ($smt) {
            $query->where('smt', $smt);
        }])->where('kelas_id', $myClass->kelas_id)->get();

        return view('guru.cprof', compact('siswa', 'smt'));
    }

    public function cetakFix($smt, $nis)
    {
        $ta = ta::where('status', 1)->first();

        $cek_kelas = kelas_siswa::where([
            ['nis', $nis]
        ])->first();

        $siswa = mapel_kelas::where([
            ['kelas_id', $cek_kelas->kelas_id],
            ['tas_id', $ta->id]
        ])->get();

        $maxKd = ppd::where([
            ['smt', $smt],
            ['kelas_id', $cek_kelas->kelas_id]
        ])->max('kd');

        $bio = kelas_siswa::where('nis', $nis)->first();

        $fast = ppd::where([
            ['ta_id', $ta->id],
            ['nis', $nis],
            ['smt', $smt],
            ['kelas_id', $cek_kelas->kelas_id]
        ])->count();

        $code = md5(date('YMD, h:i:s:m'));

        return view('guru.fixCetak', compact('siswa', 'maxKd', 'bio', 'smt', 'fast', 'nis', 'ta', 'code'));
    }

    public function cekGP()
    {
        return view('profile.cekGP');
    }

    public function PcekGP(Request $request)
    {
        $mapel_kelas = mapel_kelas::select('mapel_id')->with(['np' => function ($query) use ($request) {
            $query->where('smt', $request->smt)->count();
        }])->where([
            ['tas_id', 4]
        ])->distinct('mapel_id')->get();

        foreach ($mapel_kelas as $gg) {
            dump($gg->mapel->mapel);
            foreach ($gg->np as $hh) {
                dump($hh);
            }
        }
    }

    public function indexKelas()
    {
        $tas = ta::where('status', 1)->first();

        $kelas = Kelas::where([
            ['sks', 1],
            ['tas_id', $tas->id],
        ])->get();

        return view('admin.admins.indexKelas1', compact('kelas'));
    }

    public function cekPro(Request $request)
    {
        $smt = $request->smt;

        $siswa = siswa::with(['nilaiKd1' => function ($query) use ($smt) {
            $query->where('smt', $smt);
        }])->where('kelas_id', $request->kelas)->get();

        return view('guru.cprof', compact('siswa', 'smt'));
    }

    public function penH()
    {
        $ta = ta::where('status', 1)->first();
        $guru_mapel = guru_mapel::where('guru_id', Auth::user()->id)->get();
        $kelas = pkd::where([
            ['guru_id', Auth::user()->id],
            ['ta_id', $ta->id],
        ])->orderBy('kelas_id')->get();

        return view('admin.penH', compact('kelas', 'guru_mapel'));
    }

    public function penilaian1(Request $request)
    {
        $ta     = ta::where('status', 1)->first();
        $siswas = siswa::where('kelas_id', $request->kls)->orderBy('nama')->get();
        $jum_kd = pkd::where([
            ['ta_id', $ta->id],
            ['guru_id', Auth::user()->id],
            ['kelas_id', $request->kls]
        ])->first();
        $smt = $request->smt;

        return view('guru.penilaianH', compact('siswas', 'jum_kd', 'smt'));
    }

    public function downloadRapor()
    {
        /*****
         * karena tidak bisa relasi antara table users dan siswa
         * jadi di select dengan menggunakan nis
         ******/
        $nis = Auth::user()->nis;
        $nisn_siswa = siswa::where('nisn', $nis)->first();
        $rapor = file_rapor::where('siswa_id', $nisn_siswa->id)->first();

        return view('murid.rapor', compact('rapor'));
    }

    public function pjj()
    {

        $kelas = Kelas::all();
        $guru_mapels = guru_mapel::where('guru_id', auth()->user()->id)->get();

        $materis = imateri::where('user_id', auth()->user()->id)->whereDay('created_at', date('d'))->get();
        foreach ($materis as $materi) {
            $mat[] = $materi->kelas_id;
        }
        if (isset($mat)) {
            $mer = collect($mat);
        }

        return view('guru.pjj.index', compact('kelas', 'guru_mapels', 'materis', 'mat'));
    }

    public function imateri(Request $request)
    {
        $validataor = $request->validate([
            'file' => 'required',
            'start' => 'required',
            'end' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'kelas_id' => 'required',
            'mapel_id' => 'required',
        ]);


        $ekstensi = $request->file->getClientOriginalExtension();
        //====== mengubah nama file =====================//
        $rename = $request->deksripsi . rand(11111, 99999) . '.' . $ekstensi;

        $imater = new imateri();
        $imater->id = Uuid::uuid4()->toString();
        $imater->user_id = auth()->user()->id;
        $imater->mapel_id = $request->mapel_id;
        $imater->kelas_id = $request->kelas_id;
        $imater->deskripsi = $request->deskripsi;
        $imater->file = $request->deskripsi . $rename;
        $imater->tanggal = $request->tanggal;
        $imater->start = $request->start;
        $imater->end = $request->end;
        $imater->save();

        $not = kelas_siswa::where('kelas_id', $request->kelas_id)->get();
        foreach ($not as $data) {
            User::where('id', $data->user_id)->first()->notify(new TaskComplate);
        }

        $tempatUpload = 'imateri';
        $file = $request->file('file');
        $file->move($tempatUpload, $request->deskripsi . $rename);

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Sukses penambahan " . $request->deskripsi
        ]);

        return back();
    }

    public function delMateri($id)
    {
        $materi = imateri::where([
            ['id', $id],
            ['user_id', auth()->user()->id]
        ])->first();

        // File::delete('imateri/' . $materi->file);

        $materi->delete();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Sukses menghapus materi/tugas"
        ]);

        return back();
    }

    public function viewSetKd()
    {
        $ta = ta::where('status', 1)->first();
        $pkd = pkd::where('ta_id', $ta->id)->orderBy('guru_id')->orderBy('kelas_id')->get();

        return view('admin.viewSetKd', compact('pkd'));
    }

    public function trial()
    {
        $materi = imateri::whereDay('created_at', date('d'))->first();
        $wkt_skr = date('H:i:s');
        $start = $materi->start;
        $end = $materi->end;


        if (strtotime($wkt_skr) > strtotime($start)) {
            echo "file dibuka <br>";
            if (strtotime($wkt_skr) > strtotime($end)) {
                echo 'siswa telat';
            } else {
                echo 'siswa mengumpulkan tugas';
            }
        }
    }
}
