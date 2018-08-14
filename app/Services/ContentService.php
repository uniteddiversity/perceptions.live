<?php

namespace Content\Services;

use App\Content;
use App\MetaData;

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

    public function __construct(MetaData $metaData, Content $content)
    {
        $this->metaData = $metaData;
        $this->content = $content;
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
        $videos = $this->content->with('user')->orderBy('updated_at','DESC')->get();

        return $videos;
    }

    public function getContentData($id)
    {
        $content = $this->content->with('coCreators','onScreen','videoProducer','groups','sortingTags','gciTags');
        $content = $content->where('id', $id);
        $content->select('contents.*');
        return $content->first()->toArray();
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