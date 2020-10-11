<?php

namespace App\Http\Controllers;

use App\Models\Micro;
use App\Models\siswa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validation;

class MicroController extends Controller
{
    public function index()
    {

        if(isset($_GET['nama']))
        {
            $simpan = new Micro();
            $simpan->rfid = $_GET['nama'];
            $simpan->save();
        }
        else
        {
            dump('kosong');
        }
    }

    public function indek()
    {
        $micro = Micro::all();
        $data = siswa::all();
        return view('admin.admins.micro', compact('micro', 'data'));
    }

    public function save(Request $request)
    {
        //dd($request);
        $update = Micro::where('rfid', $request->rfnya)->first();
        $update->nis = $request->rfid;
        $update->save();

        return back();
    }

}
