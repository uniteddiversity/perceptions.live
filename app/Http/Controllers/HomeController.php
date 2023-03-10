<?php

namespace App\Controllers;

use App\Category;
use App\Content;
use App\Http\Controllers\Controller;
use App\Mail\contactUs;
use App\SiteSetting;
use App\User;
use Content\Services\ContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use System\UID\UID;
use User\Services\UserRepository;

class HomeController extends Controller
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
     * @var ContentService
     */
    private $contentService;
    /**
     * @var Category
     */
    private $category;
    /**
     * @var SiteSetting
     */
    private $siteSetting;

    private $per_page = 4;

    public function __construct(Content $content, User $user, UserRepository $userRepository, ContentService $contentService,
                                Category $category, SiteSetting $siteSetting)
    {
        $this->content = $content;
        $this->user = $user;
        $this->userRepository = $userRepository;
        $this->contentService = $contentService;
        $this->category = $category;
        $this->siteSetting = $siteSetting;
    }

    public function home()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $filter = array();
        $data = $this->siteSetting->getAll()->toArray();
        $settings = [];
        foreach($data as $d){
            $settings[$d['key']] = $d['value'];
        }
        $top_slider_feed = $this->contentService->listHomeSlider();


        $uploaded_list = $this->userRepository->getPublicContents($user_id, $filter);
        $user_acting_role = $this->userRepository->getUserActingRoles();
        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        $sorting_tags = $this->userRepository->getSortingTags($user_id, true);
        $categories = $this->category->get();
        return view('user.home')
            ->with(compact('uploaded_list','user_acting_role','categories','gci_tags','sorting_tags', 'top_slider_feed','settings'));
    }

    public function ajaxVideos($id = 0)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $uploaded_list = $this->userRepository->getPublicContents($user_id);
        return $this->getSearchListInJson($uploaded_list);
    }

    public function ajaxVideosNew($id = 0)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $uploaded_list = $this->userRepository->getAvailableContents($id);
        $ret = array(); $i = 0;
        foreach($uploaded_list as $u){
            $ret[$i]['id'] = $u['id'];
            $ret[$i]['lng'] = floatval($u['long']);
            $ret[$i]['lat'] = floatval($u['lat']);
            $ret[$i]['name'] = $u['title'];
            $i++;
        }
        return response()->json($ret, 200);
    }

    public function getVideoInfo($video_id)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $info = $this->userRepository->getContentsInfo($user_id, $video_id);
        $comments = $this->userRepository->getArrangedComments($video_id, 'contents');
        $with_layout = true;

        return view('partials.video-info-popup')
            ->with(compact('info', 'comments', 'with_layout'));
    }

    public function getVideoInfoPage($category, $date, $title, $video_id)
    {
        $video_id = UID::translator($video_id);
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $info = $this->userRepository->getContentsInfo($user_id, $video_id);
        $comments = $this->userRepository->getArrangedComments($video_id, 'contents');
        return view('user.video-info-popup')
            ->with(compact('info', 'comments'));
    }

    public function infoVideoPopupByUrl($category, $date, $title, $video_id){
        $video_profile_id = UID::translator($video_id);

        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $filter = array();
        $data = $this->siteSetting->getAll()->toArray();
        $settings = [];
        foreach($data as $d){
            $settings[$d['key']] = $d['value'];
        }
        $top_slider_feed = $this->contentService->listHomeSlider();


        $uploaded_list = $this->userRepository->getPublicContents($user_id, $filter);
        $user_acting_role = $this->userRepository->getUserActingRoles();
        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        $sorting_tags = $this->userRepository->getSortingTags($user_id, true);
        $categories = $this->category->get();
        return view('user.home')
            ->with(compact('uploaded_list','user_acting_role','categories','gci_tags','sorting_tags', 'top_slider_feed','settings', 'video_profile_id'));
    }

    public function infoGroupPopupByUrl($group_name, $group_id){
        $group_profile_id = UID::translator($group_id);

        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $filter = array();
        $data = $this->siteSetting->getAll()->toArray();
        $settings = [];
        foreach($data as $d){
            $settings[$d['key']] = $d['value'];
        }
        $top_slider_feed = $this->contentService->listHomeSlider();


        $uploaded_list = $this->userRepository->getPublicContents($user_id, $filter);
        $user_acting_role = $this->userRepository->getUserActingRoles();
        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        $sorting_tags = $this->userRepository->getSortingTags($user_id, true);
        $categories = $this->category->get();
        return view('user.home')
            ->with(compact('uploaded_list','user_acting_role','categories','gci_tags','sorting_tags', 'top_slider_feed','settings', 'group_profile_id'));
    }

    public function infoUserPopupByUrl($user_name, $user_id){
        $user_profile_id = UID::translator($user_id);

        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $filter = array();
        $data = $this->siteSetting->getAll()->toArray();
        $settings = [];
        foreach($data as $d){
            $settings[$d['key']] = $d['value'];
        }
        $top_slider_feed = $this->contentService->listHomeSlider();


        $uploaded_list = $this->userRepository->getPublicContents($user_id, $filter);
        $user_acting_role = $this->userRepository->getUserActingRoles();
        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        $sorting_tags = $this->userRepository->getSortingTags($user_id, true);
        $categories = $this->category->get();
        return view('user.home')
            ->with(compact('uploaded_list','user_acting_role','categories','gci_tags','sorting_tags', 'top_slider_feed','settings', '$user_profile_id'));
    }

    public function getVideoInfoMini($video_id)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $info = $this->userRepository->getContentsInfo($user_id, $video_id);

        return view('partials.video-info-popup-small')
            ->with(compact('info'));
    }

    public function getVideoInfoSharedMini($video_id)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $info = $this->userRepository->getContentsInfo($user_id, $video_id);

        return view('partials.video-info-popup-shared-small')
            ->with(compact('info'));
    }

    public function getVideoMoreInfo($video_id)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $info = $this->userRepository->getContentsInfo($user_id, $video_id);

        return view('user.video-info')
            ->with(compact('info'));
    }

    public function getUserInfo($user_id)
    {
        $user_associate_videos = $this->userRepository->getAssociatedVideosForUser($user_id);
        $info = $this->userRepository->getUser($user_id);
        $info['user_groups'] = $this->userRepository->getUserGroups($user_id, $contents2, $this->per_page);
        $info['user_involvement_videos'] = $this->userRepository->getPublicContents($user_id, array('user_involvement' => $user_id), $count, $contents1, $this->per_page);
        $info['group_involvement_videos'] = $this->userRepository->getPublicContents($user_id, array('group_involvement' => $user_id), $count);

        $user_status = $this->userRepository->getUserStatus($user_id);
        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        return view('partials.user-info-popup')
            ->with(compact('info','user_associate_videos','gci_tags','user_status', 'contents1', 'contents2', 'user_id'));
    }

    public function getUserInfoPage($user_name, $user_id)
    {
        $user_id = UID::translator($user_id);
        $user_associate_videos = $this->userRepository->getAssociatedVideosForUser($user_id);
        $info = $this->userRepository->getUser($user_id);
        $info['user_groups'] = $this->userRepository->getUserGroups($user_id, $contents2, $this->per_page);
        $info['user_involvement_videos'] = $this->userRepository->getPublicContents($user_id, array('user_involvement' => $user_id), $count, $contents1, $this->per_page);
        $info['group_involvement_videos'] = $this->userRepository->getPublicContents($user_id, array('group_involvement' => $user_id), $count);

        $user_status = $this->userRepository->getUserStatus($user_id);
        $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
        return view('user.user-info')
            ->with(compact('info','user_associate_videos','gci_tags','user_status', 'contents1', 'contents2', 'user_id'));
    }

    public function getUserInfoVideoPartial($user_id)
    {
        $contentInfo = $this->userRepository->getPublicContents($user_id, array('user_involvement' => $user_id), $count, $paginationData, $this->per_page);

        return view('partials.user-info-popup_video-info')
            ->with(compact('contentInfo', 'paginationData', 'user_id'));
    }

    public function getUserInfoGroupPartial($user_id)
    {
        $groupsInfo = $this->userRepository->getUserGroups($user_id, $paginationData, $this->per_page);
        return view('partials.user-info-popup_group-info')
            ->with(compact('groupsInfo', 'paginationData', 'user_id'));
    }

    public function getGroupInfo($group_id)
    {
        $info = $this->userRepository->getGroupInfo($group_id, true, true);
        $group_contents = $this->contentService->getSearchableContents(0, array('group_id' => $group_id), 10, $contents1, $this->per_page);
        $group_users = $this->userRepository->getUsers(array('group_id' => $group_id), null,$contents2, $this->per_page);
        return view('partials.group-info-popup')
            ->with(compact('info','group_contents','group_users', 'contents1', 'contents2', 'group_id'));
    }

    public function getGroupInfoPage($group_name, $group_id)
    {
        $group_id = UID::translator($group_id);
        $info = $this->userRepository->getGroupInfo($group_id, true, true);
        $group_contents = $this->contentService->getSearchableContents(0, array('group_id' => $group_id), 10, $contents1, $this->per_page);
        $group_users = $this->userRepository->getUsers(array('group_id' => $group_id), null,$contents2, $this->per_page);
        return view('user.group-info')
            ->with(compact('info','group_contents','group_users', 'contents1', 'contents2', 'group_id'));
    }

    public function getGroupInfoUsersPartial($group_id)
    {
        $groupUsers = $this->userRepository->getUsers(array('group_id' => $group_id), null,$paginationData, $this->per_page);
        return view('partials.group-info-popup_user')
            ->with(compact('groupUsers','paginationData'));
    }

    public function getGroupInfoVideoPartial($group_id)
    {
        $videos = $this->contentService->getSearchableContents(0, array('group_id' => $group_id), 10, $paginationData, $this->per_page );
        return view('partials.group-info-popup_video')
            ->with(compact('videos','paginationData'));
    }

    public function location($id)
    {
//        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
//        $ret = $this->contentService->getAvailableVideosOnMap($id, $user_id);
//        $locations = response()->json($ret, 200);

        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $uploaded_list = $this->userRepository->getAvailableContents($id);


        $locations = $this->getSearchListInJson($uploaded_list);
        $location_id = $id;
        return view('user.home2')
            ->with(compact('locations','location_id'));
    }

    public function videoProfile($id)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $info = $this->contentService->getContentData($id,$user_id);//dd($info);
        return view('partials.video-info')
            ->with(compact('info'));
    }

    public function searchVideosList(Request $request)
    {
        $r = $request->all();//only_group
        $filter['category'] = isset($r['category'])?$r['category']: array();
        $filter['keyword'] = isset($r['q'])?$r['q']: array();
        $filter['gcs'] = isset($r['gcs'])?$r['gcs']: array();//great community service

        $filter['only_my_group'] = isset($r['only_my_group'])?$r['only_my_group']: null;

        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;

        $uploaded_list = $this->contentService->getSearchableContents($user_id, $filter);

        $r = array(); $i = 0;
        foreach($uploaded_list as $val){
            $r[$i]['text'] = $val['title'];
            $r[$i]['id'] = $val['id'];
            $i++;
        }

        return response()->json(array('total_count' => count($r), 'incomplete_results' => false, 'results' => $r), 200);
    }

    public function searchUsersList(Request $request)
    {
        $r = $request->all();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $filter['keyword'] = isset($r['q'])?$r['q']: array();
        $users_list = $this->userRepository->getUsersList($user_id, $filter);

        $r = array(); $i = 0;
        foreach($users_list as $val){
            $r[$i]['text'] = '@'.$val['display_name'];
            $r[$i]['id'] = $val['id'];
            $i++;
        }

        return response()->json(array('total_count' => count($r), 'incomplete_results' => false, 'results' => $r), 200);
    }

    public function searchUsersListByGroups($groups, Request $request)
    {
        $r = $request->all();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $filter['keyword'] = isset($r['q']['term'])?$r['q']['term']: '';
        $filter['groups'] = is_array(explode(',', $groups))?explode(',', $groups): array();
        $users_list = $this->userRepository->getUsersList($user_id, $filter);

        $r = array(); $i = 0;
        foreach($users_list as $val){
            $r[$i]['text'] = '@'.$val['display_name'];
            $r[$i]['id'] = $val['id'];
            $i++;
        }

        return response()->json(array('total_count' => count($r), 'incomplete_results' => false, 'results' => $r), 200);
    }

    public function searchGroupList(Request $request)
    {
        $r = $request->all();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $filter['keyword'] = isset($r['q'])?$r['q']: array();
        $users_list = $this->userRepository->getGroupList($user_id, $filter);

        $r = array(); $i = 0;
        foreach($users_list as $val){
            $r[$i]['text'] = $val['name'];
            $r[$i]['id'] = $val['id'];
            $i++;
        }

        return response()->json(array('total_count' => count($r), 'incomplete_results' => false, 'results' => $r), 200);
    }

    public function searchPrimarySubjectTagList(Request $request)
    {
        $r = $request->all();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $filter['keyword'] = isset($r['q'])?$r['q']: '';
        $list = $this->contentService->searchPrimarySubjectTag($user_id, $filter);

        $r = array(); $i = 0;
        foreach($list as $val){
            $r[$i]['text'] = $val['tag'];
            $r[$i]['id'] = $val['tag'];
            $i++;
        }

        return response()->json(array('total_count' => count($r), 'incomplete_results' => false, 'results' => $r), 200);
    }

    public function showCurrentLocationVideos(Request $request)
    {
        $r = $request->all();
        $result_count = 0;
        $filter['category'] = isset($r['category'])?$r['category']: array();
        $filter['keyword'] = isset($r['keyword'])?$r['keyword']: array();
        $filter['gcs'] = isset($r['gcs'])?$r['gcs']: array();//great community service
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;

        $filter['category_id'] = isset($_GET['category_id'])?($_GET['category_id']):'';
        $filter['keyword'] = isset($_GET['keyword'])?($_GET['keyword']):'';
        $filter['gcs'] = isset($_GET['gcs'])?($_GET['gcs']):'';
        $filter['video_id'] = isset($_GET['video_id'])?($_GET['video_id']):'';
        $ids=isset($_GET['ids'])?($_GET['ids']):'';
        $array=explode(',',$ids);
        $new_ids_array=array_filter($array);
        $filter['ids'] = $new_ids_array;

        $uploaded_list = $this->userRepository->getCurrentContents($user_id, $filter, $result_count);
        $json_output = $this->getSearchListInJson($uploaded_list);
        $content = view('partials.video-search-result')
            ->with(compact('uploaded_list','result_count'));
        $content = (string)htmlspecialchars($content);
        return array('content' => $content, 'json' => $json_output);
        return array('json' => $json_output);
    }
    public function searchVideos(Request $request)
    {
        $r = $request->all();
        $result_count = 0;
        $filter['category'] = isset($r['category'])?$r['category']: array();
        $filter['keyword'] = isset($r['keyword'])?$r['keyword']: array();
        $filter['gcs'] = isset($r['gcs'])?$r['gcs']: array();//great community service
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;

        $filter['category_id'] = isset($_GET['category_id'])?($_GET['category_id']):'';
        $filter['keyword'] = isset($_GET['keyword'])?($_GET['keyword']):'';
        $filter['gcs'] = isset($_GET['gcs'])?($_GET['gcs']):'';
        $filter['video_id'] = isset($_GET['video_id'])?($_GET['video_id']):'';

        $filter['text'] = isset($_GET['text'])?($_GET['text']):'';
        $filter['date_from'] = isset($_GET['date_from'])?($_GET['date_from']):'';
        $filter['date_to'] = isset($_GET['date_to'])?($_GET['date_to']):'';
        $filter['location_text'] = isset($_GET['location_text'])?($_GET['location_text']):'';
        $filter['sorting_tag'] = isset($_GET['sorting_tag'])?($_GET['sorting_tag']):'';
        $filter['service_or_opportunity'] = isset($_GET['exchange_for'])?($_GET['exchange_for']):'';
        $filter['group_id'] = isset($_GET['group_id'])?($_GET['group_id']):'';
        $filter['multi_search'] = isset($_GET['multi_search'])?($_GET['multi_search']):'';
        $filter['sorting'] = isset($_GET['sorting'])?($_GET['sorting']):'';

        $uploaded_list = $this->userRepository->getPublicContents($user_id, $filter, $result_count);
        $json_output = $this->getSearchListInJson($uploaded_list);
        $content = view('partials.video-search-result')
            ->with(compact('uploaded_list','result_count'));
        $content = (string)htmlspecialchars($content);
        return array('content' => $content, 'json' => $json_output);
        return array('json' => $json_output);
    }

    public function getSearchListInJson($uploaded_list)
    {
        $ret = array(); $i = 0;
        foreach($uploaded_list as $u){
            if(empty($u['lat']) || empty($u['long']))
                continue;

            $ret[$i]['id'] = $u['id'];
            $ret[$i]['lng'] = floatval($u['long']);
            $ret[$i]['lat'] = floatval($u['lat']);
            $ret[$i]['name'] = $u['title'];
//            $ret[$i]['city'] = $u['city'];
            $i++;
        }

        return response()->json($ret, 200);
    }

    public function sharedGroup($_token, Request $request)
    {
        $filters_list = $this->contentService->getSharedMapFiltersListByToken($_token);
        $basic_info = $this->contentService->getSharedMapBasicInfo($_token);
        $filters_group_list = $this->contentService->getSharedMapFiltersListByToken($_token, 'groups');
        $filters_contents_list = $this->contentService->getSharedMapFiltersListByToken($_token, 'contents');

        $reffer_url = $request->headers->get('referer');
        $reffer_parse_url = parse_url($reffer_url);

        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        if($user_id == 0 && !empty($basic_info['allowed_domain'])){
            $allow_url = parse_url($basic_info['allowed_domain']);
            if(isset($reffer_parse_url['host'])){
                if($reffer_parse_url['host'] != $allow_url['host']){
                    die('Abort: Unauthorized domain.');
                }
            }else{
                die('Abort: Unauthorized.');
            }
        }



        $within_groups = [];
        foreach($filters_group_list as $group){
            $within_groups[] = $group['fk_id'];
        }

        //adding additional contents
        $other_contents = array_column($filters_contents_list, 'fk_id');//manually selected content ids

        $content_ids = $this->contentService->getContentIdsByFilter( array('groups' => $within_groups))->toArray();
        $content_ids = array_column($content_ids,'id');
        $content_ids = array_merge($content_ids, $other_contents);

        $search_elements = '';
        foreach($filters_list as $filter){
            switch($filter['fk_id']){
                case 1:
                    //Category
                    $type = 'category';
                    $categories = $this->contentService->getCategories(array('contents' => $content_ids));
                    $search_elements .= view('partials.search-element')
                        ->with(compact('type','categories'));
                    break;
                case 2:
                    //Greater Community Intention
                    $type = 'gci_tags';
                    $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag(array('contents' => $content_ids));
                    $search_elements .= view('partials.search-element')
                        ->with(compact('type','gci_tags'));
                    break;
                case 3:
                    //Primary Subject Tag
                    $type = 'primary_sub_tag';
                    $search_elements .= view('partials.search-element')
                        ->with(compact('type'));
                    break;
                case 4:
                    //Associated Users
                    $type = 'users';
                    $filters_users_list = $this->contentService->getSharedMapFiltersListByToken($_token, 'users');
                    $within_users = [];
                    foreach($filters_users_list as $user){
                        $within_users[] = $user['fk_id'];
                    }
                    $sub_filter['groups'] = $within_groups;
                    $sub_filter['ids'] = $within_users;
                    $users_list = $this->userRepository->getUsersList(0, $sub_filter);
                    $i = 0; $users = [];
                    foreach($users_list as $val){
                        $users[$i]['text'] = '@'.$val['display_name'];
                        $users[$i]['id'] = $val['id'];
                        $i++;
                    }
                    $search_elements .= view('partials.search-element')
                        ->with(compact('type', 'users'));
                    break;
                case 5:
                    //Service/Opportunity
//                    $s_o_p = $this->userRepository->getSortingTags(0, true);
                    $type = 's_o_p';
                    $s_o_p[0]['id'] = '2';
                    $s_o_p[0]['tag'] = 'Service';
                    $s_o_p[1]['id'] = '1';
                    $s_o_p[1]['tag'] = 'Opportunity';
                    $search_elements .= view('partials.search-element')
                        ->with(compact('type','s_o_p'));
                    break;
            }
        }

        if(!empty($search_elements)){
            $type = 'search_buttons';
            $search_elements .= view('partials.search-element')
                ->with(compact('type'));
        }

        return view('partials.shared_content')
            ->with(compact('_token', 'search_elements', 'filters_list','basic_info','within_groups'));
    }

    public function shearedContentJson($_token,Request $request)
    {
        $filter = array();
        $filters_group_list = $this->contentService->getSharedMapFiltersListByToken($_token, 'groups');
        $filters_contents_list = $this->contentService->getSharedMapFiltersListByToken($_token, 'contents');
        //adding additional contents
        $other_contents = array_column($filters_contents_list, 'fk_id');//manually selected content ids

        $basic_info = $this->contentService->getSharedMapBasicInfo($_token);
        $within_groups = [];
        foreach($filters_group_list as $group){
            $within_groups[] = $group['fk_id'];
        }

        if(isset($basic_info['primary_subject_tag']) && !empty($basic_info['primary_subject_tag'])){
            $filter['primary_sub_tag'] = $basic_info['primary_subject_tag'];
        }else{
            $filter['primary_sub_tag'] = '';
        }

        $filter['other_ids'] = $other_contents;
        $filter['groups'] = $within_groups;
        $filter['category_id'] = isset($request['categories'])? $request['categories'] : '';
//        $filter['primary_sub_tag'] = isset($request['primary_sub_tag'])? $request['primary_sub_tag'] : '';
        $filter['service_or_opportunity'] = isset($request['s_o_p'])? $request['s_o_p'] : '';//same table with different relationship name
        $filter['gcs'] = isset($request['gci'])? $request['gci'] : '';
        $filter['associate_user_id'] = isset($request['user_id'])? $request['user_id'] : '';
        $uploaded_list = $this->contentService->generateMap($_token, 0,$filter);
        $json_output = $this->getSearchListInJson($uploaded_list);
        $content = view('partials.shared_video-search-result')
            ->with(compact('uploaded_list'));
        $content = (string)htmlspecialchars($content);
        return array('content' => $content, 'json' => $json_output);
    }

    public function searchDisplayNames(Request $request)
    {
        $r = $request->all();
        $data = $this->userRepository->ajaxSearchDisplayNames($r['q']['term']);
        echo json_encode($data);
    }

    public function contactUs()
    {
        return view('user.contact-us');
    }

    public function contactUsPost(Request $request)
    {
        $r = $request->toArray();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;

        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required',
                'g-recaptcha-response' => 'required|recaptcha'
            ],
            ['g-recaptcha-response.required' => 'Recaptcha must be clicked.']);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $to = [
            [
                'email' => env("ADMIN_MAIL"),
                'name' => env("ADMIN_NAME"),
            ]
        ];
        Mail::to($to)->send(new contactUs($request->all()));

        return redirect()->back()->with('message', 'Successfully Sent!');
    }

    public function getComments($fk_id, $table)
    {
        $comments = $this->comment->where('table', $table)->where('fk_id', $fk_id)->get();
    }
}
