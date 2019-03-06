<?php

namespace App\Controllers\User;

use App\Category;
use App\ClaimAssociatedContents;
use App\ClaimProfileRequests;
use App\Content;
use App\Group;
use App\Http\Controllers\Controller;
use App\MediaPackage;
use App\MediaProject;
use App\MetaData;
use App\User;
use App\UserEditVideo;
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
                                ClaimProfileRequests $claimProfileRequests, ClaimAssociatedContents $claimAssociatedContents)
    {
        $this->content = $content;
        $this->user = $user;
        $this->userRepository = $userRepository;
        $this->category = $category;
        $this->metaData = $metaData;
        $this->contentService = $contentService;
        $this->group = $group;
        $this->claimProfileRequests = $claimProfileRequests;
        $this->claimAssociatedContents = $claimAssociatedContents;
    }

    public function profile()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
//        $user_acting_role = $this->userRepository->getUserActingRoles();
//        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        $categories = $this->category->get();
        $user_acting_role = $this->userRepository->getUserActingRoles();
        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        $sorting_tags = $this->userRepository->getSortingTags($user_id, true);

        return view('user.home')
            ->with(compact('users_data','user_acting_role','categories','gci_tags','sorting_tags'));
    }

    public function startProject()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $step_1_data = array();
        if(isset($_GET['step'])){
            $step = $_GET['step'];
            $step_1_data = session('step_1_data');
        }else{
            $step = 'step1';
            session()->forget('step_1_data');
        }

        $packages = new MediaPackage();
        $packages = $packages->get()->toArray();

        return view('user.content-add-movie')
            ->with(compact('user_id', 'step', 'step_1_data', 'packages'));
    }

    public function submitProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'location' => 'required',
        ]);

        $r = $request->toArray();
        $step = isset($r['next_step'])? $r['next_step'] : 'step1';

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        session()->put('step_1_data', $r);
        if(isset($r['next_step']) && $r['next_step'] == 'submit'){
            $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
            $mediaProject = new MediaProject();
            $project_data = $mediaProject->create( array('user_id' => $user_id,
                'title' => $r['title'],
                'location' => $r['location'],
                'video_date' => empty($r['captured_date'])?date('Y-m-d'):date('Y-m-d', strtotime($r['captured_date'])),
                'description' => $r['brief_description'],
                'status' => 1
            ) );

            session()->forget('step_1_data');
            $this->movieEditor( $project_data );
        }

        return redirect('/content-add-public?step='.$step);
    }

    public function uploadVideo()
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

        return view('user.content-add')
            ->with(compact('categories','meta_array','user_list','sorting_tags','groups','access_levels','status', 'gci_tags'));
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

        $new_content = $this->content->updateOrCreate(
            [
                'id'   => (isset($r['id']))?UID::translator($r['id']):0,
            ],
            [
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
                'status' => (( Auth::user()->is('admin') or Auth::user()->is('group-admin') or Auth::user()->is('moderator') ) && isset($r['status']))?$r['status']:2,

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
                'user_comment' => $r['user_comment']
            ]
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

        return redirect()->back()->with('message', 'Successfully Added!');
    }

    public function profileSettings()
    {
        $user_id = Auth::user()->id;

        $user_groups = $this->userRepository->groupList($user_id);
        $user_roles = $this->userRepository->getUserRoles($user_id);
        $user_data = $this->userRepository->getUser($user_id)->toArray();
        $status = $this->userRepository->getStatus();
        $user_acting_role = $this->userRepository->getUserActingRoles();
        $access_levels = $this->userRepository->getAccessLevels();
        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        $skill_tags = $this->userRepository->getSkillsTag();

        return view('user.user-profile')
            ->with(compact('user_data','user_groups','user_roles','status',
                'user_acting_role','access_levels','gci_tags','skill_tags'));
    }

    public function postProfileSettings(Request $request)
    {
        $r = $request->toArray();
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), []);
        if(empty($id)){
            $user_data = $this->userRepository->getUser($id);
            $r['email'] = empty($r['email'])?$this->userRepository->getAutoGeneratedEmail($r['display_name']):$r['email'];
            if($user_data['email'] != $r['email'] && $user_data['display_name'] != $r['display_name']){
                $validator = Validator::make($request->all(), [
                    'display_name' => 'required|unique:users',
//                'password' => 'required|min:6',
                    'email' => 'required|email|unique:users',
                    'user_avatar' => 'file|max:500',
                ]);
            }elseif($user_data['email'] != $r['email']){
                $validator = Validator::make($request->all(), [
//                    'display_name' => 'required|unique:users',
//                    'password' => 'required|min:6',
                    'email' => 'required|email|unique:users',
                    'user_avatar' => 'file|max:500',
                ]);
            }elseif($user_data['display_name'] != $r['display_name']){
                $validator = Validator::make($request->all(), [
                    'display_name' => 'required|unique:users',
                    'user_avatar' => 'file|max:500',
                ]);
            }else{
                $validator = Validator::make($request->all(), [
                    'user_avatar' => 'file|max:500'
                ]);
            }
        }else{
            $validator = Validator::make($request->all(), [
                'user_avatar' => 'file|max:500'
            ]);
        }
