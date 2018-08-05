<?php

namespace User\Services;

use App\Content;
use App\User;
use Content\Services\ContentService;
use Illuminate\Support\Facades\URL;

class UserRepository
{

    private $page_size = 20;
    /**
     * @var UserFollowing
     */
    private $userFollowing;
    /**
     * @var Content
     */
    private $content;

    public function __construct(User $user, Content $content)
    {
        $this->user = $user;
        $this->content = $content;
    }

//    public function getUserInfo($id){
//        $url = URL::to("/");
//        $user_info = $this->user->where('id', $id)->get()->first();
//        $user['id'] = $user_info['id'];
//        $user['username'] = $user_info['username'];
//        $user['email'] = $user_info['email'];
//        $user['first_name'] = empty($user_info['first_name'])?'': $user_info['first_name'];
//        $user['last_name'] = empty($user_info['last_name'])?'': $user_info['last_name'];
////        $user['is_onboard_complete'] = ($user_info['is_onboard_complete'] == '1')? 1 : 0;
////        $user['getaway'] = !empty($user_info['current_getaway'])? $user_info['current_getaway'] : 0;
////        $user['image_url'] = isset($user_info->images[0])? $url.'/storage/'.$user_info->images[0]->url : '';
//
//        return $user;
//    }
//
    public function getUsers($filter = array(), $user_id = null)
    {
        $r = $this->user->with('role')->get();
        return $r;
    }
//
//    public function searchUsers($filter, $user_id)
//    {
//        return $this->user->where('user', $filter['user'])->get();
//    }
//
//    public function getUsersById($ids)
//    {
//        $r = array();
//        $users = $this->user->whereIn('id', $ids)->get()->toArray();
//        $i = 0;
//        foreach($users as $user)
//        {
//            $r[$i]['id'] = $user['id'];
//            $r[$i]['email'] = $user['email'];
//            $r[$i]['username'] = empty($user['username'])? '' : $user['username'];
//            $r[$i]['private'] = $user['private'];
//            $r[$i]['created_at'] = empty($user['created_at'])? '' : date('Y-m-d H:i:s', strtotime($user['created_at']));
//            $r[$i]['updated_at'] = empty($user['updated_at'])? '' : date('Y-m-d H:i:s', strtotime($user['updated_at']));
//
//            $r[$i]['birthday'] = empty($user['birthday'])? '' : date('Y-m-d', strtotime($user['birthday']));
//            $r[$i]['sex'] = ($user['sex'] === '')? '' : $this->user->getSexByVal($user['sex']);
//            $r[$i]['phone'] = empty($user['phone'])? '' : $user['phone'];
//            $r[$i]['bio'] = empty($user['bio'])? '' : $user['bio'];
//            $r[$i]['profile_path'] = empty($user['profile_path'])? '' : url('/').'/storage/uploads/profile_photos/'.$user['profile_path'];
//            $r[$i]['cover_path'] = empty($user['cover_path'])? '' : url('/').'/storage/uploads/covers/'.$user['cover_path'];
//            $i++;
//        }
//        return $r;
//    }

    public function getMyContents($user_id)
    {
        $contents = $this->user->with('content')->whereIn('users.id', array($user_id))
            ->get()->first();
        $r = array(); $i = 0;
        foreach($contents->content as $c){
            $r[$i] = $c;
//            if(empty($c['url'])){
//                $r[$i]['video'] = $c['description'];
//            }else{
//                $r[$i]['video'] = $c['url'];
//            }
            $r[$i]['video'] = $c['url'];

            $i++;
        }

        return $r;
    }

    public function getPublicContents($user_id)
    {
        $contents = $this->user->leftJoin('contents', 'contents.user_id', 'users.id')->where(function($q) use ($user_id){
            $q->where(function($r) use ($user_id){
                $r->whereIn('users.id', array($user_id))->orWhere('contents.access_level_id', '1');
            });
        })->where('contents.is_deleted', '<>', 1)
            ->select('contents.id', 'contents.description', 'contents.lat', 'contents.long', 'contents.title', 'contents.url')->groupBy('contents.id')->get();
        $r = array(); $i = 0;
        foreach($contents as $c){
            $r[$i] = $c;
//            if(empty($c['url'])){
//                $r[$i]['video'] = $c['content'];
//            }else{
//                $r[$i]['video'] = $c['url'];
//            }
            $r[$i]['video'] = $c['url'];

            $i++;
        }

        return $r;
    }

    public function getContentsInfo($user_id, $id)
    {
        $contents = $this->content->with('user')
            ->where('contents.id',$id)
                ->where('contents.is_deleted', '<>', 1)
                ->leftJoin('users', 'contents.user_id', 'users.id')->where(function($q) use ($user_id){
            $q->where(function($r) use ($user_id){
                $r->whereIn('users.id', array($user_id))->orWhere('contents.access_level_id', '1');
            });
        })
            ->select('contents.*', 'users.first_name', 'users.last_name')
            ->get();

        $contents = isset($contents[0])?$contents[0] : array();
        return $contents;
    }
}

