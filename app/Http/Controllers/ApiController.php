<?php

namespace App\Http\Controllers;

use App\Models\guru_mapel;
use App\Models\imateri;
use App\Models\kd;
use App\Models\kdMapel;
use App\Models\ppd;
use App\Models\siswa;
use App\Models\ta;
use App\pkd;
use App\User;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\kelas_semester;
use App\Models\log_materi;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function ju(Request $request)
    {
        if ($request->ju == 1) {
            $kelas = Kelas::all();
            return response()->json($kelas);
        }

        return response()->json();
    }

    public function kd(Request $request)
    {
        //dd($request);
        $cek = ppd::where([
            ['kd', $request->kd],
            ['kelas_id', $request->kls],
            ['guru_id', $request->guru_id],
            ['smt', $request->smt],
            ['mapel_id', $request->mapel_id]
        ])->count();

        if ($cek > 1) {
            $update = ppd::with('siswa')->where([
                ['kd', $request->kd],
                ['kelas_id', $request->kls],
                ['guru_id', $request->guru_id],
                ['mapel_id', $request->mapel_id],
                ['smt', $request->smt]
            ])->get();

            return response()->json($update);
        } else {
            $clas_stu = siswa::select('nama', 'nisn', 'id')->where('kelas_id', $request->kls)->get();
            return response()->json($clas_stu);
        }
    }

    public function npk(Request $request)
    {
        $mapel = $request->mapel;
        $kelas = $request->kelas;
        $smt    = $request->smt;

        $siswa = siswa::with(['nilaiKd1' => function ($query) use ($mapel, $smt) {
            $query->where('mapel_id', $mapel);
            $query->where('smt', $smt);
        }])->where('kelas_id', $kelas)->get();

        return response()->json($siswa);
    }

    public function smt(Request $request)
    {
        $smt = $request->smt;
        $klsid = $request->klsid;

        $smt_nya = pkd::where([
            ['kelas_id', $klsid],
            ['smt', $smt],
            ['guru_id', Auth::user()->id]
        ])->get();

        return response()->json($smt_nya);
    }

    public function user()
    {
        $user = User::where('id', Auth::user()->id)->first();

        return $user;
    }

    public function mapel()
    {
        $user = 11;
        $ta = ta::where('status', 1)->first();
        $pkd = pkd::with('kls')->where([
            ['guru_id', $user],
            ['ta_id', $ta->id]
        ])->get();
        $mapel = guru_mapel::where('guru_id', $user)->get();

        return response()->json([
            'data' => $mapel,
            'pkd' => $pkd
        ]);
    }

    public function kds(Request $request)
    {
        $kd = kdMapel::where([
            ['mapel_id', $request->mapel_idnya],
            ['kat', 'X']
        ])->get();

        return $kd;
    }

    public function dataSiswa(Request $request)
    {
        $siswa = siswa::where('kelas_id', $request->kelas_id)->get();

        return response()->json([
            'data' => $siswa
        ]);
    }

    public function klsSmt(Request $request)
    {
        $kelas = Kelas::where('id', $request->kls)->first();
        $kelas_semester = kelas_semester::where('kat', $kelas->kat_kelas)->get();

        return $kelas_semester;
    }

    public function asdfasfasf()
    {
        $materi = imateri::with('kelas', 'mapels')->where('user_id', auth()->user()->id)->whereDay('created_at', date('d'))->get();

        return $materi;
    }

    public function aklioasfm(Request $request)
    {
        $log = log_materi::with('kelas', 'mapels', 'users')
            ->where('materis_id', $request->id)
            ->whereDay('created_at', date('d'))->get();

        return $log;
    }
}
