<?php

namespace Content\Services;

use App\Content;
use App\MetaData;
use App\User;

class ContentService
{

    private $page_size = 20;
    /**
     * @var UserFollowing
     */
    private $userFollowing;
    /**
     * @var MetaData
     */
    private $metaData;
    /**
     * @var Content
     */
    private $content;
    /**
     * @var User
     */
    private $user;

    public function __construct(MetaData $metaData, Content $content, User $user)
    {
        $this->metaData = $metaData;
        $this->content = $content;
        $this->user = $user;
    }

    public function getMetaListByKey($key = '')
    {
        $meta_array = array();
        if(empty($key)){
            $meta_data = $this->metaData->get();
            $meta_array = array();

            $i = 0;
            foreach($meta_data as $info)
            {
                $meta_array[$info['type']][$i]['id'] = $info['id'];
                $meta_array[$info['type']][$i]['type'] = $info['type'];
                $meta_array[$info['type']][$i]['value'] = $info['value'];
                $i++;
            }
        }

        return $meta_array;
    }

    public function getContentList($user_id)
    {
        $user_info = $this->getUser($user_id);

        $videos = $this->content->with('user');
        if($user_info['role_id'] <> '1' && $user_info['role_id'] <= 110){// not for admin, but for group admins and moderators
            //group admin get all the content related to all group members(who is the uploader) or group
            $videos->leftJoin('group_content_associations', 'group_content_associations.content_id','contents.id');
            $videos->leftJoin('user_groups', 'user_groups.group_id','group_content_associations.group_id');

            $videos->leftJoin('user_groups as created_by_user_groups', 'created_by_user_groups.group_id','group_content_associations.group_id');

//            $videos->leftJoin('user_groups', 'user_groups.group_id','group_content_associations.group_id');
            $videos->where('user_groups.user_id', $user_id);
        }elseif ($user_info['role_id'] == 1){// if super admin, no filter, show everything

        }else{//if user
            $videos->where('user_id', $user_info['id']);
        }

        $videos = $videos->select('contents.*');
        $videos = $videos->groupBy('contents.id')->orderBy('updated_at','DESC')->get();
//        dd($videos);
        return $videos;
    }

    public function getContentData($id)
    {
        $content = $this->content->with('coCreators','onScreen','videoProducer','groups','sortingTags','gciTags','exchange');
        $content = $content->where('id', $id);
        $content->select('contents.*');
        return $content->first()->toArray();
    }

    public function getUser($user_id)
    {
        return $this->user->where('users.id', $user_id)->with('image','groups','actingRoles')
            ->leftJoin('user_groups', 'users.id', 'user_groups.user_id')
            ->select('users.*', 'user_groups.group_id', 'user_groups.role_id as group_role_id')
            ->first();
    }

    public function getAvailableVideosOnMap($id,$user_id)
    {
//        $uploaded_list = $this->userRepository->getPublicContents($user_id);
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
    }
}