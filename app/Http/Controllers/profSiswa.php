<?php

namespace App\Http\Controllers;

use App\Models\guru_mapel;
use App\Models\Kelas;
use App\Models\log_nis;
use App\Models\mapels;
use App\Models\ppd;
use App\Models\siswa;
use App\Models\ta;
use App\pkd;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use PhpParser\Node\Stmt\Foreach_;
use Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Exports\ppdExport;
use App\Models\kelas_siswa;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use DB;
use Excel;


class profSiswa extends Controller
{
    public function index()
    {
        $ta = ta::where('status', 1)->first();

        $mapels = guru_mapel::where([
            ['guru_id', Auth::user()->id],
        ])->get();
        $kelas = Kelas::all();
        $pdk = pkd::where([
            ['guru_id', Auth()->user()->id],
            ['ta_id', $ta->id]
        ])->orderBy('smt', 'ASC')->orderBy('kelas_id', 'ASC')->orderby('ta_id', 'ASC')->get();

        return view('profile.index', compact('mapels', 'kelas', 'pdk'));
    }

    public function sim(Request $request)
    {
        $rules = array(
            'smt'   => 'required|min:1|numeric',
            'kd'    => 'required|min:1|numeric',
            'mapel' => 'required|min:1',
        );

        $messages = array(
            'required'  => 'The :attribute field is required.',
            'min'       => 'Pilih opsi',
            'numeric'   => 'harus nilai tidak boleh angka',

        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {

            return back()
                ->withErrors($validator)
                ->withInput(Input::all());
        }

        $jum = count($request->kls);
        $kelas = $request->kls;
        $taAktif = ta::where('status', 1)->first();

        for ($c = 1; $c <= $jum; $c++) {
            $cek = pkd::where([
                ['mapel_id', $request->mapel],
                ['kelas_id', $kelas[$c - 1]],
                ['smt', $request->smt],
                ['guru_id', Auth::user()->id],
                ['ta_id', $taAktif->id]
            ])->count();

            if ($cek >= 1) {
                Session::flash("flash_notif", [
                    "level"   => "danger",
                    "message" => "Mapel sudah ada di kelas tersebut"
                ]);

                return back();
            }
        }

        for ($x = 1; $x <= $jum; $x++) {
            $simpan = new pkd();
            $simpan->ta_id = $taAktif->id;
            $simpan->guru_id = Auth::user()->id;
            $simpan->smt = $request->smt;
            $simpan->mapel_id = $request->mapel;
            $simpan->jumkd = $request->kd;
            $simpan->kelas_id = $kelas[$x - 1];
            $simpan->save();
        }

        for ($x = 1; $x <= $jum; $x++) {
            $cari_kd = pkd::where([
                ['guru_id', Auth::user()->id],
                ['kelas_id', $kelas[$x - 1]],
                ['mapel_id', $request->mapel],
                ['smt', $request->smt],
                ['ta_id', $taAktif->id]
            ])->first();  //jumlah kd berdasaarkan kelas dan smt
            // dd($cari_kd)

            $pkdnya = pkd::where([
                ['guru_id', Auth::user()->id],
                ['smt', $request->smt],
                ['mapel_id', $request->mapel],
                ['kelas_id', $kelas[$x - 1]],
                ['ta_id', $taAktif->id]
            ])->get();

            foreach ($pkdnya as $data) {

                for ($z = 1; $z <= $cari_kd->jumkd; $z++) {
                    $siswanya = kelas_siswa::where('kelas_id', $data->kelas_id)->get();
                    foreach ($siswanya as $datas) {
                        $siswanya = new ppd();
                        $siswanya->pkd_id = $data->id;
                        $siswanya->nis = $datas->users->nis;
                        $siswanya->kd = $z; // cari bnayaknya kd
                        $siswanya->guru_id = Auth::user()->id;
                        $siswanya->kelas_id = $data->kelas_id;
                        $siswanya->nilaiP = 0;
                        $siswanya->nilaiK = 0;
                        $siswanya->mapel_id = $data->mapel_id;
                        $siswanya->smt = $data->smt;
                        $siswanya->ta_id = $data->ta_id;
                        $siswanya->save();
                    }
                }
            }
        }

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Setting KD berhasil"
        ]);

