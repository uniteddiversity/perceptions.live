<?php

namespace User\Services;

use App\User;
use Illuminate\Support\Facades\URL;

class UserRepository
{

    private $page_size = 20;
    /**
     * @var UserFollowing
     */
    private $userFollowing;

    public function __construct(User $user)
    {
        $this->user = $user;
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
//    public function getUsers($filter, $user_id)
//    {
//        $r = array();
//        $page = isset($filter['page'])? $filter['page']: 0;
//        $offset = ($page) * $this->page_size;
//        $list = isset($filter['list'])? $filter['list']: '';
//        switch($list){
//            case 'follower':
//                $ids = $this->userFollowing->select('follower_user_id')->where('following_user_id', $user_id)->where('allow', '1')->limit(300)->pluck('follower_user_id')->toArray();
//                break;
//            case 'following':
//                $ids = $this->userFollowing->select('following_user_id')->where('follower_user_id', $user_id)->where('allow', '1')->limit(300)->pluck('following_user_id')->toArray();
//                break;
//            case 'search':
//                $ids = $this->user;
//
//                if(isset($filter['name'])){
//                    $ids = $ids->where('name', 'LIKE', '%'.$filter['name'].'%');
//                }
//
//                $ids = $ids->where('private','<>', 1)
//                    ->where('id','<>', $user_id)
//                    ->offset($offset)
//                    ->limit($this->page_size)
//                    ->pluck('id')->toArray();
//                break;
//        }
//
//        $r = $this->getUsersById($ids);
//        return $r;
//    }
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
            if(empty($c['url'])){
                $r[$i]['video'] = $c['content'];
            }else{
                $r[$i]['video'] = $c['url'];
            }

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
            ->select('contents.id', 'contents.content', 'contents.lat', 'contents.long', 'contents.name', 'contents.url')->groupBy('contents.id')->get();
        $r = array(); $i = 0;
        foreach($contents as $c){
            $r[$i] = $c;
            if(empty($c['url'])){
                $r[$i]['video'] = $c['content'];
            }else{
                $r[$i]['video'] = $c['url'];
            }

            $i++;
        }

        return $r;
    }
}

