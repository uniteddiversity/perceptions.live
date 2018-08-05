<?php

namespace App\Controllers\User;

use App\Category;
use App\Content;
use App\Http\Controllers\Controller;
use App\MetaData;
use App\User;
use Content\Services\ContentService;
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
    /**
     * @var Category
     */
    private $category;
    /**
     * @var MetaData
     */
    private $metaData;
    /**
     * @var ContentService
     */
    private $contentService;

    public function __construct(Content $content, User $user, UserRepository $userRepository, Category $category, MetaData $metaData, ContentService $contentService)
    {
        $this->content = $content;
        $this->user = $user;
        $this->userRepository = $userRepository;
        $this->category = $category;
        $this->metaData = $metaData;
        $this->contentService = $contentService;
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
            'title' => 'required',
            'access_level_id' => 'required',
            'category_id' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'description' => 'required',
            'url' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $r = $request->toArray();
        $this->content->create(
            array(
                'title' => $r['title'],
                'access_level_id' => $r['access_level_id'],
                'category_id' => $r['category_id'],
                'description' => $r['description'],
                'brief_description' => $r['brief_description'],
                'url' => $r['url'],
                'lat' => $r['lat'],
                'long' => $r['long'],
                'user_id' => Auth::user()->id,
                'user_ip' => $request->ip(),
                'is_deleted' => 0,

                'video_producer' => $r['video_producer'],
                'onscreen' => $r['onscreen'],
                'organization' => $r['organization'],
                'learn_more_url' => $r['learn_more_url'],
                'co_creators' => $r['co_creators'],

                'grater_community_intention_id' => $r['grater_community_intention_id'],
                'primary_subject_tag_id' => $r['primary_subject_tag_id'],
                'secondary_subject_tag_id' => $r['secondary_subject_tag_id'],
                'submitted_footage' => $r['submitted_footage'],
                'location' => $r['location'],

                'captured_date' => $r['captured_date'],
                'video_date' => $r['video_date'],
//                'captured_date' => date('Y-m-d'),
//                'video_date' => date('Y-m-d'),
            )
        );

        return redirect()->back()->with('message', 'Successfully Added!');
    }

    public function userList()
    {
        $users = $this->userRepository->getUsers();
        return view('admin.user-list')
            ->with(compact('users'));
    }

    public function userAdd()
    {
        return view('admin.user-add')
            ->with(compact('uploaded_list'));
    }

    public function contentList()
    {
        $videos = $this->content->with('user')->get();
        return view('admin.content-list')
            ->with(compact('videos'));
    }

    public function contentAdd()
    {
        $categories = $this->category->get();
        $meta_array = $this->contentService->getMetaListByKey();

        return view('admin.content-add')
            ->with(compact('categories','meta_array'));
    }

    public function contentEdit(Request $request)
    {
        $categories = $this->category->get();
        $meta_array = $this->contentService->getMetaListByKey();

        return view('admin.content-add')
            ->with(compact('categories','meta_array'));
    }

    public function adminUserAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
//            'last_name' => 'required',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $r = $request->toArray();
        $this->user->create(
            array(
                'first_name' => $r['first_name'],
                'last_name' => $r['last_name'],
                'email' => $r['email'],
                'status_id' => $r['status_id'],
                'role_id' => $r['role_id'],
                'password' => bcrypt($r['password'])
            )
        );
        return redirect()->back()->with('message', 'Successfully Added!');
    }

    public function adminUserEdit($user_id)
    {
        return view('admin.user-add')
            ->with(compact('user_data'));
    }
}
