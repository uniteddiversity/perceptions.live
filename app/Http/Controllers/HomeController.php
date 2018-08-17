<?php

namespace App\Controllers;

use App\Category;
use App\Content;
use App\Http\Controllers\Controller;
use App\User;
use Content\Services\ContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function __construct(Content $content, User $user, UserRepository $userRepository, ContentService $contentService,
                                Category $category)
    {
        $this->content = $content;
        $this->user = $user;
        $this->userRepository = $userRepository;
        $this->contentService = $contentService;
        $this->category = $category;
    }

    public function home()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $filter = array();
        $uploaded_list = $this->userRepository->getPublicContents($user_id, $filter);
        $user_acting_role = $this->userRepository->getUserActingRoles();

        $categories = $this->category->get();
        return view('user.home')
            ->with(compact('uploaded_list','user_acting_role','categories'));
    }

    public function ajaxVideos($id = 0)
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $uploaded_list = $this->userRepository->getPublicContents($user_id);
//        $uploaded_list_json = '{
//"type": "FeatureCollection",
//
//"features": [
//{ "type": "Feature", "id": 0, "properties": { "NAME": "45th Street Theater", "TEL": "(212) 352-3101", "URL": "http:\/\/www.theatermania.com\/new-york\/theaters\/45th-street-theatre_2278\/", "ADDRESS1": "354 West 45th Street", "ADDRES2": null, "CITY": "New York", "ZIP": 10036.0 }, "geometry": { "type": "Point", "coordinates": [ -73.990618, 40.759851 ] } }
//,
//{ "type": "Feature", "id": 1, "properties": { "NAME": "47th Street Theater", "TEL": "(800) 775-1617", "URL": "http:\/\/www.bestofoffbroadway.com\/theaters\/47streettheatre.html", "ADDRESS1": "304 West 47th Street", "ADDRES2": null, "CITY": "New York", "ZIP": 10036.0 }, "geometry": { "type": "Point", "coordinates": [ -73.988106, 40.760471 ] } }
//,
//{ "type": "Feature", "id": 115, "properties": { "NAME": "York Theatre", "TEL": "(212) 935-5820", "URL": "http:\/\/www.yorktheatre.org\/", "ADDRESS1": "619 Lexington Ave", "ADDRES2": null, "CITY": "New York", "ZIP": 10022.0 }, "geometry": { "type": "Point", "coordinates": [ -73.969979, 40.758357 ] } }
//,
//{ "type": "Feature", "id": 116, "properties": { "NAME": "Delacorte Theater", "TEL": "(212) 861-7277", "URL": "http:\/\/www.centralpark.com\/pages\/attractions\/delacorte-theatre.html", "ADDRESS1": "Central Park - Mid-Park at 80th Street", "ADDRES2": "SW corner of the Great Lawn", "CITY": "New York", "ZIP": 0.0 }, "geometry": { "type": "Point", "coordinates": [ -73.968825, 40.780176 ] } }
//
//]
//}
//';
//        $ret = array(); $i = 0;
//        foreach($uploaded_list as $u){
//            $ret[$i]['id'] = $u['id'];
//            $ret[$i]['lng'] = floatval($u['long']);
//            $ret[$i]['lat'] = floatval($u['lat']);
//            $ret[$i]['name'] = $u['title'];
////            $ret[$i]['city'] = $u['city'];
//            $i++;
//        }
////        return $uploaded_list_json;
////        return response()->json(array('type' => 'FeatureCollection', 'features' => $ret), 200);
//        return response()->json($ret, 200);
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

    public function location($id)
    {
//        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
//        $ret = $this->contentService->getAvailableVideosOnMap($id, $user_id);
//        $locations = response()->json($ret, 200);

        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $uploaded_list = $this->userRepository->getAvailableContents($id);


        $locations = $this->getSearchListInJson($uploaded_list);
//        $ret = array(); $i = 0;
//        foreach($uploaded_list as $u){
//            $ret[$i]['id'] = $u['id'];
//            $ret[$i]['lng'] = floatval($u['long']);
//            $ret[$i]['lat'] = floatval($u['lat']);
//            $ret[$i]['name'] = $u['title'];
////            $ret[$i]['city'] = $u['city'];
//            $i++;
//        }
//        $locations = response()->json($ret, 200);
//


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

    public function searchVideos(Request $request)
    {
        $r = $request->all();
        $filter['category'] = isset($r['category'])?$r['category']: array();
        $filter['keyword'] = isset($r['keyword'])?$r['keyword']: array();
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;

        $filter['category_id'] = isset($_GET['category_id'])?($_GET['category_id']):'';
        $filter['keyword'] = isset($_GET['keyword'])?($_GET['keyword']):'';
        $uploaded_list = $this->userRepository->getPublicContents($user_id, $filter);
        $json_output = $this->getSearchListInJson($uploaded_list);
        $content = view('partials.video-search-result')
            ->with(compact('uploaded_list'));
        $content = (string)htmlspecialchars($content);
        return array('content' => $content, 'json' => $json_output);
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

}
