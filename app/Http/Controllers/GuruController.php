<?php

namespace App\Http\Controllers;

use lluminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Gurus;
use App\User;

class GuruController extends Controller
{
  public function index()
  {
    $gurus = Gurus::paginate(10);
    return view('/admin/guru/guru', ['Gurus' => $gurus]);
  }

  public function create()
  {
    return view('/admin/guru/create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
        'nama' => 'required',
        'pass' => 'required'
    ]);
    $user = New User;
    $user->name = $request->nama;
    $user->email = $request->email;
    $user->password = bcrypt($request->pass);
    $user->role = 1;
    $user->status = 'siswa';
    //dd($user);
    $user->save();

    $guru = New Gurus;
    $guru->nama   = $request->nama;
    $guru->nip    = $request->nip;
    $guru->email  = $request->email;
    $guru->status = $request->status;
    $guru->save();

    return redirect('admin/guru');
  }
  
}
