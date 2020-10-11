<?php

namespace App\Http\Controllers;

use App\Models\angket_file;
use App\Models\angket_nilai;
use App\Models\angketPtm;
use App\Models\lock_nilai;
use App\Models\ppdb_profile;
use App\Models\siba_log_file;
use App\Models\ta;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Session;

class SibaController extends Controller
{
    public function index()
    {
        //return redirect('/login');
        return view('siba.siba');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:ppdb_profiles,email,',
            'nun' => 'required|unique:ppdb_profiles,nun,',
            'nama' => 'required',
        ]);


        $simpan         = new ppdb_profile();
        $simpan->nama   = $request->nama;
        $simpan->nun    = $request->nun;
        $simpan->email  = $request->email;
        $simpan->save();


        $save           = new User();
        $save->email    = $request->email;
        $save->status   = 'siswa';
        $save->role     = 99;
        $save->name     = $request->nama;
        $save->password = bcrypt('123456');
        $save->subrole  = 0;
        $save->nis      = 0;
        $save->save();

        return redirect('/login');
    }

    public function fw()
    {
        return view('siba.fw');
    }

    public function kelulusan()
    {
        return view('murid.kelulusan');
    }

    public function kelulusan1()
    {
        //        dump(date('Y-m-d H:i:s'));
        if (date('H') >= 14) {
            return view('murid.kelulusan1');
        } else {
            return view('murid.count');
        }
    }

    public function updateP()
    {
        $user = User::where('role', 7)->get();
        foreach ($user as $data) {
            $upd = User::where('username', $data->username)->first();
            $upd->password = bcrypt($data->username);
            $upd->save();
        }

        return 'udpate password berhasil';
    }

    public function angket()
    {
        return view('siba.angket');
    }

    public function simNilai(Request $request)
    {
        $tas_id = ta::where('status', 1)->first();

        $cek = angket_nilai::where('user_id', Auth::user()->id)->count();
        if ($cek > 1) {
            Session::flash("flash_notif", [
                "level"   => "danger",
                "message" => "Maaf Nilai Sudah Ada Jika Anda ingin merubah Silakan masuk di menu Angket lalu edit nilai"
            ]);
            return redirect('sibA/angket');
        }

        for ($x = 1; $x <= 6; $x++) {
            $sim = new angket_nilai();
            $sim->user_id = Auth::user()->id;
            $sim->smt = 'smt' . $x;
            $sim->mat = $request->input('mat' . $x);
            $sim->ipa = $request->input('ipa' . $x);
            $sim->ips = $request->input('ips' . $x);
            $sim->tas_id = $tas_id->id;
            $sim->nun_profile = Auth::user()->username;
            $sim->save();
        }

        $cek_lock = lock_nilai::where('user_id', Auth::user()->id)->count();
        if ($cek_lock === 0) {
            $lock = new lock_nilai();
            $lock->user_id = Auth::user()->id;
            $lock->lock = 1;
            $lock->save();
        }

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Nilai berhasil di simpan"
        ]);

        return back();
    }

    public function editN()
    {
        $cek = angket_nilai::where('user_id', Auth::user()->id)->count();
        if ($cek >= 1) {
            $lock = lock_nilai::where('user_id', Auth::user()->id)->first();
            $nilai_saya = angket_nilai::where('user_id', Auth::user()->id)->get();

            return view('siba.editN', compact('nilai_saya', 'lock'));
        } else {
            return back();
        }
    }

    public function UpNi(Request $request)
    {
        $cek = lock_nilai::where('user_id', Auth::user()->id)->first();
        if ($cek->lock === 1) {
            // update nilai matematika
            for ($i = 1; $i <= 6; $i++) {
                $upt = angket_nilai::where([
                    ['user_id', Auth::user()->id],
                    ['smt', 'smt' . $i]
                ])->first();
                $upt->mat = $request->input('mat' . $i);
                $upt->save();

                $upt = angket_nilai::where([
                    ['user_id', Auth::user()->id],
                    ['smt', 'smt' . $i]
                ])->first();
                $upt->ipa = $request->input('ipa' . $i);
                $upt->save();

                $upt = angket_nilai::where([
                    ['user_id', Auth::user()->id],
                    ['smt', 'smt' . $i]
                ])->first();
                $upt->ips = $request->input('ips' . $i);
                $upt->save();
            }

            $lock = lock_nilai::where('user_id', Auth::user()->id)->first();
            $lock->lock = 2;
            $lock->save();

            Session::flash("flash_notif", [
                "level"   => "success",
                "message" => "Edit Nilai berhasil di update"
            ]);

            return back();
        } else {
            return back();
        }
    }

    public function InFile()
    {
        $file_saya = angket_file::where('user_id', Auth::user()->id)->get();
        return view('siba.inFile', compact('file_saya'));
    }

    public function SimFile(Request $request)
    {
        //     $this->validate($request, [
        //         'foto' => 'required|mimes:jpg,jpeg',
        //         'file' => 'required|mimes:pdf',
        //     ]);

        $rules = [
            'foto' => 'required|mimes:jpg,jpeg',
            'file' => 'required|mimes:pdf',
        ];

        $customMessages = [
            'required' => 'Inputan File Foto atau Input Pdf tidak boleh kosong',
            'foto.mimes' => 'Maaf : Input Foto harus berformat jpg atau jpeg',
            'file.mimes' => 'Maaf : Input Pdf harus berformat pdf'
        ];

        $this->validate($request, $rules, $customMessages);

        $ekstensi1 = $request->foto->getClientOriginalExtension();
        $ekstensi2 = $request->file->getClientOriginalExtension();

        $rename1 = 'AngketSmansa' . rand(11111, 99999) . '.' . $ekstensi1;
        $rename2 = 'AngketSmansa' . rand(11111, 99999) . '.' . $ekstensi2;

        $tempatUpload = 'siba';
        $file = $request->file('foto');
        $file->move($tempatUpload, $rename1);
        $file1 = $request->file('file');
        $file1->move($tempatUpload, $rename2);

        $sim = new angket_file();
        $sim->user_id = Auth::user()->id;
        $sim->file = $rename1;
        $sim->save();

        $sim = new angket_file();
        $sim->user_id = Auth::user()->id;
        $sim->file = $rename2;
        $sim->save();

        $cek_log = siba_log_file::where('user_id', Auth::user()->id)->count();
        if ($cek_log == 0 || $cek_log == null) {
            $sim = new siba_log_file();
            $sim->user_id = Auth::user()->id;
            $sim->save();
        }

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Upload data sukses"
        ]);

        return back();
    }

    public function delfile($id)
    {
        $del = angket_file::where([
            ['user_id', Auth::user()->id],
            ['id', $id]
        ])->first();

        $tempat = 'siba';
        File::delete($tempat . '/' . $del->file);
        $del->delete();

        return back();
    }

    public function angketPtm()
    {
        return view('murid.angketPtm');
    }

    public function saveAngketPtm(Request $request)
    {
        // dd($request->radios);
        // jika pemilihan sama dengan 1 maka dia setuju
        if ($request->radios == 1) {
            $this->validate($request, [
                'upload' => 'required|mimes:jpg,jpeg|max:25000',
            ]);


            $ekstensi = $request->upload->getClientOriginalExtension();
            //====== mengubah nama file =====================//
            $rename = 'smansa' . rand(11111, 99999) . '.' . $ekstensi;
            $tempatUpload = 'AngketPtm';
            $file = $request->file('upload');
            $file->move($tempatUpload, $rename);

            // cek disini jika agar takut ada siswa yang reupload gambar
            $cek = angketPtm::where('user_id', auth()->user()->id)->count();

            if ($cek == 0) {
                $sim = new angketPtm();
                $sim->user_id = auth()->user()->id;
                $sim->file = $rename;
                $sim->pilih = $request->radios;
                $sim->save();

                Session::flash("flash_notif", [
                    "level"   => "success",
                    "message" => "Pemilihan berhasil di simpan"
                ]);
            } else {
                $update = angketPtm::where('user_id', auth()->user()->id)->first();
                $update->pilih = $request->radios;
                $update->file = $rename;
                $update->save();

                Session::flash("flash_notif", [
                    "level"   => "success",
                    "message" => "Update berhasil di simpan"
                ]);
            }
            // jika siswa langsung memilih tidak maka querynya disini
        } else {

            $cek = angketPtm::where('user_id', auth()->user()->id)->count();
            if ($cek == 0) {
                $sim = new angketPtm();
                $sim->user_id = auth()->user()->id;
                $sim->file = '';
                $sim->pilih = $request->radios;
                $sim->save();
            } else {
                $update = angketPtm::where('user_id', auth()->user()->id)->first();
                $update->pilih = $request->radios;
                $update->save();
            }

            Session::flash("flash_notif", [
                "level"   => "success",
                "message" => "Pengeditan Pemilihan berhasil di simpan"
            ]);
        }

        return back();
    }
}
