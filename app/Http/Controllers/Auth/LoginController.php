<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ppdb_profile;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function redirectTo()
    {
        $role = Auth::user()->role;
        if ($role == 1) {
            return 'admin';
        } elseif ($role == 2) {
            return 'guru';
        } elseif ($role == 3) {
            return 'siswa';
        }
    }


    //    protected $redirectTo = '/admin';
    //
    protected $username;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        $this->username = $this->findUsername();
        //		dd($this->findUsername());
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUsername()
    {
        $login = request()->input('username');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //    public function __construct()
    //    {
    //        $this->middleware('guest')->except('logout');
    //    }
}
