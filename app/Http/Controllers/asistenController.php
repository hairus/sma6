<?php

namespace App\Http\Controllers;

use App\Models\angketPtm;
use App\Models\penelaah;
use App\Models\soal;
use App\Models\ta;
use App\Models\upload;
use App\Models\uploadKisi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class asistenController extends Controller
{
    public function index()
    {
        $jumSoal = User::where([
            ['status', 'Guru'],
            ['role', 2]
        ])->withCount('soals')->with('guruMapel')->get();

        return view('asisten.index', compact('jumSoal'));
    }

    public function kisiSoal()
    {
        $fileKisi = User::where([
            ['status', 'Guru'],
            ['role', 2]
        ])->with('kisiSoals')->get();

        return view('asisten.kisiSoal', compact('fileKisi'));
    }

    public function downFile($id)
    {
        $data = uploadKisi::where('id', $id)->first();
        $patch = public_path('uploadKisi/' . $data->file);

        return Response::download($patch);
    }

    public function perangkat()
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

        return view('admin.guru.RekapUpload', ['data' => $data]);
    }

    public function penelaah()
    {
        $penelaah = penelaah::where('user_id', Auth::user()->id)->get();
        return view('asisten.penelaah', compact('penelaah'));
    }

    public function guru(Request $request)
    {
        $soal = soal::with('users')->where('mapel_id', $request->mapel_id)->distinct('guru_id')->get('guru_id');

        return $soal;
    }

    public function penulisSoal($id)
    {
        $soal = soal::where('guru_id', $id)->get();

        return view('asisten.validasi', compact('soal'));
    }

    public function validasi(Request $request)
    {
        $my_soal = soal::where([
            ['guru_id', $request->guru_id],
            ['mapel_id', $request->mapel_id]
        ])->get();

        foreach ($my_soal as $data) {
            $soal = soal::where('id', $request->input('soal_id' . $data->id))->first();
            $soal->valid = $request->input('valid' . $data->id);
            $soal->flag = 1;
            $soal->penelaah_id = Auth::user()->id;
            $soal->save();
        }

        return redirect('guru/kurikulum/penelaah');
    }

    public function ptm()
    {
        $ptm = angketPtm::all();

        return view('guru.anggketPtm', compact('ptm'));
    }
}