//dd($r);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        if(!empty($id)){//update existing
            $new_user = $this->user->updateOrCreate(
                [
                    'id'   => $id,
                ],
                [
                    'first_name' => $r['first_name'],
                    'display_name' => $r['display_name'],// cant update
                    'email' => $r['email'],
//                    'status_id' => $r['status_id'],
//                    'role_id' => $r['role_id'],
                    'location' => $r['location'],
                    'description' => $r['description'],
                    'access_level_id' => $r['access_level_id'],
//                'password' => bcrypt($r['password'])
                ]
            );
        }

        if(!empty($r['password']) && !empty($id)){
            $new_user = $this->user->updateOrCreate(
                [
                    'id'   => $id,
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

        if(isset($r['grater_community_intention_ids']))
        {
            //remove existing gci tags
            $this->userRepository->deleteTagsOfUserBySlug($id, $new_user->id, 'gci');
            foreach($r['grater_community_intention_ids'] as $gci_id){
                $this->userRepository->addTagToUser($new_user->id, $gci_id,'gci');
            }
        }

        if(isset($r['skills'])){
            $this->userRepository->deleteTagsOfUserBySlug($id, $new_user->id, 'skill');
            foreach($r['skills'] as $sorting_tags_id){
                $tag_id = base64_decode($sorting_tags_id);
                if(is_numeric($tag_id)){
                    $this->userRepository->addTagToUser($new_user->id, $tag_id,'skill');
                }else{
                    $newly_created_id = $this->userRepository->addIfNotExist($sorting_tags_id,'skill', $id);
                    if(isset($newly_created_id->id))
                        $this->userRepository->addTagToUser($new_user->id, $newly_created_id->id,  'skill');
                }
            }
        }

//        dd($r);

        return redirect()->back()->with('message', 'Successfully Added!');
    }

    public function contentList()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $videos = $this->contentService->getContentList($user_id);
        return view('user.content-list')
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

        return view('user.content-add')
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
        return view('user.content-add')
            ->with(compact('categories','meta_array','user_list','sorting_tags','groups','access_levels','video_data','status', 'gci_tags'));
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

    public function claimUserProfile()
    {
        $user_list = $this->userRepository->getUsers(array('filter_system_users' => true));
        return view('user.claim-profile-request')
            ->with(compact('user_list'));
    }

    public function claimUserProfileClean()
    {
        $user_list = $this->userRepository->getUsers(array('filter_system_users' => true));
        return view('partials.claim-profile-request')
            ->with(compact('user_list'));
    }

    public function claimUserProfilePost(Request $request)
    {
        $r = $request->toArray();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'display_name' => 'required',
            'claim_video_profile' => 'required',
            'confirm_selected_content' => 'required',
            'accept_tos' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $request = $this->claimProfileRequests->create(array(
            'type' => 'users',
            'fk_id' => $r['display_name'],
            'display_name' => '[display_name]',
            'email' => $r['email'],
            'comments' => $r['additional_comments'],
            'user_id' => $user_id
        ));

        foreach($r['claim_video_profile'] as $relation){
            $this->claimAssociatedContents->create(array(
                'attachment_id' => 'users',
                'type' => 'users',
                'claim_profile_request_id' => $request->id,
                'fk_id' => $relation
            ));
        }

        if(isset($request->id))
            $this->user->where('id', $r['display_name'])->update(array('status_id'=>'4'));

        if(isset($r['proof_of_work']))
            foreach($r['proof_of_work'] as $content){
                $this->userRepository->uploadAttachment($content,$user_id, $request->id, 'claim-proof', 'claim_profile_requests', 1);
            }

        return redirect()->back()->with('message', 'Requested!');
    }

    public function getAssociatedVideosByUserId($user_id)
    {
        $content_list = $this->userRepository->getAssociatedVideosForUser($user_id);
        return response()->json($content_list, 200);
    }

    public function postLastActive()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $r = $this->userRepository->updateLastActive($user_id);
        return response()->json($r, 200);
    }

    public function movieEditor($extra_data = [])
    {
        $video_editor_url = env("VIDEO_EDITOR_URL", "");
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;

        $token_key = $this->generateToken($user_id);
        $userEditVideos = new UserEditVideo();
        $userEditVideos->where('user_id', $user_id)->update( array('is_deleted' => '1') );
        //delete other tokens of that user
        $temp_data = $userEditVideos->create(array('user_id' => $user_id, 'token' => $token_key,
            'info' => json_encode(array('more_info' => $extra_data)), 'is_deleted' => '0'));
        ob_clean();
        echo '<script>window.location.href="'.$video_editor_url.'?key='.$temp_data->token.'"</script>';
        die();
    }

    public function getTokenInfo($token, UserEditVideo $userEditVideos)
    {
        $token_info = $userEditVideos->where('token', $token)
            ->leftJoin('users', 'users.id', 'user_edit_videos.user_id')
            ->select('users.id','users.display_name','users.email','user_edit_videos.token','user_edit_videos.info')
            ->where('is_deleted', '0')->get()->first();

        $token_info['info'] = json_decode($token_info['info']);
        return isset($token_info->id)? $token_info : array();
    }

    public function calculateVideoCost($token, Request $request, UserEditVideo $userEditVideos)
    {
        $token_info = $userEditVideos->where('token', $token)
            ->leftJoin('users', 'users.id', 'user_edit_videos.user_id')
            ->select('users.id','users.display_name','user_edit_videos.token','user_edit_videos.info')
            ->where('is_deleted', '0')->get()->first();

        if(!isset($token_info->id))
            return array('error' => 'Un authenticated!');

        $options = $request->all();
        return $this->userRepository->generateMediaCost($options);
    }

    public function generateInvoice($token, Request $request, UserEditVideo $userEditVideos)
    {
        $token_info = $userEditVideos->where('token', $token)
            ->leftJoin('users', 'users.id', 'user_edit_videos.user_id')
            ->select('users.id','users.display_name','user_edit_videos.token','user_edit_videos.info')
            ->where('is_deleted', '0')->get()->first();

        if(!isset($token_info->id))
            return array('error' => 'Un authenticated!');

        $options = $request->all();

        $invoiced_options = [];
        foreach($options as $key => $option){
            $key = explode('-',$key);
            if(isset($key[0]) && $key[1]){
                $invoiced_options[$key[0]][$key[1]] = $option;
            }
        }

        return $this->userRepository->generateInvoice($token_info->id, $invoiced_options);
    }

    public function closeProject($token, Request $request, UserEditVideo $userEditVideos)
    {
        $token_info = $userEditVideos->where('token', $token)
            ->leftJoin('users', 'users.id', 'user_edit_videos.user_id')
            ->select('users.id','users.display_name','user_edit_videos.token','user_edit_videos.info')
            ->where('is_deleted', '0')->get()->first();

        if(!isset($token_info->id))
            return array('error' => 'Un authenticated!');

        $options = $request->all();

        //invalidate the existing token
        $userEditVideos = new UserEditVideo();
        $userEditVideos->where('token', $token)->update(array('is_deleted' => '1'));

        //update project with status
        $mediaProject = new MediaProject();
        $mediaProject->where('id', $options['project_id'])->update(array('output' => $options['output']));

        //issue new token without project
        $token_key = $this->generateToken($token_info->id);
        $userEditVideos = new UserEditVideo();
        $userEditVideos->where('user_id', $token_info->id)->update( array('is_deleted' => '1') );

        //delete other tokens of that user
        $temp_data = $userEditVideos->create(array('user_id' => $token_info->id, 'token' => $token_key,
            'info' => json_encode(array('more_info' => [])), 'is_deleted' => '0'));
        return $temp_data->token;
    }

    private function generateToken($user_id)
    {
        return md5(rand(0,1000) + $user_id + time() + rand(0,1000));
    }

    public function getMyProjects($token, Request $request, UserEditVideo $userEditVideos)
    {
        $token_info = $userEditVideos->where('token', $token)
            ->leftJoin('users', 'users.id', 'user_edit_videos.user_id')
            ->select('users.id','users.display_name','user_edit_videos.token','user_edit_videos.info')
            ->where('is_deleted', '0')->get()->first();

        if(!isset($token_info->id))
            return array('error' => 'Un authenticated!');

        $options = $request->all();
        $projects = $this->userRepository->userProjects($token_info->id, $options);

        return $projects;
    }
}
