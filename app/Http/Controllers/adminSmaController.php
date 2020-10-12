<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class adminSmaController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::all();
        return view('adminNew.index', compact('user'));
    }

    public function cu()
    {
        dd('come');
    }
}
