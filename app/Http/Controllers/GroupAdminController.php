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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
//use System\Request;
use System\UID\UID;
use User\Services\UserRepository;

class GroupAdminController extends Controller
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
        $user_acting_role = $this->userRepository->getUserActingRoles();
        $categories = $this->category->get();
        return view('user.home')
            ->with(compact('users_data','user_acting_role','categories'));
    }

    public function userList()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $users = $this->userRepository->getUsers(array(),$user_id);
        return view('admin.user-list')
            ->with(compact('users'));
    }

    public function userAdd()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $user_groups = $this->userRepository->groupList($user_id);
        $user_roles = $this->userRepository->getUserRoles($user_id);
        $status = $this->userRepository->getStatus();
        $user_acting_role = $this->userRepository->getUserActingRoles();
        return view('admin.user-add')
            ->with(compact('user_groups', 'user_roles','status','user_acting_role'));
    }

    public function contentList()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $videos = $this->contentService->getContentList($user_id);
        return view('group-admin.content-list')
            ->with(compact('videos'));
    }

    public function contentAdd()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $categories = $this->category->get();
        $meta_array = $this->contentService->getMetaListByKey();
        $user_list = $this->userRepository->getUsers(array(),$user_id);
        $sorting_tags = $this->userRepository->getSortingTags($user_id, true);
        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        $groups = $this->userRepository->groupList($user_id);
        $access_levels = $this->userRepository->getAccessLevels();
        $status = $this->userRepository->getStatus();

        return view('admin.content-add')
            ->with(compact('categories','meta_array','user_list','sorting_tags','groups','access_levels','status', 'gci_tags'));
    }

    public function contentEdit($id)
    {
        $id = UID::translator($id);
        $video_data = $this->contentService->getContentData($id);
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $categories = $this->category->get();
        $meta_array = $this->contentService->getMetaListByKey();
        $user_list = $this->userRepository->getUsers(array(),$user_id);
        $sorting_tags = $this->userRepository->getSortingTags($user_id, true);
        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        $groups = $this->userRepository->groupList($user_id);
        $access_levels = $this->userRepository->getAccessLevels();
        $status = $this->userRepository->getStatus();
        return view('admin.content-add')
            ->with(compact('categories','meta_array','user_list','sorting_tags','groups','access_levels','video_data','status', 'gci_tags'));
    }

    public function adminUserAdd(Request $request)
    {
        $r = $request->toArray();
        $id = isset($r['id'])?UID::translator($r['id']):'';

        if(empty($r['id'])){
            $validator = Validator::make($request->all(), [
//                'first_name' => 'required',
                'display_name' => 'required|unique:users',
//                'password' => 'required|min:6',
                'email' => 'required|email|unique:users'
            ]);
            if(empty($r['password'])){//if empty will create a random password
                $r['password'] = $this->userRepository->randomPassword();
            }
        }else{
            $user_data = $this->userRepository->getUser($id);
            $r['email'] = empty($r['email'])?$this->userRepository->getAutoGeneratedEmail($r['display_name']):$r['email'];
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
//                'display_name' => 'required|unique:users',
//                'password' => 'required|min:6',
//                'email' => 'required|email|unique:users'
            ]);
        }

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        if(empty($id)){//create new
            $new_user = $this->user->updateOrCreate(
                [
                    'id' => ''],
                [
                    'first_name' => $r['first_name'],
                    'display_name' => $r['display_name'],
                    'email' => $r['email'],
                    'status_id' => $r['status_id'],
                    'role_id' => $r['role_id'],
                    'location' => $r['location'],
                    'password' => bcrypt($r['password'])
                ]
            );
        }else{//update existing
            $new_user = $this->user->updateOrCreate(
                [
                    'id'   => (isset($r['id']))?UID::translator($r['id']):0,
                ],
                [
                    'first_name' => $r['first_name'],
//                    'display_name' => $r['display_name'],// cant update
                    'email' => $r['email'],
                    'status_id' => $r['status_id'],
                    'role_id' => $r['role_id'],
                    'location' => $r['location'],
//                'password' => bcrypt($r['password'])
                ]
            );
        }

        if(!empty($r['password']) && !empty($id)){
            $new_user = $this->user->updateOrCreate(
                [
                    'id'   => (isset($r['id']))?UID::translator($r['id']):0,
                ],
                [
                    'password' => bcrypt($r['password'])
                ]
            );
        }

        if(isset($new_user->id) && isset($r['user_avatar'])){
            $this->userRepository->deleteAttachmentByFkId(Auth::user()->id, $new_user->id, 'avatar', 'users');
            $this->userRepository->uploadAttachment($r['user_avatar'],Auth::user()->id, $new_user->id,
                'avatar', 'users',1);
        }

        //add to user group
        if(isset($new_user->id) && !empty($r['group_id'])){
            //delete existing group involvement
            $this->userRepository->deleteUserFromGroup($new_user->id);
            $user_group = $this->userRepository->addUserToGroup($new_user->id, $r['group_id']);
        }

        //add role tag to user
        if(isset($new_user->id) && !empty($r['user_acting_roles'])){
            $this->userRepository->deleteUserFromTag($new_user->id,'role');
            foreach($r['user_acting_roles'] as $tag){
                $user_group = $this->userRepository->addTagToUser($new_user->id, $tag,'role');
            }
        }

        return redirect()->back()->with('message', 'Successfully Added!');
    }

    public function adminUserEdit($id)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $id = UID::translator($id);

        $user_groups = $this->userRepository->groupList($user_id);
        $user_roles = $this->userRepository->getUserRoles($user_id);
        $user_data = $this->userRepository->getUser($id)->toArray();
        $status = $this->userRepository->getStatus();
        $user_acting_role = $this->userRepository->getUserActingRoles();

        return view('admin.user-add')
            ->with(compact('user_data','user_groups','user_roles','status','user_acting_role'));
    }

    public function userToGroupAdd($group_id = 0)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $groups = $this->userRepository->groupList($user_id);
        $user_list = $this->userRepository->getUsers(array(),$user_id);
        $user_list_in_group = $this->userRepository->getUsers(array('group_id' => $group_id),$user_id);
        return view('group-admin.user-group-add')
            ->with(compact('user_list','groups','user_list_in_group','group_id'));
    }

    public function groupAdd()
    {
        $categories = $this->category->get();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $user_list = $this->userRepository->getUsers(array(),$user_id);
        $status = $this->userRepository->getStatus();
        return view('group-admin.group-add')
            ->with(compact('categories','user_list','status'));
    }

    public function postUserToGroupAdd(Request $request, $group_id)
    {
        $r = $request->toArray();

        if(is_array($r['users_in_groups']) && isset($group_id) && intVal($group_id) > 0){
            $this->userRepository->deleteUsersFromGroup($group_id);
            $user_ids = array();
            foreach($r['users_in_groups'][$group_id] as $user_id){
                $user_ids[$user_id] = $user_id;
            }

            foreach($user_ids as $user_id){
                $user_group = $this->userRepository->addUserToGroup($user_id, $group_id);
            }
        }


        return redirect()->back()->with('message', 'Successfully Added!');
    }

    public function postGroupAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:groups',
            'description' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $r = $request->toArray();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $new_group = $this->group->updateOrCreate(
            [
                'id'   => (isset($r['id']))?UID::translator($r['id']):0,
            ],
            [
                'greeting_message_to_community' => $r['greeting_message_to_community'],
                'name' => $r['name'],
                'description' => $r['description'],
                'current_mission' => $r['current_mission'],
                'experience_knowledge_interests' => $r['experience_knowledge_interests'],
                'default_location' => $r['default_location'],
                'learn_more_url' =>  $r['learn_more_url'],
                'category_id' => $r['category_id'],
                'contact_user_id' => $r['contact_user_id'],
//                'accept_tos' => isset($r['accept_tos'])? 1 : 0,
                'created_by' => Auth::user()->id,
            ]
        );

        if(isset($r['accept_tos'])){
            $this->group->updateOrCreate(
                [
                    'id' => $new_group->id,
                ],
                [
                    'accept_tos' => isset($r['accept_tos'])? 1 : 0,
                ]
            );
        }

        if(isset($r['status'])){
            $this->group->updateOrCreate(
                [
                    'id' => $new_group->id,
                ],
                [
                    'status' => $r['status'],
                ]
            );
        }

        if(isset($r['proof_of_group'])){
            $this->userRepository->deleteAttachmentByFkId(Auth::user()->id, $new_group->id, 'proof-of-group-in', 'groups');
            foreach($r['proof_of_group'] as $file){
                $this->userRepository->uploadAttachment($file,Auth::user()->id, $new_group->id,
                    'proof-of-group-in', 'groups',1);
            }
        }

        if(isset($r['group_avatar'])){
            $this->userRepository->deleteAttachmentByFkId(Auth::user()->id, $new_group->id, 'group-avatar', 'groups');
            $this->userRepository->uploadAttachment($r['group_avatar'],Auth::user()->id, $new_group->id,
                'group-avatar', 'groups',1);
        }

        $this->userRepository->addUserToGroup($user_id, $new_group->id);//add himself to the group

        return redirect()->back()->with('message', 'Successfully Added!');
    }

    public function sortingTagAdd()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $existing_tags = $this->userRepository->getSortingTags($user_id, true);
        return view('group-admin.user-sorting-tags')
            ->with(compact('existing_tags'));
    }

    public function postSortingTagAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tag' => 'required|unique:sorting_tags'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $r = $request->toArray();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $this->userRepository->addSortingTag($user_id, 0, array('tag' => $r['tag'], 'description' => $r['description'], 'tag_for' => 'content'));
        return redirect()->back()->with('message', 'Successfully Added!');
    }

    public function groupList()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $groups = $this->userRepository->groupList($user_id, true);
        return view('admin.group-list')
            ->with(compact('groups'));
    }

    public function editGroup($id, Request $request)
    {
        $id = UID::translator($id);

        $categories = $this->category->get();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $user_list = $this->userRepository->getUsers(array(),$user_id);
        $group = $this->userRepository->groupList($user_id, true, $id);
        $status = $this->userRepository->getStatus();
        return view('admin.group-add')
            ->with(compact('categories','group','user_list','status'));
    }
}
