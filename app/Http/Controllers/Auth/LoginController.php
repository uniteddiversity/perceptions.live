<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use BeyondCode\EmailConfirmation\Traits\AuthenticatesUsers;
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
        if(filter_var($user_login['email'], FILTER_VALIDATE_EMAIL)) {
            //user sent their email
            $success = Auth::attempt(['email' => $user_login['email'], 'password' => $user_login['password']]);
        } else {
            //they sent their username instead
            $success = Auth::attempt(['display_name' => $user_login['email'], 'password' => $user_login['password']]);
        }

        if ($success) {
            if(Auth::user()->status_id != '1'){
                Auth::logout();
                return response()->json(array('error' => array('user' => 'Inactive Login!')), 200);
            }
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
