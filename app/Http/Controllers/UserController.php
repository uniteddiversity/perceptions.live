<?php

namespace App\Controllers\User;

use App\Category;
use App\Content;
use App\Group;
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
    /**
     * @var Group
     */
    private $group;

    public function __construct(Content $content, User $user, UserRepository $userRepository,
                                Category $category, MetaData $metaData, ContentService $contentService, Group $group)
    {
        $this->content = $content;
        $this->user = $user;
        $this->userRepository = $userRepository;
        $this->category = $category;
        $this->metaData = $metaData;
        $this->contentService = $contentService;
        $this->group = $group;
    }

    public function profile()
    {
        return view('user.home')
            ->with(compact('users_data'));
    }

    public function uploadVideo()
    {
        $uploaded_list = $this->userRepository->getMyContents(Auth::user()->id);

        $categories = $this->category->get();
        $meta_array = $this->contentService->getMetaListByKey();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $user_list = $this->userRepository->getUsers(array(),$user_id);
        return view('user.upload-video')
            ->with(compact('uploaded_list','categories','meta_array','user_list'));
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
            'url' => 'required',
            'captured_date' => 'required',
            'video_date' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $r = $request->toArray();
        $new_content = $this->content->create(
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
                'status' => 2,

//                'video_producer' => $r['video_producer'],
//                'onscreen' => $r['onscreen'],
//                'co_creators' => $r['co_creators'],
                'organization' => $r['organization'],
                'learn_more_url' => $r['learn_more_url'],
                'co_creators' => '',
                'video_producer' => '',
                'onscreen' => '',

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

        //user associations with content
        if(isset($new_content->id)){
            $this->userRepository->deleteUserContentAssociations(0, $new_content->id, 'co-cr');
            $this->userRepository->deleteUserContentAssociations(0, $new_content->id, 'on-s');
            $this->userRepository->deleteUserContentAssociations(0, $new_content->id, 'vd-p');
            foreach($r['co_creators'] as $user_id){
                $this->userRepository->updateUserContentAssociations($user_id, $new_content->id, 'co-cr');
            }
            foreach($r['onscreen'] as $user_id){
                $this->userRepository->updateUserContentAssociations($user_id, $new_content->id, 'on-s');
            }
            foreach($r['video_producer'] as $user_id){
                $this->userRepository->updateUserContentAssociations($user_id, $new_content->id, 'vd-p');
            }
        }



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
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $user_groups = $this->userRepository->groupList($user_id);
        $user_roles = $this->userRepository->getUserRoles($user_id);

        return view('admin.user-add')
            ->with(compact('user_groups', 'user_roles'));
    }

    public function contentList()
    {
        $videos = $this->content->with('user')->get();
        return view('admin.content-list')
            ->with(compact('videos'));
    }

    public function contentAdd()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $categories = $this->category->get();
        $meta_array = $this->contentService->getMetaListByKey();
        $user_list = $this->userRepository->getUsers(array(),$user_id);
        return view('admin.content-add')
            ->with(compact('categories','meta_array','user_list'));
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
//            'password' => 'required|min:6',
            'email' => 'required|email|unique:users'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        if(empty($r['password'])){//if empty will create a random password
            $r['password'] = $this->userRepository->randomPassword();
        }

        $r = $request->toArray();
        $new_user = $this->user->create(
            array(
                'first_name' => $r['first_name'],
                'last_name' => $r['last_name'],
                'email' => $r['email'],
                'status_id' => $r['status_id'],
                'role_id' => $r['role_id'],
                'password' => bcrypt($r['password'])
            )
        );

        $this->userRepository->deleteAttachmentByFkId(Auth::user()->id, $new_user->id, 'avatar', 'users');
        if(isset($new_user->id) && isset($r['user_avatar'])){
            $this->userRepository->uploadAttachment($r['user_avatar'],Auth::user()->id, $new_user->id,
                'avatar', 'users',1);
        }

        //add to user group
        //delete existing group involvement
        if(isset($new_user->id) && !empty($r['group_id'])){
            $this->userRepository->deleteUserFromGroup($new_user->id, $r['group_id']);
            $user_group = $this->userRepository->addUserToGroup($new_user->id, $r['group_id']);
        }

        return redirect()->back()->with('message', 'Successfully Added!');
    }

    public function adminUserEdit($user_id)
    {
        return view('admin.user-add')
            ->with(compact('user_data'));
    }

    public function userToGroupAdd()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $groups = $this->userRepository->groupList($user_id);
        $user_list = $this->userRepository->getUsers(array(),$user_id);
        return view('admin.user-group-add')
            ->with(compact('user_list','groups'));
    }

    public function groupAdd()
    {
        $categories = $this->category->get();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $user_list = $this->userRepository->getUsers(array(),$user_id);
        return view('admin.group-add')
            ->with(compact('categories','user_list'));
    }

    public function postUserToGroupAdd()
    {
        return view('admin.user-add')
            ->with(compact('user_data'));
    }

    public function postGroupAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $r = $request->toArray();
        $new_group = $this->group->create(
            array(
                'name' => $r['name'],
                'description' => $r['description'],
                'current_mission' => $r['current_mission'],
                'experience_knowledge_interests' => $r['experience_knowledge_interests'],
                'default_location' => $r['default_location'],
                'learn_more_url' =>  $r['learn_more_url'],
                'category_id' => $r['category_id'],
                'contact_user_id' => $r['contact_user_id'],
                'accept_tos' => isset($r['accept_tos'])? 1 : 0,
                'created_by' => Auth::user()->id,
            )
        );

        $this->userRepository->deleteAttachmentByFkId(Auth::user()->id, $new_group->id, 'proof-of-group-in', 'groups');
        $this->userRepository->deleteAttachmentByFkId(Auth::user()->id, $new_group->id, 'group-avatar', 'groups');
        if(isset($r['proof_of_group'])){
            foreach($r['proof_of_group'] as $file){//dd($request['proof_of_group'][0]['name']);
                $this->userRepository->uploadAttachment($file,Auth::user()->id, $new_group->id,
                    'proof-of-group-in', 'groups',1);
            }
        }

        if(isset($r['group_avatar'])){
            $this->userRepository->uploadAttachment($r['group_avatar'],Auth::user()->id, $new_group->id,
                'group-avatar', 'groups',1);
        }

        return redirect()->back()->with('message', 'Successfully Added!');
    }
}
