<?php

namespace App\Http\Controllers;

use App\Models\log_view_pkpd;
use App\Models\mapels;
use App\Models\ppd;
use App\Models\ta;
use App\pkd;
use App\User;
use Illuminate\Http\Request;

class AdminApi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findorfail(1);

        return response()->json($user);
    }

    public function AllMapel(Request $request)
    {
        $mapels = mapels::all();

        return response()->json($mapels);
    }

    public function getSetkd(Request $request)
    {
        $ta = ta::where('status', 1)->first();
        $pkds = pkd::with('mapel', 'kls', 'guru')->where([
            ['mapel_id', $request->mapel_id],
            ['ta_id', $ta->id]
        ])->orderBy('guru_id')->orderBy('kelas_id')->get();

        return response()->json($pkds);
    }

    public function DelSetkd(Request $request)
    {
        $pkds = pkd::whereId($request->set_kd_id)->get();
        $ppds = ppd::where('pkd_id', $request->set_kd_id)->get();

        return response()->json($ppds);
    }

    public function getGurus()
    {
        $user = User::where('role', 2)->orderBy('name', 'asc')->get();

        return response()->json($user);
    }

    public function logPkpd()
    {
        $log = log_view_pkpd::with(['users' => function($q){
            $q->with(['kelas_siswas' => function($kls) {
                $kls->with('kelas');
            }]);
        }])->get();

        return response()->json($log);
    }
}
