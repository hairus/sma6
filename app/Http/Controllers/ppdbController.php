<?php

namespace App\Http\Controllers;

use App\Models\berkas;
use App\Models\ppdb_pengum;
use App\Models\Siswa_Lengkap;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;

class ppdbController extends Controller
{
    public function index()
    {
        return view('ppdb.ppdb');
    }

    public function peng()
    {
        $berkas = berkas::where('user_id', Auth::user()->id)->get();

        return view('ppdb.test', compact('berkas'));
    }

    public function formulir()
    {

        $berkas = berkas::where('user_id', Auth::user()->id)->get();

        return view('ppdb.test', compact('berkas'));
    }

    public function simpBerk(Request $request)
    {
        $this->validate($request, [
            'formulir' => 'required',
            'pembayaran' => 'required',
            'formulir' => 'required|mimes:jpg,jpeg',
            'pembayaran' => 'required|mimes:jpg,jpeg',
        ]);
        //================== mengambil ekstensi dari file ======================//
        $ekstensi1 = $request->formulir->getClientOriginalExtension();
        $ekstensi2 = $request->pembayaran->getClientOriginalExtension();
        //====== mengubah nama file =====================//
        $rename1 = 'smansaPem' . rand(11111, 99999) . '.' . $ekstensi1;
        $rename2 = 'smansaPem' . rand(11111, 99999) . '.' . $ekstensi2;

        $tempatUpload = 'ppdb';
        $file = $request->file('formulir');
        $file->move($tempatUpload, $rename1);
        $file1 = $request->file('pembayaran');
        $file1->move($tempatUpload, $rename2);

        $berkas = new berkas();
        $berkas->user_id = Auth::user()->id;
        $berkas->berkas = $rename1;
        $berkas->save();

        $berkas = new berkas();
        $berkas->user_id = Auth::user()->id;
        $berkas->berkas = $rename2;
        $berkas->save();

        Session::flash("flash_notif", [
            "level"   => "success",
            "message" => "Upload data sukses"
        ]);

        $cekkk = Siswa_Lengkap::where('user_id', Auth::user()->id)->count();

        if ($cekkk == 0) {
            $sl = new Siswa_Lengkap();
            $sl->user_id = Auth::user()->id;
            $sl->status = 1;
            $sl->save();
        }

        return back();
    }

    public function del($id)
    {
        $berkas = berkas::where([
            ['user_id', Auth::user()->id],
            ['id', $id]
        ])->delete();

        Session::flash("flash_notif", [
            "level"   => "danger",
            "message" => "Delete Data Sukses"
        ]);

        return back();
    }
}
