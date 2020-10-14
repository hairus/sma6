<?php

namespace App\Http\Controllers;

use App\Models\trxUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class siswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cek = trxUpload::where('siswa_id', auth()->user()->id)->count();

        return view('siswa.index', compact('cek'));
    }

    public function download()
    {
        /** cek siswa */
        $trx = trxUpload::where('siswa_id', auth()->user()->id)->count();
        if ($trx > 0) {
            /** download jika ada */
            $data = trxUpload::where('siswa_id', auth()->user()->id)->first();

            $file = public_path() . "/uploadSma6/" . $data->file;
            $headers = array('Content-Type: application/pdf',);
            return response()->download($file, $data->file, $headers);
        }
    }
}
