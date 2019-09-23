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

        return view('partials.video-info-popup')
            ->with(compact('info'));
    }

    public function getVideoInfoMini($video_id)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $info = $this->userRepository->getContentsInfo($user_id, $video_id);

        return view('partials.video-info-popup-small')
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

    public function sharedGroup($_token)
    {
        $filters_list = $this->contentService->getSharedMapFiltersListByToken($_token);
        $basic_info = $this->contentService->getSharedMapBasicInfo($_token);

        $search_elements = '';
        foreach($filters_list as $filter){
            switch($filter['fk_id']){
                case 1:
                    //Category
                    $type = 'category';
                    $categories = $this->category->get();
                    $search_elements .= view('partials.search-element')
                        ->with(compact('type','categories'));
                    break;
                case 2:
                    //Greater Community Intention
                    $type = 'gci_tags';
                    $gci_tags = $this->userRepository->getGreaterCommunityIntentionTag();
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
                    $search_elements .= view('partials.search-element')
                        ->with(compact('type'));
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
            ->with(compact('_token', 'search_elements', 'filters_list','basic_info'));
    }

    public function shearedContentJson($_token,Request $request)
    {
        $filter = array();
        $filter['category_id'] = isset($request['categories'])? $request['categories'] : '';
        $filter['primary_sub_tag'] = isset($request['primary_sub_tag'])? $request['primary_sub_tag'] : '';
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
}
