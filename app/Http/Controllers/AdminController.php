<?php

namespace App\Controllers\User;

use App\Category;
use App\ClaimAssociatedContents;
use App\ClaimProfileRequests;
use App\Content;
use App\Group;
use App\HomeSliderFeed;
use App\Http\Controllers\Controller;
use App\Mail\ClaimProfileApproved;
use App\Mail\contactUs;
use App\Mail\groupApproved;
use App\Mail\groupCreated;
use App\MediaPackage;
use App\MetaData;
use App\SiteSetting;
use App\User;
use Content\Services\ContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
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
    /**
     * @var SiteSetting
     */
    private $siteSetting;
    /**
     * @var HomeSliderFeed
     */
    private $homeSliderFeed;
    /**
     * @var ClaimProfileRequests
     */
    private $claimProfileRequests;
    /**
     * @var ClaimAssociatedContents
     */
    private $claimAssociatedContents;

    public function __construct(Content $content, User $user, UserRepository $userRepository,
                                Category $category, MetaData $metaData, ContentService $contentService, Group $group,
                                SiteSetting $siteSetting, HomeSliderFeed $homeSliderFeed, ClaimProfileRequests $claimProfileRequests, ClaimAssociatedContents $claimAssociatedContents)
    {
        $this->content = $content;
        $this->user = $user;
        $this->userRepository = $userRepository;
        $this->category = $category;
        $this->metaData = $metaData;
        $this->contentService = $contentService;
        $this->group = $group;
        $this->siteSetting = $siteSetting;
        $this->homeSliderFeed = $homeSliderFeed;
        $this->claimProfileRequests = $claimProfileRequests;
        $this->claimAssociatedContents = $claimAssociatedContents;
    }

    public function profile()
    {
        $user_acting_role = $this->userRepository->getUserActingRoles();
        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        $categories = $this->category->get();
        return view('user.home')
            ->with(compact('users_data','user_acting_role','categories','gci_tags'));
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
            'captured_date' => 'date_format:"d-m-Y"',
//            'video_date' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $r = $request->toArray();
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

            'captured_date' => (!empty($r['captured_date']))?Carbon::createFromFormat('d-m-Y', $r['captured_date'])->format('Y-m-d'):'',
            'video_date' => $r['video_date'],
//                'captured_date' => date('Y-m-d'),
//                'video_date' => date('Y-m-d'),
            'created_by' => $user_id,
            'user_comment' => $r['user_comment'],
            'language' => $r['language']
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

        if(!is_numeric(UID::translator($r['id']))){
            //add creator to association
            $this->userRepository->updateUserContentAssociations(Auth::user()->id, $new_content->id, 'creator');
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
        $languages = $this->contentService->getLanguages();

        return view('admin.content-add')
            ->with(compact('categories','meta_array','user_list','sorting_tags','groups','access_levels','status', 'gci_tags', 'languages'));
    }

    public function contentEdit($id)
    {
        $id = UID::translator($id);
        $uploaded_files = $this->contentService->getUploadedContent($id);
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
        $languages = $this->contentService->getLanguages();
        return view('admin.content-add')
            ->with(compact('categories','meta_array','user_list','sorting_tags','groups','access_levels',
                'video_data','status', 'gci_tags', 'uploaded_files','languages'));
    }

    public function comments($fk_id, $table){
        $id = UID::translator($fk_id);
        $comments = $this->userRepository->getComments($id, $table);
        return view('admin.comments-list')
            ->with(compact('comments', 'fk_id', 'table'));
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
            $this->userRepository->uploadAttachmentBase64($r['profile_image'],Auth::user()->id, $new_user->id,
                'avatar', 'users',1);
//            $this->userRepository->uploadAttachment($r['user_avatar'],Auth::user()->id, $new_user->id,
//                'avatar', 'users',1);
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
        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        $categories = $this->category->get();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $user_list = $this->userRepository->getUsers(array(),$user_id);
        $status = $this->userRepository->getStatus();

        $experience_knowledge_tags = $this->userRepository->getSkillsTag();
        $user_acting_role = $this->userRepository->getUserActingRoles();

        return view('admin.group-add')
            ->with(compact('categories','user_list','status','experience_knowledge_tags','user_acting_role','gci_tags'));
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
        $r = $request->toArray();
        if((isset($r['id']))){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:groups,name,'.UID::translator($r['id']),//pass the id as third parameter
                'description' => 'required',
                'category_id' => 'required'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:groups',
                'description' => 'required',
                'category_id' => 'required'
            ]);
        }


        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $old_group = [];
        if(isset($r['id'])){
            $old_group = $this->group->where('id', UID::translator($r['id']))->get()->first();
        }


        $new_group = $this->group->updateOrCreate(
            [
                'id'   => (isset($r['id']))?UID::translator($r['id']):0,
            ],
            [
                'greeting_message_to_community' => $r['greeting_message_to_community'],
                'name' => $r['name'],
                'description' => $r['description'],
                'current_mission' => $r['current_mission'],
                'experience_knowledge_interests' => isset($r['experience_knowledge_interests'])?$r['experience_knowledge_interests']:'',
                'default_location' => $r['default_location'],
                'learn_more_url' =>  $r['learn_more_url'],
                'category_id' => $r['category_id'],
                'contact_user_id' => $r['contact_user_id'],
//                'accept_tos' => isset($r['accept_tos'])? 1 : 0,
//                'created_by' => Auth::user()->id,
            ]
        );

        if(!(isset($r['id']))){
            $new_group = $this->group->updateOrCreate(
                [
                    'id' => $new_group->id,
                ],
                [
                    'created_by' => Auth::user()->id,
                ]
            );
        }

        if(isset($r['accept_tos'])){
            $new_group = $this->group->updateOrCreate(
                [
                    'id' => $new_group->id,
                ],
                [
                    'accept_tos' => isset($r['accept_tos'])? 1 : 0,
                ]
            );
        }

        if(isset($r['status'])){
            $new_group = $this->group->updateOrCreate(
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

        if(isset($r['experience_kno'])){
            $this->userRepository->deleteTagsOfGroupBySlug($new_group->id, 'experience_kno');
            foreach($r['experience_kno'] as $sorting_tags_id){
                $tag_id = base64_decode($sorting_tags_id);
                if(is_numeric($tag_id)){
                    $this->userRepository->addTagToGroup($new_group->id, $tag_id,'experience_kno');
                }else{
                    $newly_created_id = $this->userRepository->addIfNotExist($sorting_tags_id,'experience_kno', Auth::user()->id);
                    if(isset($newly_created_id->id))
                        $this->userRepository->addTagToGroup($new_group->id, $newly_created_id->id,  'experience_kno');
                }
            }
        }

        if(isset($r['grater_community_intention_ids'])){
            $this->userRepository->deleteTagsOfGroupBySlug($new_group->id, 'gci');
            foreach($r['grater_community_intention_ids'] as $sorting_tags_id){
                $tag_id = base64_decode($sorting_tags_id);
                if(is_numeric($tag_id)){
                    $this->userRepository->addTagToGroup($new_group->id, $tag_id,'gci');
                }else{
//                    $newly_created_id = $this->userRepository->addIfNotExist($sorting_tags_id,'gci', Auth::user()->id);
//                    if(isset($newly_created_id->id))
//                        $this->userRepository->addTagToGroup($new_group->id, $newly_created_id->id,  'gci');
                }
            }
        }

        //add role tag to user
        if(isset($new_group->id) && !empty($r['group_acting_roles'])){
            $this->userRepository->deleteGroupFromTag($new_group->id,'role');
            foreach($r['group_acting_roles'] as $tag){
                $user_group = $this->userRepository->addTagToGroup($new_group->id, $tag,'role');
            }
        }

        if(isset($r['id']) && $old_group->status == '2' && $new_group->status == '1' && $new_group->created_by != ''){
            $created_user = $this->user->where('id', $new_group->created_by)->first();
//            dd($created_user);
            if($created_user->id
                != Auth::user()->id &&
                $created_user->role_id != '1'){
                Mail::to($created_user)->send(new groupApproved($new_group));

                if($created_user->role_id == 120){//at the time group is approved, normal user will become group-admin
                    $this->user->where('id', $created_user->id)->update(['role_id' => 100]);
                }
            }
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
        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        $categories = $this->category->get();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $user_list = $this->userRepository->getUsers(array(),$user_id);
        $group = $this->userRepository->groupList($user_id, true, $id);
        $status = $this->userRepository->getStatus();
        $experience_knowledge_tags = $this->userRepository->getSkillsTag();
        $user_acting_role = $this->userRepository->getUserActingRoles();

        return view('admin.group-add')
            ->with(compact('categories','group','user_list','status','experience_knowledge_tags','user_acting_role','gci_tags'));
    }

    public function approveContent($id){
        return $this->content->where('id', $id)->update(array('status' => '1'));
    }

    public function mapGenerate()
    {
        $selected_users = array();
        $selected_videos = array();
        $selected_groups = array();
        $filter_list = $this->contentService->getGroupSearchFilterList();
        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        $categories = $this->category->get();
        return view('admin.generate-map')
            ->with(compact('gci_tags','categories','selected_users','selected_videos','selected_groups','filter_list'));
    }

    public function editMapGenerate($id)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $id = (isset($id))?UID::translator($id):0;
        $edit_data = $this->contentService->getGroupShareData($id);
        $filter_list = $this->contentService->getGroupSearchFilterList();

        if(isset($edit_data)){
            foreach($edit_data as $editd){
                if(isset($editd['id'])){
                    $data[$editd['table']][] = $editd['fk_id'];
                }
            }
        }

        $selected_users = array();
        $selected_videos = array();
        $selected_groups = array();

        if(isset($data['users'])){
            $users_list = $this->userRepository->getUsersList(0, array('ids' => $data['users']));

            $i = 0;
            foreach($users_list as $val){
                $selected_users[$i]['text'] = '@'.$val['display_name'];
                $selected_users[$i]['id'] = $val['id'];
                $i++;
            }
        }

        if(isset($data['contents'])){
            $list = $this->contentService->getSearchableContents(0, array('ids' => $data['contents']));

            $i = 0;
            foreach($list as $val){
                $selected_videos[$i]['text'] = $val['title'];
                $selected_videos[$i]['id'] = $val['id'];
                $i++;
            }
        }

        if(isset($data['groups'])){
            $list = $this->userRepository->getGroupList($user_id, array('ids' => $data['groups']));

            $i = 0;
            foreach($list as $val){
                $selected_groups[$i]['text'] = $val['name'];
                $selected_groups[$i]['id'] = $val['id'];
                $i++;
            }
        }//dd($selected_groups);

        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        $categories = $this->category->get();
        return view('admin.generate-map')
            ->with(compact('gci_tags','categories', 'edit_data','selected_users','selected_videos','selected_groups','filter_list'));
    }

    public function postMapGenerate(Request $request)
    {
        $r = $request->toArray();
        $id = (isset($r['id']))?UID::translator($r['id']):0;
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $map_list = $this->contentService->groupShareableContentsList($user_id);
        if(count($map_list) >= 1 && !Auth::user()->is('admin')){
            return Redirect::back()->withErrors('Maximum one map allowed!')->withInput();
        }
        $validator = Validator::make($request->all(), [
            'group' => 'required',
            'domain' => 'required',
            'default_zoom_level' => 'integer|between:1,15'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $data['associations']['grater_community_intention_ids'] = isset($r['grater_community_intention_ids'])?$r['grater_community_intention_ids']: array();
        $data['associations']['public_videos'] = isset($r['public_videos'])?$r['public_videos']: array();
        $data['associations']['associated_users'] = isset($r['associated_users'])?$r['associated_users']: array();
        $data['associations']['categories'] = isset($r['categories'])?$r['categories']: array();
        $data['associations']['groups'] = isset($r['groups'])?$r['groups']: array();
        $data['associations']['filter_list'] = isset($r['filter_list'])?$r['filter_list']: array();

        $data['basic'] = array(
            'group' => $r['group'],
            'allowed_domain' => $r['domain'],
            'allowed_ip' => gethostbyname($r['domain']),
            'primary_subject_tag' => $r['primary_subject_tag'],
            'created_by' => $user_id,
            'default_zoom_level' => $r['default_zoom_level'],
            'lat' => $r['lat'],
            'long' => $r['long'],
            'default_location' => $r['default_location'],
            'public_token' => $this->createToken(date('Y-m-d H:i:s')),
        );

        if(is_numeric($id) && $id != 0){
            unset($data['basic']['public_token']);
        }else{
            $id = 0;
        }

        $sheared_content = $this->contentService->createGroupShareableContents($user_id, $data, $id);

        if(Auth::user()->role_id == 1)
            return Redirect::route('admin-map-sharing-edit', ['_id' => UID($sheared_content->id)])->with('message', 'Successfully Added!');
        if(Auth::user()->role_id == 100)
            return redirect('user/group-admin/map-generate/'.UID($sheared_content->id))->with('message', 'Successfully Added!');
    }

    public static function createToken($prefix='', $length = 20)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return base64_encode($prefix).substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    public function mapGeneratedList()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;

        $list = $this->contentService->groupShareableContentsList($user_id);
        //dd($list);
        return view('admin.generated-map-list')
            ->with(compact('list','association'));
    }

    public function groupContentList($id)
    {
//        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
//        $videos = $this->contentService->getContentList($user_id, array('group_id' => $id));
        $videos = [];
        $group_id = $id;
        return view('admin.group-content-list')
            ->with(compact('videos','group_id'));
    }

    public function groupContentListAjax(Request $request, $id)
    {
        $r = $request->all();
        $page_size = isset($r['length'])?intval($r['length']):100;
        $start_rec = isset($r['start'])?intval($r['start']):0;
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $page = round($start_rec/$page_size);
        $videos = $this->contentService->getContentList($user_id, array('group_id' => $id), $page + 1, $page_size)->toArray();

        $processed = [];
        $i = 0;
        $processed = $videos;
        $processed['data'] = [];
        foreach($videos['data'] as $video){
            $processed['data'][$i]['action'] = '<a href="/user/admin/video-edit/'.uid($video['id']).'" data-toggle="tooltip" title="Edit"  ><i class="ti-pencil"></i></a>';
            if($video['status'] != '1')
                $processed['data'][$i]['action'] .= '<a class="approve-video inactive_link" id="approve_'.uid($video['id']).'" data-value="'.$video['id'].'" onclick="testFunction('.$video['id'].')" >Approve</span>';

            $processed['data'][$i]['title'] = $video['title'];
            $processed['data'][$i]['submitted_by'] = isset($video['user']['display_name'])?$video['user']['display_name']:'-';
            $processed['data'][$i]['status'] = ($video['status'] == '1')?'Approved' : 'Open';
            $processed['data'][$i]['url'] = $video['url'];
            $processed['data'][$i]['email'] = isset($video['user']['email'])?$video['user']['email']:'-';
            $processed['data'][$i]['location'] = $video['location'];
            $processed['data'][$i]['updated_at'] = $video['updated_at'];
            $i++;
        }
        $processed['recordsTotal'] = $videos['total'];
//        $draw = $r['draw'];
        $processed['draw'] = intval($r['draw']);
//        $processed['draw'] = 1;
        $processed['recordsFiltered'] = $videos['total'];

//        $ret = array('data' => $processed, 'draw' => 5, 'recordsTotal'=>100, 'recordsFiltered' => 100);
        return response()->json($processed, 200);
    }

    public function packageManager($id = 0)
    {
        $packages = new MediaPackage();
        $packages = $packages->get()->toArray();

        if($id > 0){
            $package = new MediaPackage();
            $edit_data = $package->where('id',$id)->first()->toArray();
        }
        return view('admin.video-edit-package-manage')
            ->with(compact('packages','edit_data'));
    }

    public function updatePackageManager(Request $request)
    {
        $r = $request->all();
        $packages = new MediaPackage();

        if(isset($r['id'])){
            $package = $packages->where('id', $r['id'])->update(
                array(
                    'name' => $r['name'],
                    'description' => $r['description'],
                    'free_storage' => $r['free_storage'],
                    'discount' => $r['discount'],
                    'charge_per_minute' => $r['charge_per_minute']
                )
            );

            if( $r['id']){
                return redirect('/user/admin/package-manager')->with('message', "Successfully Updated!");
            }
        }

        return Redirect::back()->withErrors('Wrong Package ID')->withInput();
    }

    public function siteSettings()
    {
        $data = $this->siteSetting->getAll()->toArray();
        $settings = [];
        foreach($data as $d){
            $settings[$d['key']] = $d['value'];
        }
        return view('admin.site-settings-add')
            ->with(compact('settings'));
    }

    public function postSiteSettings(Request $data)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $post_data = $data->all();
        if(isset($post_data['settings'])){
            $data_array = [];
            $this->siteSetting->deleteAll();
            $i = 0;
            foreach($post_data['settings'] as $key => $d){
                $data_array[$i]['key'] = $key;
                $data_array[$i]['value'] = $d;
                $data_array[$i]['other'] = '';
                $data_array[$i]['user_id'] = $user_id;
                $i++;
            }

            $this->siteSetting->insert($data_array);
        }

        return redirect()->back()->with('message', 'Successfully Updated!');
    }

    public function deleteHomeSliderFeed($id)
    {
//        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $id = UID::translator($id);

        $this->contentService->deleteHomeSlider($id);
        return Redirect::back()->with('message', "Successfully Deleted!");
    }

    public function listHomeSliderFeed()
    {
        $data = $this->contentService->listHomeSlider();
        return view('admin.home-slider-feed-list')
            ->with(compact('data'));
    }

    public function homeSliderFeed()
    {
        return view('admin.home-slider-feed-add')->with(compact('data'));
    }

    public function postHomeSliderFeed(Request $request)
    {
        $messages = [
            'fk_id.required' => 'Please search and select the Content!',
        ];

        $validator = Validator::make($request->all(), [
            'side' => 'required',
            'title' => 'required',
            'type' => 'required',
            'fk_id' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }
        $r = $request->toArray();
        if(is_array($r['type']) && count($r['type']) > 0 && count($r['fk_id']) > 0 && count($r['fk_id']) > 0){
            $new = $this->homeSliderFeed->create(
                array(
                    'side' => $r['side'],
                    'title' => $r['title'],
                    'type' => '',//not use anymore
                    'fk_id' => '0',//not use anymore
                )
            );

//            foreach($r['type'] as $t){
//                $this->userRepository->saveHomeSliderSettings($new->id, 'type-'.$t, $t);
//            }

            foreach($r['fk_id'] as $t){
                $p = explode('-', $t);
                $this->userRepository->saveHomeSliderSettings($new->id, $p[0], $p[1]);
            }
        }

        if(isset($new['id']) && isset($r['icon'])){
            $this->userRepository->uploadAttachment($r['icon'],Auth::user()->id, $new['id'],
                'home_slider_feeds ', 'home_slider_feeds',1);
        }

        return Redirect::back()->with('message', "Successfully Added!");
    }

    public function searchContentTypes($type, Request $request)
    {
        $r = $request->all();
        $types = explode(',', $type);
        $data = [];
        if(isset($r['q']['term'])){
            $data = $this->contentService->ajaxSearchContentGroup($r['q']['term'], $types);
        }
        echo json_encode($data);
    }

    public function listClaimProfileRequest()
    {
        $data = $this->userRepository->getClaimRequests();
        return view('admin.profile-claim-request-list')->with(compact('data'));
    }

    public function viewClaimProfileRequest($_id)
    {
        $id = UID::translator($_id);
        $data = $this->userRepository->getClaimRequests($id);

        return view('admin.profile-claim-request-view')->with(compact('data'));
    }

    public function editClaimProfileRequest($_id)
    {
        $id = UID::translator($_id);
        $data = $this->userRepository->getClaimRequests($id);

        return view('admin.profile-claim-request-edit')->with(compact('data'));
    }

    public function postEditClaimProfileRequest($_id, Request $request)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $r = $request->all();
        $id = UID::translator($_id);
        $validator = Validator::make($request->all(),
            [
//            'email' => 'required|email|unique:users',
                'display_name' => 'required',
                'claim_video_profile' => 'required',
                'email' => 'required',
            ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $rec = $this->claimProfileRequests->find($id)->update(array(
            'type' => 'users',
            'fk_id' => $r['display_name'],
            'display_name' => '[display_name]',
            'email' => $r['email'],
            'comments' => $r['additional_comments'],
        ));

        $this->claimAssociatedContents->where('claim_profile_request_id', $id)->delete();
        foreach($r['claim_video_profile'] as $relation){
            $this->claimAssociatedContents->create(array(
//                'attachment_id' => 'users',
                'type' => 'users',
                'claim_profile_request_id' => $id,
                'fk_id' => $relation
            ));
        }

        if(isset($r['proof_of_work']))
            foreach($r['proof_of_work'] as $content){
                $this->userRepository->uploadAttachment($content,$user_id, $id, 'claim-proof', 'claim_profile_requests', 1);
            }

        return redirect()->back()->with('message', 'Updated!');
    }

    public function postClaimProfileRequest($_id, Request $request)
    {
        $r = $request->all();
        $claim_info = $this->userRepository->getClaimRequests($_id);

        if($r['status'] != 1){//if deleting, no need to validate
            $this->userRepository->updateClaimRequestStatus($_id, $r['status'], $claim_info[0]->needUser);
            return redirect('/user/admin/list-profile-claim-request')->with('message', 'Successfully Deleted!');
        }

        if($claim_info[0]->needUser->status_id <> 5){
            return Redirect::back()->withErrors("User should be in 'System Created' status to claim");
        }

        $validator = Validator::make($r, [
            'email' => 'required|email|unique:users'
        ]);

        if($validator->fails()){
            return Redirect::back()->withErrors("Email '".$r['email']."' already exist under users");
        }

        $this->userRepository->updateClaimRequestStatus($_id, $r['status'], $claim_info[0]->needUser);
        $new_password = generate_password();
        $this->userRepository->updateClaimUser($claim_info[0]->needUser->id, $r['email'], $r['status'], $new_password);

        if($r['status'] == 1){
            $request_data = $this->userRepository->getClaimRequests($_id);
            $to = [
                [
                    'email' => env("ADMIN_MAIL"),
                    'name' => env("ADMIN_NAME"),
                ],
                [
                    'email' => $request_data[0]['email'],
                    'name' => $request_data[0]['email'],
                ]
            ];

            Mail::to($to)->send(new ClaimProfileApproved($request_data[0], $new_password));
        }

        return redirect('/user/admin/list-profile-claim-request')->with('message', 'Successfully Added!');
    }

    public function deleteComment(Request $request)
    {
        $id = UID::translator($request['id']);
        $user_id = Auth::user()->id;

        $d = $this->userRepository->deleteComment($id, $user_id);
        echo json_encode(array('data' => $id));
    }
}
