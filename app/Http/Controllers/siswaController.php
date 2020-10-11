<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use lluminate\Support\Facades\DB;
use App\Models\siswa;
use App\Models\Kelas;
use App\Models\Absens;
use App\Models\imateri;
use App\Models\kelas_siswa;
use App\Models\log_materi;
use App\Models\mapel_kelas;
use App\Models\mapels;
use App\Models\ta;
use App\User;
use Ramsey\Uuid\Uuid;

class siswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //dd($this);
    }

    public function index()
    {
        $siswas = siswa::paginate(30);
        return view('/admin/siswa', ['siswas' => $siswas]);
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('/admin/create_siswa', ['kelas' => $kelas]);
    }

    public function store(Request $request)
    {
        $siswas = new siswa;
        $siswas->nama     = $request->nama;
        $siswas->nisn     = $request->nisn;
        $siswas->kelas_id = $request->kelas;
        $siswas->alamat   = $request->alamat;
        $siswas->save();

        return redirect('/admin/siswa');
    }

    public function materi()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $kls_saya = kelas_siswa::where('user_id', auth()->user()->id)->first();
        $tas = ta::where('status', 1)->first();
        $mapels = mapel_kelas::with(['materis' => function ($q) {
            $q->whereDay('tanggal', date('d'));
        }])->where([
            ['kelas_id', $kls_saya->kelas_id],
            ['tas_id', $tas->id]
        ])->get();

        return view('murid.materi', compact('mapels'));
    }

    public function mm($id)
    {
        $imateris = imateri::whereDay('tanggal', date('d'))->where('mapel_id', $id)->get();

        return view('murid.mm', compact('imateris'));
    }

    public function download(Request $request)
    {
        $my_profile = User::where('id', auth()->user()->id)->first();
        $materi = imateri::where('id', $request->materi_id)->first();
        $cek = log_materi::where([
            ['user_id', auth()->user()->id],
            ['kelas_id', $my_profile->kelas_siswas->kelas_id],
            ['materis_id', $request->materi_id]
        ])->count();

        if ($cek >= 1) {
            $file_path = public_path('imateri/' . $materi->file);
            return response()->download($file_path);
        } else {
            $sim_log = new log_materi();
            $sim_log->id = Uuid::uuid4()->toString();
            $sim_log->materis_id = $request->materi_id;
            $sim_log->user_id = auth()->user()->id;
            $sim_log->guru_id = $materi->user_id;
            $sim_log->mapel_id = $materi->mapel_id;
            $sim_log->kelas_id = $my_profile->kelas_siswas->kelas_id;
            $sim_log->file = $materi->file;
            $sim_log->save();
        }

        $file_path = public_path('imateri/' . $materi->file);

        return response()->download($file_path);
    }

    public function lulus()
    {
        $user = User::where('nis', auth()->user()->nis)->first();

        return $user->kelas_siswas->kelas_id;
    }
}
