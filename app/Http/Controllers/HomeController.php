<?php

namespace App\Controllers;

use App\Content;
use App\Http\Controllers\Controller;
use App\User;
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

    public function __construct(Content $content, User $user, UserRepository $userRepository)
    {
        $this->content = $content;
        $this->user = $user;
        $this->userRepository = $userRepository;
    }

    public function home()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $uploaded_list = $this->userRepository->getPublicContents($user_id);
        return view('user.home')
            ->with(compact('uploaded_list'));
    }

    public function ajaxVideos()
    {
        $user_id = (!isset(Auth::user()->id))? 0 : Auth::user()->id;
        $uploaded_list = $this->userRepository->getPublicContents($user_id);
        $uploaded_list_json = '{
"type": "FeatureCollection",
                                                                                
"features": [
{ "type": "Feature", "id": 0, "properties": { "NAME": "45th Street Theater", "TEL": "(212) 352-3101", "URL": "http:\/\/www.theatermania.com\/new-york\/theaters\/45th-street-theatre_2278\/", "ADDRESS1": "354 West 45th Street", "ADDRES2": null, "CITY": "New York", "ZIP": 10036.0 }, "geometry": { "type": "Point", "coordinates": [ -73.990618, 40.759851 ] } }
,
{ "type": "Feature", "id": 1, "properties": { "NAME": "47th Street Theater", "TEL": "(800) 775-1617", "URL": "http:\/\/www.bestofoffbroadway.com\/theaters\/47streettheatre.html", "ADDRESS1": "304 West 47th Street", "ADDRES2": null, "CITY": "New York", "ZIP": 10036.0 }, "geometry": { "type": "Point", "coordinates": [ -73.988106, 40.760471 ] } }
,
{ "type": "Feature", "id": 115, "properties": { "NAME": "York Theatre", "TEL": "(212) 935-5820", "URL": "http:\/\/www.yorktheatre.org\/", "ADDRESS1": "619 Lexington Ave", "ADDRES2": null, "CITY": "New York", "ZIP": 10022.0 }, "geometry": { "type": "Point", "coordinates": [ -73.969979, 40.758357 ] } }
,
{ "type": "Feature", "id": 116, "properties": { "NAME": "Delacorte Theater", "TEL": "(212) 861-7277", "URL": "http:\/\/www.centralpark.com\/pages\/attractions\/delacorte-theatre.html", "ADDRESS1": "Central Park - Mid-Park at 80th Street", "ADDRES2": "SW corner of the Great Lawn", "CITY": "New York", "ZIP": 0.0 }, "geometry": { "type": "Point", "coordinates": [ -73.968825, 40.780176 ] } }

]
}
';
        $ret = array(); $i = 0;
        foreach($uploaded_list as $u){
            $ret[$i]['type'] = "Feature";
            $ret[$i]['id'] = $i;
//            $ret[$i]['type'] = array('properties' => array('name' => $u["name"]));
//            $ret[$i]['type'] = array('properties' => array('name' => $u["name"]));
            $ret[$i]['properties']['NAME'] = $u['name'];
            $ret[$i]['properties']['TEL'] = '';
            $ret[$i]['properties']['TEL'] = '';
            $ret[$i]["geometry"]['type'] = 'Point';
            $ret[$i]["geometry"]['coordinates'][0] = floatval($u['lat']);
            $ret[$i]["geometry"]['coordinates'][1] = floatval($u['long']);
            $i++;
        }
//        return $uploaded_list_json;
        return response()->json(array('type' => 'FeatureCollection', 'features' => $ret), 200);
    }

}
