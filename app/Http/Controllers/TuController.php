<?php

namespace App\Http\Controllers;

use App\Models\nominal;
use App\Models\persen_spp;
use App\Models\siswa;
use App\Models\surat;
use Illuminate\Http\Request;
use App\User;
use App\Models\Absens;
use App\Models\Kelas;
use App\Models\potongan_siswa;
use App\Models\RgHarian;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use function foo\func;


class TuController extends Controller
{
    public function index()
    {
        $surat = surat::whereDate('created_at', date('Y-m-d'))->get();

        return view('admin.Tu.index', compact('surat'));
    }

    public function report()
    {
        $tgl = date('d');
        /* menghitung jumlah hari dalam bulan ini dengan menggunakan coding di bawah ini*/
        $tahun = date('Y'); //Mengambil tahun saat ini
        $bulan = date('m'); //Mengambil bulan saat ini
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

        //        dd(date('Y-m-d'));
        $user = User::with('absens')->where('role', 2)->get();

        return view('admin.Tu.RAbsen', compact('user', 'tanggal', 'bulan'));
    }

    public function sm()
    {
        $sm = surat::where('ket', 1)->get();

        return view('admin.Tu.sm', compact('sm'));
    }

    public function view($id)
    {
        $file = surat::where('id', $id)->first();

        return view('admin.Tu.file', compact('file'));
    }

    public function delSurat($id)
    {
        $surat = surat::where('id', $id)->delete();

        return back()->with('pesan', 'sukses menghapus surat');
    }

    public function sk()
    {
        $sm = surat::where('ket', 2)->get();

        return view('admin.Tu.sk', compact('sm'));
    }

    /** Controller spp */

    public function setSpp()
    {
        $persen = persen_spp::orderBy('persen', 'ASC')->get();
        $no = nominal::all();
        $siswas = siswa::where('kelas_id', '!=', 0)->doesnthave('sisPot')->get();
        $sisPot = potongan_siswa::all();


        return view('admin.Tu.spp.setSpp', compact('persen', 'no', 'siswas', 'sisPot'));
    }

    public function saveSet(Request $request)
    {
        $simpan = new persen_spp();
        $simpan->persen = $request->persen;
        $simpan->save();

        return back();
    }

    public function saveNominal(Request $request)
    {
        $sim = new nominal();
        $sim->nominal = $request->nominal;
        $sim->save();

        return back();
    }

    public function delnom($id)
    {
        $delNom = nominal::where('id', $id)->delete();

        return back();
    }

    public function delPersen($id)
    {
        $persen = persen_spp::where('id', $id)->delete();

        return back();
    }

    public function siswaPotongan(Request $request)
    {
        $persen = persen_spp::find($request->potongan);
        $jum = count($request->siswa);

        for ($x = 0; $x < $jum; $x++) {
            DB::table('potongan_siswa')->insert([
                ['siswa_id' => $request->siswa[$x], 'persen_id' => $request->potongan],
            ]);
        }

        return back();
    }

    public function delpot($id)
    {
        potongan_siswa::find($id)->delete();

        return back();
    }

    public function bayar()
    {
        $kelas = Kelas::all();

        return view('admin.Tu.spp.bayar', compact('kelas'));
    }

    public function plhKls(Request $request)
    {
        $kelas = Kelas::all();
        $kelas_id = Kelas::find($request->kelas);
        $siswa = siswa::where('kelas_id', $kelas_id->id)->get();
        $open_form = 1;
        $nominal = nominal::first();
        return view('admin.Tu.spp.bayar', compact('kelas', 'kelas_id', 'siswa', 'open_form', 'nominal'));
    }
}
