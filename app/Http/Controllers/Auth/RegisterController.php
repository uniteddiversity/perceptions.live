<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use BeyondCode\EmailConfirmation\Events\Confirmed;
use BeyondCode\EmailConfirmation\Traits\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Foundation\Auth\RegistersUsers;
use User\Services\UserRepository;

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
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
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
        $new_user = User::create([
//            'first_name' => $data['first_name'],
            'display_name' => $data['display_name'],
            'email' => $data['email'],
            'location' => $data['location'],
            'password' => bcrypt($data['password']),
//            'cpassword' => $data['cpassword'],
//            'web' => $data['web'],
            'status_id' => '2',
            'role_id' => '120' //normal user
        ]);

        if($new_user->id)
        {
            //add role tag to user
            if(isset($new_user->id) && !empty($data['user_acting_roles'])){
                $this->userRepository->deleteUserFromTag($new_user->id,'role');
                foreach($data['user_acting_roles'] as $tag){
                    $this->userRepository->addTagToUser($new_user->id, $tag,'role');
                }
            }
        }

//        Auth::loginUsingId($new_user->id);

        return $new_user;
    }


    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'first_name' => 'required',
            'display_name' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'email' => 'required|email|unique:users',
            'accept_tos' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(array('error' => $validator->messages()), 200);
        }

        event(new Registered($user = $this->create( $request->toArray() )));

        $this->sendConfirmationToUser($user);

//        if($this->create($request->toArray())){
            return response()->json(array('success' => 'Please check your email for confirmation URL'), 200);
//        }
    }

    public function confirm($confirmation_code)
    {
        $model = $this->guard()->getProvider()->createModel();

        $user = $model->where('confirmation_code', $confirmation_code)->firstOrFail();

        $user->confirmation_code = null;
        $user->confirmed_at = now();
        $user->status_id = 1;
        $user->save();
        event(new Confirmed($user));
        Auth::loginUsingId($user->id);
        return $this->confirmed($user)
            ?: redirect($this->redirectAfterConfirmationPath())->with('confirmation', __('confirmation::confirmation.confirmation_successful'));
    }
}
