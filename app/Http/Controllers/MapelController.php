<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\mapels;
class MapelController extends Controller
{
    public function index()
    {
      $mapel = mapels::paginate(10);
      return view("/admin/mapel/index", ['Mapels' => $mapel]);
    }


}
