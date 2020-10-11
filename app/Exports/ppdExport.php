<?php

namespace App\Exports;

use App\Models\ppd;
use App\Models\siswa;
use App\pkd;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Http\Request;

class ppdExport implements FromView
{
    use Exportable;

        public function view(): View
        {
            //dd($request);
            $siswa = siswa::where('kelas_id', 1)->get();
            $pkd = pkd::where([
                ['guru_id',1],
                ['kelas_id',1],
                ['smt', 1]
            ])->get();
//            dd($request);
            return view('profile.template', [
                'siswa' => $siswa,
                'pkd'   => $pkd
            ]);
        }
}