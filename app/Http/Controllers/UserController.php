<?php

namespace App\Controllers\User;

use App\Content;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use User\Services\UserRepository;

class UserController extends Controller
{
    /**
     * @var Content
     */
    private $content;
    /**
     * @var User
     */
    private $user;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(Content $content, User $user, UserRepository $userRepository)
    {
        $this->content = $content;
        $this->user = $user;
        $this->userRepository = $userRepository;
    }

    public function profile()
    {
        return view('user.home')
            ->with(compact('users_data'));
    }

    public function uploadVideo()
    {
        $uploaded_list = $this->userRepository->getMyContents(Auth::user()->id);
        return view('user.upload-video')
            ->with(compact('uploaded_list'));
    }

    public function postUploadVideo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'access_level_id' => 'required',
            'type' => 'required',
            'lat' => 'required',
            'long' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $r = $request->toArray();
        $this->content->create(
            array(
                'name' => $r['name'],
                'access_level_id' => $r['access_level_id'],
                'type' => $r['type'],
                'content' => $r['content'],
                'url' => '',
                'lat' => $r['lat'],
                'long' => $r['long'],
                'user_id' => Auth::user()->id,
                'user_ip' => $request->ip(),
                'is_deleted' => 0
            )
        );

        return redirect()->back()->with('message', 'Successfully Added!');
    }
}
