<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest')->except('logout');
    }

    public function userLogin(Request $request)
    {
        $request = $request->toArray();
        $user_login['email'] = $request['email'];
        $user_login['password'] = $request['password'];
        if (Auth::attempt($user_login)) {
            return response()->json(array('success' => 'Logged in!'), 200);
        } else {
            return response()->json(array('error' => array('user' => 'Invalid login!')), 200);
        }
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
