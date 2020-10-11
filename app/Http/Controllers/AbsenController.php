<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Models\Kelas;
use App\Models\siswa;
use App\Models\Absens;
use App\Models\ta;
use App\Models\Gurus;
use App\User;
use DB;

class AbsenController extends Controller
{

    public function index()
    {
        $ta     = ta::where('status', 1)->first();
        $kelas  = Kelas::where('tas_id', $ta->id)->paginate(10);
        //==== filter tampilan absen agar absen di hari kemarin tidak muncul di hari ini========//
        $absens = Absens::where('date', date('Ymd'))->get();
        //=============================================//
        return view('admin/absen', ['kelas' => $kelas, 'absens' => $absens]);
    }

    public function absen($id)
    {
        $ta     = ta::where('status', 1)->first();
        $kelas  = Kelas::where('tas_id', $ta->id);
        return View('admin/CreateAbsen', ['kelas' => Kelas::findOrFail($id), 'ta' => $ta]);
    }

    public function store(Request $request)
    {
        //cek dulu di database where kelas = inputan kelas dan jam = inputan jam jika ada maka
        $cekAbsen = DB::table('absens')->where([
            ['date', '>=', $request->input('date')],
            ['kelas_id', '=', $request->input('kelas')],
            ['jam_ke', '=', $request->input('jam')]
        ])->count();
        //dd($cekAbsen);
        if ($cekAbsen > 0) {
            Session::flash("flash_notif", [
                "level"   => "danger",
                "message" => "Maaf kelas ini sudah di absen"
            ]);

            return redirect('/admin/absen/');
            //dd('maaf anda sudah absen');
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
            return redirect('/admin/absen');
        }
    }

    public function hi()
    {
        $ta = ta::where('status', 1)->first();
        $hari_ini = Carbon::today();

        $absen = Absens::where([
            ['nisn', Auth::user()->nis],
            ['tas_id', $ta->id]
        ])->whereDate('Created_at', '=', $hari_ini->toDateString())->orderby('jam_ke', 'asc')->get();
        //dd($absen);

        return view('murid.hi', compact('absen'));
    }
}
