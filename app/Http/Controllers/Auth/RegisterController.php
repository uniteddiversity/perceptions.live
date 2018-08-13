<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'display_name' => $data['display_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
//            'cpassword' => $data['cpassword'],
            'web' => $data['web'],
            'role_id' => '4'
        ]);
    }


    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
//            'display_name' => 'required',
            'password' => 'required|confirmed|min:6',
            'email' => 'required|email|unique:users'
        ]);

        if ($validator->fails()) {
            return response()->json(array('error' => $validator->messages()), 200);
        }

        if($this->create($request->toArray())){
            return response()->json(array('success' => 'User has created'), 200);
        }
    }
}
