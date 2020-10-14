<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\trxUpload;
use App\User;
use Illuminate\Http\Request;

class guruSmaController extends Controller
{
    public function index()
    {
        return view('guru.index');
    }

    public function plhKls()
    {
        $kelas = kelas::orderBy('kelas', 'ASC')->get();

        return view('guru.plhKls', compact('kelas'));
    }

    public function kelas_id(Request $request)
    {
        $kelas = kelas::findorFail($request->kelas_id);

        return redirect('guru/kelas/' . $request->kelas_id);
    }

    public function redirect($id)
    {
        $kelas = kelas::findorFail($id);
        $users = User::where('kelas_id', $id)->orderBy('name')->get();
        $siswaBelum = User::doesntHave('uploads')->where('role', 3)->where('kelas_id', $id)->orderBy('name')->get();

        return view('guru.uploadFile', compact('kelas', 'users', 'siswaBelum'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf',
            'siswa_id' => 'required'
        ]);

        $ekstensi = $request->file->getClientOriginalExtension();
        //====== mengubah nama file =====================//
        $rename = 'sma6' . rand(11111, 99999) . '.' . $ekstensi;
        $tempatUpload = 'uploadSma6';
        $file = $request->file('file');
        $file->move($tempatUpload, $rename);

        /** create or update */
        $cek = trxUpload::where('siswa_id', $request->siswa_id)->count();
        $data = User::where('id', $request->siswa_id)->first();
        if ($cek == 0) {
            /** created */
            $sim = new trxUpload();
            $sim->siswa_id = $request->siswa_id;
            $sim->guru_id = auth()->user()->id;
            $sim->kelas_id = $data->kelas_id;
            $sim->file = $rename;
            $sim->save();
        } else {
            $trx = trxUpload::where('siswa_id', $request->siswa_id)->first();
            $trx->file = $rename;
            $trx->save();
        }

        return back();
    }

    public function allUpload()
    {
        $result = trxUpload::where('guru_id', auth()->user()->id)->get();

        return view('guru.result', compact('result'));
    }

    public function delUpload($id)
    {
        trxUpload::findorFail($id)->delete();

        return back();
    }
}
