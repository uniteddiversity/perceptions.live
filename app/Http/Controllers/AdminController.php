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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
//use System\Request;
use System\UID\UID;
use User\Services\UserRepository;

class AdminController extends Controller
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

    public function uploadVideo()
    {
        $uploaded_list = $this->userRepository->getMyContents(Auth::user()->id);
        $status = $this->userRepository->getStatus();
        $categories = $this->category->get();
        $meta_array = $this->contentService->getMetaListByKey();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $user_list = $this->userRepository->getUsers(array(),$user_id);

        return view('user.upload-video')
            ->with(compact('uploaded_list','categories','meta_array','user_list','status'));
    }

    public function postUploadVideo(Request $request)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'access_level_id' => 'required',
//            'category_id' => 'required',
            'lat' => 'required',
            'long' => 'required',
//            'description' => 'required',
//            'url' => 'required',
//            'captured_date' => 'required',
//            'video_date' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $r = $request->toArray();
//dd($r['captured_date']);
        $update_array = [
            'title' => $r['title'],
            'access_level_id' => $r['access_level_id'],
            'category_id' => $r['category_id'],
//                'description' => $r['description'],
            'brief_description' => $r['brief_description'],
            'url' => $r['url'],
            'lat' => $r['lat'],
            'long' => $r['long'],
            'user_id' => Auth::user()->id,
            'user_ip' => $request->ip(),
            'status' => (Auth::user()->is('admin') && isset($r['status']))?$r['status']:2,

//                'video_producer' => $r['video_producer'],
//                'onscreen' => $r['onscreen'],
//                'co_creators' => $r['co_creators'],
//                'organization' => $r['organization'],
            'learn_more_url' => $r['learn_more_url'],
            'co_creators' => '',
            'video_producer' => '',
            'onscreen' => '',

//                'grater_community_intention_id' => $r['grater_community_intention_id'],
            'primary_subject_tag' => $r['primary_subject_tag'],
//                'secondary_subject_tag_id' => $r['secondary_subject_tag_id'],
            'submitted_footage' => $r['submitted_footage'],
            'location' => $r['location'],

            'captured_date' => Carbon::createFromFormat('d-m-Y', $r['captured_date'])->format('Y-m-d'),
            'video_date' => $r['video_date'],
//                'captured_date' => date('Y-m-d'),
//                'video_date' => date('Y-m-d'),
            'created_by' => $user_id,
            'user_comment' => $r['user_comment']
        ];
        if(isset($r['id'])){//if edit, original creator should remain
            unset($update_array['created_by']);
            unset($update_array['user_id']);
            unset($update_array['user_ip']);
        }

        $new_content = $this->content->updateOrCreate(
            [
                'id'   => (isset($r['id']))?UID::translator($r['id']):0,
            ],
            $update_array
        );


        if(isset($r['id'])){
            $this->userRepository->deleteTagsOfContent($new_content->id,$user_id);
            $this->userRepository->deleteTagsOfContent($new_content->id,$user_id,'gci');
            $this->userRepository->deleteTagsOfContent($new_content->id,$user_id,'exchange');
        }
        //tag related to exchange should goes here//

        //user associations with content
        if(isset($new_content->id)){
            $this->userRepository->deleteUserContentAssociations($user_id, $new_content->id, 'co-cr');
            $this->userRepository->deleteUserContentAssociations($user_id, $new_content->id, 'on-s');
            $this->userRepository->deleteUserContentAssociations($user_id, $new_content->id, 'vd-p');
            if(isset($r['co_creators'])){
                foreach($r['co_creators'] as $a_user_ori){
                    $a_user_id = base64_decode($a_user_ori);
                    if(is_numeric($a_user_id)){
                        $this->userRepository->updateUserContentAssociations($a_user_id, $new_content->id, 'co-cr');
                    }else{
                        $newly_created_id = $this->userRepository->addIfNotExist($a_user_ori,'user');
                        if($newly_created_id){
                            $this->userRepository->updateUserContentAssociations($newly_created_id->id, $new_content->id, 'co-cr');
                        }
                    }
                }
            }
            if(isset($r['onscreen'])){
                foreach($r['onscreen'] as $a_user_ori){
                    $a_user_id = base64_decode($a_user_ori);
                    if(is_numeric($a_user_id)){
                        $this->userRepository->updateUserContentAssociations($a_user_id, $new_content->id, 'on-s');
                    }else{
                        $newly_created_id = $this->userRepository->addIfNotExist($a_user_ori,'user');
                        if($newly_created_id){
                            $this->userRepository->updateUserContentAssociations($newly_created_id->id, $new_content->id, 'on-s');
                        }
                    }
                }
            }
            if(isset($r['video_producer'])){
                foreach($r['video_producer'] as $a_user_ori){
                    $a_user_id = base64_decode($a_user_ori);
                    if(is_numeric($a_user_id)){
                        $this->userRepository->updateUserContentAssociations($a_user_id, $new_content->id, 'vd-p');
                    }else{
                        $newly_created_id = $this->userRepository->addIfNotExist($a_user_ori,'user');
                        if($newly_created_id){
                            $this->userRepository->updateUserContentAssociations($newly_created_id->id, $new_content->id, 'vd-p');
                        }
                    }
                }
            }
        }

        //group associations with content
        if(isset($new_content->id)){
            $this->userRepository->deleteGroupContentAssociations($user_id, $new_content->id);
            if(isset($r['groups'])){
                foreach($r['groups'] as $group_id_id){
                    $group_id = base64_decode($group_id_id);
                    if(is_numeric($group_id)){
                        $this->userRepository->updateGroupContentAssociations($user_id, $new_content->id, $group_id);
                    }else{
                        $newly_created_id = $this->userRepository->addIfNotExist($group_id_id,'group');
                        if($newly_created_id){
                            $this->userRepository->updateGroupContentAssociations($user_id, $new_content->id, $newly_created_id->id);
                        }
                    }
                }
            }

            if(isset($r['sorting_tags'])){

                foreach($r['sorting_tags'] as $sorting_tags_id){
                    $tag_id = base64_decode($sorting_tags_id);
                    if(is_numeric($tag_id)){
                        $this->userRepository->addTagToContent($tag_id,  $new_content->id);
                    }else{
                        $newly_created_id = $this->userRepository->addIfNotExist($sorting_tags_id,'tag', $user_id);
                        if(isset($newly_created_id->id))
                            $this->userRepository->addTagToContent($newly_created_id->id,  $new_content->id);
                    }
                }
            }

            if(isset($r['grater_community_intention_ids']))
            {
                //remove existing gci tags
                foreach($r['grater_community_intention_ids'] as $gci_id){
                    $this->userRepository->addTagToContent($gci_id,  $new_content->id,'gci');
                }
            }
        }

        if(isset($r['exchange'])){
            if(isset($r['service_or_opportunity'])){
                $this->userRepository->addTagToContent($r['service_or_opportunity'],  $new_content->id,'exchange');
            }
        }

        ///////////////////video upload////////////////////
        if(isset($r['content_set1']))
            foreach($r['content_set1'] as $content){
                $this->userRepository->uploadAttachment($content,$user_id, $new_content->id, 'video-s-1', 'contents', 1);
            }

        if(isset($r['content_set2']))
            foreach($r['content_set2'] as $content){
                $this->userRepository->uploadAttachment($content,$user_id, $new_content->id, 'video-s-2', 'contents', 1);
            }

        if(isset($r['content_set3']))
            foreach($r['content_set3'] as $content){
                $this->userRepository->uploadAttachment($content,$user_id, $new_content->id, 'video-s-3', 'contents', 1);
            }
        ////////////////////end video upload//////////////////
        if(isset($r['id']) && is_numeric(UID::translator($r['id']))){
            $msg = 'Successfully Edited!';
        }else{
            $msg = 'Successfully Added!';
        }
        return redirect()->back()->with('message', $msg);
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
        return view('admin.content-list')
            ->with(compact('videos'));
    }

    public function contentOpenList()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $videos = $this->contentService->getContentList($user_id, array('open_list'=>true));
        return view('admin.content-list')
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
            if($user_data['email'] != $r['email'] && $user_data['display_name'] != $r['display_name']){
                $validator = Validator::make($request->all(), [
                    'display_name' => 'required|unique:users',
//                'password' => 'required|min:6',
                    'email' => 'required|email|unique:users'
                ]);
            }elseif($user_data['email'] != $r['email']){
                $validator = Validator::make($request->all(), [
//                    'display_name' => 'required|unique:users',
//                    'password' => 'required|min:6',
                    'email' => 'required|email|unique:users'
                ]);
            }elseif($user_data['display_name'] != $r['display_name']){
                $validator = Validator::make($request->all(), [
                    'display_name' => 'required|unique:users',
                ]);
            }else{
                $validator = Validator::make($request->all(), [
                ]);
            }

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
                    'display_name' => $r['display_name'],// cant update
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

        $claim_request = $this->userRepository->getClaimRequestsForUser($id);
        return view('admin.user-add')
            ->with(compact('user_data','user_groups','user_roles','status','user_acting_role','claim_request'));
    }

    public function userToGroupAdd($group_id = 0)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $groups = $this->userRepository->groupList($user_id);
        $user_list = $this->userRepository->getUsers(array(),$user_id);
        $user_list_in_group = $this->userRepository->getUsers(array('group_id' => $group_id),$user_id);
        return view('admin.user-group-add')
            ->with(compact('user_list','groups','user_list_in_group','group_id'));
    }

    public function groupAdd()
    {
        $categories = $this->category->get();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $user_list = $this->userRepository->getUsers(array(),$user_id);
        $status = $this->userRepository->getStatus();
        return view('admin.group-add')
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
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $r = $request->toArray();

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

        return redirect()->back()->with('message', 'Successfully Added!');
    }

    public function sortingTagAdd()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $existing_tags = $this->userRepository->getSortingTags($user_id, true);
        return view('admin.user-sorting-tags')
            ->with(compact('existing_tags'));
    }

    public function postSortingTagAdd(Request $request)
    {
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

    public function approveContent($id){
        return $this->content->where('id', $id)->update(array('status' => '1'));
    }
}