        return back();
    }

    public function del($id)
    {
        $data = pkd::where('id', $id)->delete();

        Session::flash("flash_notif", [
            "level"   => "danger",
            "message" => "Penghapusan berhasil !!!"
        ]);
        return back();
    }

    public function indexKls()
    {
        $kelasGuru = pkd::select('kelas_id')->where('guru_id', Auth::user()->id)->OrderBy('id', 'DESC')->distinct()->get();

        return view('profile.inKls', compact('kelasGuru'));
    }

    public function indexPen($klsid)
    {

        //$siswa = siswa::where('kelas_id', $klsid)->get();
        $mapel_saya = pkd::where([
            ['guru_id', Auth::user()->id],
            ['kelas_id', $klsid]
        ])->orderby('id', 'DESC')->first();
        $jumKdKelas = pkd::select('jumkd')->where('kelas_id', $klsid)->first();
        $smt = pkd::where([
            ['guru_id', Auth::user()->id],
            ['kelas_id', $klsid],
        ])->get();

        return view('profile.indexPen', compact('smt', 'mapel_saya', 'jumKdKelas', 'klsid'));
    }

    public function simppd(Request $request)
    {
        //dd($request);
        $cari_kelas_siswa = siswa::where('kelas_id', $request->klsid)->get();
        $tas = ta::where('status', 1)->first();

        foreach ($cari_kelas_siswa as $siswa) {
            $op = ppd::updateOrCreate([
                'nis'       => $siswa->nisn,
                'pkd_id'    => $request->pkd_id,
                'guru_id'   => Auth::user()->id,
                'ta_id'     => $tas->id,
                'smt'       => $request->smt,
                'kelas_id'  => $request->klsid,
                'kd'        => $request->kd,
                'mapel_id'  => $request->mapel_id,
            ], [
                'nilaiP'     => $request->input('nis' . $siswa->nisn),
                'nilaiK'     => $request->input('nisk' . $siswa->nisn), //
            ]);
        }

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Input Nilai atau Ubah Nilai Sukses"
        ]);

        return back();
    }

    public function npk()
    {
        $ta = ta::where('status', 1)->first();
        $mapel = mapels::where([
            ['ket', 'sks'],
            ['tas_id', 4]
        ])->get();
        $kelas = Kelas::all();

        return view('profile.npk', compact('mapel', 'kelas'));
        $flush = Session::forget('data');
    }

    public function prosesData(Request $request)
    {
        $jumKD = pkd::where([
            ['guru_id', Auth::user()->id],
            ['smt', $request->smt],
            ['kelas_id', $request->kelas_id],
            ['mapel_id', $request->mapel_id],
        ])->first();

        $td = session::put('td', $jumKD->jumkd);
        $data = session::put('data', 1);

        return back();
    }

    public function prodata(Request $request)
    {
        //dd($request);
        $ppd = ppd::where([
            ['smt', $request->smt],
            ['kelas_id', $request->kelas],
            ['mapel_id', $request->mapel]
        ])->get();
        dd($ppd);
    }

    public function eximp()
    {
        $gm = guru_mapel::where('guru_id', auth()->user()->id)->get();
        $pdk = pkd::select('kelas_id')->where([
            ['ta_id', 7],
            ['guru_id', Auth::user()->id],
        ])->distinct()->Orderby('kelas_id', 'ASC')->get();

        return view('profile.inExim', ['kelas' => $pdk, 'gm' => $gm]);
    }

    public function export(Request $request)
    {
        // dd($request);
        $tas = ta::where('status', 1)->first();

        $user = ppd::with('siswa')->where([
            ['guru_id', Auth::user()->id],
            ['kelas_id', $request->kelas],
            ['smt', $request->smt],
            ['ta_id', $tas->id],
            ['mapel_id', $request->mapel_id]
        ])->orderBy('kd')->orderBy('nis')->get();

        $type = 'xlsx';


        return Excel::create('smansa', function ($excel) use ($user) {
            $excel->sheet('sheet1', function ($sheet) use ($user) {
                $sheet->cell('A1', function ($cell) {
                    $cell->setValue('No');
                });
                $sheet->cell('B1', function ($cell) {
                    $cell->setValue('pkd_id');
                });
                $sheet->cell('C1', function ($cell) {
                    $cell->setValue('Nis');
                });
                $sheet->cell('D1', function ($cell) {
                    $cell->setValue('Nama');
                });
                $sheet->cell('E1', function ($cell) {
                    $cell->setValue('Kelas');
                });
                $sheet->cell('F1', function ($cell) {
                    $cell->setValue('Kd');
                });
                $sheet->cell('G1', function ($cell) {
                    $cell->setValue('Smt');
                });
                $sheet->cell('H1', function ($cell) {
                    $cell->setValue('Mapel');
                });
                $sheet->cell('I1', function ($cell) {
                    $cell->setValue('TA');
                });
                $sheet->cell('J1', function ($cell) {
                    $cell->setValue('NilaiP');
                });
                $sheet->cell('K1', function ($cell) {
                    $cell->setValue('NilaiK');
                });
                if (!empty($user)) {
                    foreach ($user as $key => $value) {
                        $i = $key + 2;
                        $sheet->cell('A' . $i, $i);
                        $sheet->cell('B' . $i, $value->pkd_id);
                        $sheet->cell('C' . $i, $value->nis);
                        $sheet->cell('D' . $i, strtoupper($value->siswa->name));
                        $sheet->cell('E' . $i, $value->kelas_id);
                        $sheet->cell('F' . $i, $value->kd);
                        $sheet->cell('G' . $i, $value->smt);
                        $sheet->cell('H' . $i, $value->mapel_id);
                        $sheet->cell('I' . $i, $value->ta_id);
                        $sheet->cell('J' . $i, $value->nilaiP);
                        $sheet->cell('K' . $i, $value->nilaiK);
                    }
                }
            });
        })->download($type);
    }

    public function import(Request $req)
    {
        //dd($req);
        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            //dd($data);
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $insert[] =
                        [
                            'pkd_id'    => $value->pkd_id,
                            'nis'       => $value->nis,
                            'kelas_id'  => $value->kelas,
                            'kd'        => $value->kd,
                            'guru_id'   => Auth::user()->id,
                            'smt'       => $value->smt,
                            'mapel_id'  => $value->mapel,
                            'ta_id'     => $value->ta,
                            'nilaiP'    => $value->nilaip,
                            'nilaiK'    => $value->nilaik,
                        ];
                }
                if (!empty($insert)) {
                    //dd($insert);
                    $delete_dulu = ppd::where('pkd_id', $value->pkd_id)->delete();

                    DB::table('ppds')->insert($insert);
                    //$simpan = ppd::created(array($insert));
                    //dd('Insert Record successfully.');

                    Session::flash("flash_notif", [
                        "level"   => "success",
                        "message" => "Upload Nilai Sukses"
                    ]);
                }
            }
        }

        return back();
    }

    public function cekProf()
    {
        $ta = ta::where('status', 1)->first();
        $pkd = pkd::select('kelas_id', 'guru_id')->where([
            ['guru_id', Auth::user()->id],
            ['ta_id', $ta->id]
            ])->distinct('kelas_id')->orderby('kelas_id', 'ASC')->get();
        $gms = guru_mapel::where('guru_id', auth()->user()->id)->get();

        return view('profile.gCek', compact('pkd', 'gms'));
    }

    public function hitung(Request $request)
    {
        $ta = ta::where('status', 1)->first();
        $hitung = ppd::where([
            ['guru_id', Auth::user()->id],
            ['smt', $request->smt],
            ['kelas_id', $request->kls],
            ['ta_id', $ta->id],
        ])->get();

        $hit_kd = pkd::where([
            ['guru_id', Auth::user()->id],
            ['smt', $request->smt],
            ['kelas_id', $request->kls],
            ['ta_id', $ta->id],
            ['mapel_id', $request->mapel_id]
        ])->first();

        $siswa = kelas_siswa::with([
            'nilaiKd1' => function ($q) use ($request, $ta) {
                $q->where('kelas_id', $request->kls);
                $q->where('smt', $request->smt);
                $q->where('guru_id', Auth::user()->id);
                $q->where('ta_id', $ta->id);
                $q->where('mapel_id', $request->mapel_id);
            }, 'users'
        ])->where('kelas_id', $request->kls)->get()->sortBy('users.name');

        $smt = $request->smt;
        $kelas = $request->kls;

        return view('profile.test', compact('siswa', 'hit_kd', 'smt', 'kelas'));
    }

    public function listKd()
    {
        $ta = ta::where('status', 1)->first();
        $lists = pkd::where([
            ['ta_id', $ta->id]
        ])->orderBy('mapel_id', 'ASC')->orderBy('smt', 'ASC')->get();

        return view('profile.listKd', compact('lists'));
    }

    public function ps()
    {
        $kelas_saya = siswa::select('kelas_id')->where('nisn', Auth::user()->nis)->first();
        //dd($kelas_saya);

        return view('murid.ps', compact('kelas_saya'));
    }

    public function nis()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $cek = User::select('nis')->where('id', Auth::user()->id)->first();
        if ($cek->nis == 0) {

            return view('murid.nis');
        } else {
            $nis = User::select('nis')->where('id', Auth::user()->id)->first();
            $cek_edit = log_nis::where('nis', Auth::user()->nis)->first();

            return view('murid.ada', compact('nis', 'cek_edit'));
        }
    }

    public function upnis(Request $request)
    {
        $my_id = User::where('id', Auth::user()->id)->first();
        $my_id->nis = $request->nis;
        $my_id->save();

        return back();
    }

    public function eNis()
    {
        $nis = User::where('nis', Auth::user()->nis)->first();
        $siswa = siswa::where('nisn', $nis->nis)->first();

        return view('murid.enis', compact('nis'));
    }

    public function UpNis1(Request $request)
    {

        $tas = ta::where('status', 1)->first();
        /*** udpate nis di table users ****/
        $User_update = User::where('nis', Auth::user()->nis)->first();
        $User_update->nis = $request->nisUp;
        $User_update->username = $request->nisUp;
        $User_update->save();

        /**** udpate nis di table siswa ******/
        $siswa = siswa::where('nisn', Auth::user()->nis)->first();
        $siswa->nisn = $request->nisUp;
        $siswa->save();

        $log = new log_nis();
        $log->nis = $request->nisUp;
        $log->status = 1;
        $log->tas_id = $tas->id;
        $log->save();

        return redirect('/siswa/nis');
    }

    public function rombel()
    {
        $ta = ta::where('status', 1)->first();
        $myKls = kelas_siswa::where('user_id', Auth::user()->id)->first();
        $kls = kelas_siswa::where([
            ['kelas_id', $myKls->kelas_id],
            ['tas_id',  $ta->id]
        ])->get()->sortBy(function ($query) {
            return $query->users->name;
        });

        return view('murid.rombel', compact('kls'));
    }
}
