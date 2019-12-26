<?php

namespace Content\Services;

use App\Attachment;
use App\Category;
use App\Content;
use App\Group;
use App\HomeSliderFeed;
use App\Language;
use App\MetaData;
use App\ShearedContent;
use App\ShearedContentAssociation;
use App\SortingTag;
use App\User;
use Illuminate\Support\Facades\DB;

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
    /**
     * @var ShearedContent
     */
    private $shearedContent;
    /**
     * @var ShearedContentAssociation
     */
    private $shearedContentAssociation;
    /**
     * @var Attachment
     */
    private $attachment;
    /**
     * @var Category
     */
    private $category;
    /**
     * @var Group
     */
    private $group;
    /**
     * @var SortingTag
     */
    private $sortingTag;
    /**
     * @var HomeSliderFeed
     */
    private $homeSliderFeed;
    /**
     * @var Language
     */
    private $language;

    public function __construct(MetaData $metaData, Content $content, User $user, ShearedContent $shearedContent,
                                ShearedContentAssociation $shearedContentAssociation, Attachment $attachment,
                                Category $category, Group $group, SortingTag $sortingTag, HomeSliderFeed $homeSliderFeed, Language $language)
    {
        $this->metaData = $metaData;
        $this->content = $content;
        $this->user = $user;
        $this->shearedContent = $shearedContent;
        $this->shearedContentAssociation = $shearedContentAssociation;
        $this->attachment = $attachment;
        $this->category = $category;
        $this->group = $group;
        $this->sortingTag = $sortingTag;
        $this->homeSliderFeed = $homeSliderFeed;
        $this->language = $language;
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

    public function getContentList($user_id, $filter = array(), $page = null, $page_size = 20, $only_my = false)
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
            $videos->leftJoin('group_content_associations', 'group_content_associations.content_id','contents.id');
            $videos->leftJoin('user_groups', 'user_groups.group_id','group_content_associations.group_id');

            $videos->leftJoin('user_groups as created_by_user_groups', 'created_by_user_groups.group_id','group_content_associations.group_id');
        }else{//if user
            $videos->where('user_id', $user_info['id']);
        }

        if($only_my){
            $videos->where('contents.user_id', $user_info['id']);
        }

        if(isset($filter['open_list'])){
            $videos = $videos->where('status','<>', '1');
        }

        if(isset($filter['ids'])){
            $videos = $videos->whereIn('contents.id', $filter['ids']);
        }

        if(isset($filter['group_id'])){
            $videos = $videos->where('user_groups.group_id',$filter['group_id']);
        }

        $videos = $videos->select('contents.*');

        if($page != null){
            return $videos->groupBy('contents.id')->orderBy('updated_at','DESC')->paginate($page_size, ['*'], 'page', $page);
        }
        $videos = $videos->groupBy('contents.id')->orderBy('updated_at','DESC')->get();
//        dd($videos);
        return $videos;
    }

    public function getContentData($id)
    {
        $content = $this->content->with(['coCreators','onScreen','videoProducer','groups','sortingTags','gciTags' => function($q){
            $q->with('tag');
        },'exchange']);
        $content = $content->where('id', $id);
        $content->select('contents.*');
        return $content->first()->toArray();
    }

    public function getContentDataMinimum($id)
    {
        $content = $this->content;
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

    public function getSearchableContents($user_id, $filter = array(), $limit = 10, &$contents = '', $per_page = null)
    {
        $user_info = $this->getUser($user_id);

        $contents = $this->content->with(['videoProducer' => function($q){
            $q->with('user');
        }])
            ->leftJoin('users', 'contents.user_id', 'users.id')
            ->leftJoin('tag_content_associations', function($q){
                $q->on( 'contents.id', 'tag_content_associations.content_id');
                $q->where( 'tag_content_associations.tag_for', 'gci');
            })->leftJoin('tag_content_associations as search_tag', function($q){
                $q->on( 'contents.id', 'search_tag.content_id');
                $q->where( 'search_tag.tag_for', 'gci');
            })
            ->leftJoin('sorting_tags', function($q){
                $q->on('sorting_tags.id', 'tag_content_associations.content_tag_id');
            })
            ->leftJoin('group_content_associations', 'group_content_associations.content_id','contents.id')
            ->leftJoin('user_content_associations', 'user_content_associations.content_id','contents.id')
            ->where('contents.status', '=', 1);

        if(isset($filter['keyword']) && !empty($filter['keyword'])){
            $contents = $contents->where(function($q) use($filter){
                $q->where('title', 'like', '%'.$filter['keyword'].'%');
                $q->orWhere('brief_description', 'like', '%'.$filter['keyword'].'%');
                $q->orWhere('primary_subject_tag', 'like', '%'.$filter['keyword'].'%');
            });
        }

        if(isset($filter['gcs']) && !empty($filter['gcs'])){
            $contents = $contents->where('search_tag.content_tag_id', $filter['gcs']);
        }

        //service_or_opportunity
        if(isset($filter['service_or_opportunity']) && !empty($filter['service_or_opportunity'])){
            $contents = $contents->where('search_tag.content_tag_id', $filter['service_or_opportunity']);
        }

        if(isset($filter['category_id']) && !empty($filter['category_id'])){
            $contents = $contents->where('category_id', $filter['category_id']);
        }

        if(isset($filter['associate_user_id']) && !empty($filter['associate_user_id'])){
            $contents = $contents->where('user_content_associations.user_id', $filter['associate_user_id']);
        }

        if(isset($filter['primary_sub_tag']) && !empty($filter['primary_sub_tag'])){
            $contents = $contents->where('contents.primary_subject_tag', $filter['primary_sub_tag']);
        }

        if(isset($filter['only_my_group'])){
            $contents = $contents->where('group_content_associations.group_id','=', $user_info['group_id']);
        }

        if(isset($filter['ids'])){
            $contents = $contents->whereIn('contents.id', $filter['ids']);
        }

        if(isset($filter['group_id'])){
            $contents = $contents->where('group_content_associations.group_id', $filter['group_id']);
        }

        $contents = $contents->select('contents.id', 'contents.description', 'contents.lat', 'contents.long', 'contents.title', 'contents.url',
            'users.display_name','contents.created_at','contents.location','contents.user_id','contents.primary_subject_tag',
            DB::Raw("GROUP_CONCAT(DISTINCT (concat(sorting_tags.tag_color,'-',sorting_tags.id,'-',sorting_tags.tag)) SEPARATOR ', ') as tag_colors") )
            ->groupBy('contents.id')->orderBy('contents.updated_at', 'DESC');
        $r = array(); $i = 0;

        if($per_page != null){
            $contents = $contents->paginate($per_page);
        }else{
            $contents = $contents->limit($limit)->get();
        }

        foreach($contents as $c){
            $r[$i] = $c;
            $r[$i]['video'] = $c['url'];
            $i++;
        }

        return $r;
    }

    public function createGroupShareableContents($user_id, $data, $id = 0)
    {
        //, 'group', 'allowed_domain', 'allowed_ip', 'created_by', 'primary_subject_tag'
        $groupShare = $this->shearedContent->updateOrCreate(
            [
                'id' => $id,
            ],
            $data['basic']
        );

        if(isset($groupShare->id)){
            $this->shearedContentAssociation->where('shared_content_id', $groupShare->id)->delete();
            foreach($data['associations']['grater_community_intention_ids'] as $id){
                $this->shearedContentAssociation->create(array('shared_content_id' => $groupShare->id,
                    'table' => 'sorting_tags', 'fk_id' => $id, 'slug' => 'gcs', 'type' => 'group'));
            }

            foreach($data['associations']['public_videos'] as $id){
                $this->shearedContentAssociation->create(array('shared_content_id' => $groupShare->id,
                    'table' => 'contents', 'fk_id' => $id, 'slug' => '', 'type' => 'group'));
            }

            foreach($data['associations']['associated_users'] as $id){
                $this->shearedContentAssociation->create(array('shared_content_id' => $groupShare->id,
                    'table' => 'users', 'fk_id' => $id, 'slug' => '', 'type' => 'group'));
            }

            foreach($data['associations']['categories'] as $id){
                $this->shearedContentAssociation->create(array('shared_content_id' => $groupShare->id,
                    'table' => 'categories', 'fk_id' => $id, 'slug' => '', 'type' => 'group'));
            }

            foreach($data['associations']['groups'] as $id){
                $this->shearedContentAssociation->create(array('shared_content_id' => $groupShare->id,
                    'table' => 'groups', 'fk_id' => $id, 'slug' => '', 'type' => 'group'));
            }

            foreach($data['associations']['filter_list'] as $id){
                $this->shearedContentAssociation->create(array('shared_content_id' => $groupShare->id,
                    'table' => 'filter_list', 'fk_id' => $id, 'slug' => '', 'type' => 'group'));
            }
        }

        return $groupShare;
    }

    public function groupShareableContentsList($user_id)
    {
        $user_info = $this->getUser($user_id);

        return $this->shearedContent->with(['user' => function($q){
//            $q->with('user');
        }])
            ->where('created_by', $user_id)->orderBy('shared_contents.created_at', 'DESC')->get();
    }


    public function generateMap($token, $user_id = 0, $filter)
    {
        $map = $this->shearedContent->with(['user'])
            ->leftJoin('shared_contents_associations as association', 'association.shared_content_id', 'shared_contents.id')
            ->leftJoin('group_content_associations as groups', function($q){
                $q->on('groups.group_id', 'association.fk_id')
                    ->where('association.type', 'group')
                    ->where('association.table', 'groups');
            })
            ->leftJoin('tag_content_associations as gcs', function($q){
                $q->on('gcs.content_tag_id', 'association.fk_id')
                    ->where('association.type', 'group')
                    ->where('association.table', 'sorting_tags');
            })
            ->leftJoin('user_content_associations as users_contents', function($q){
                $q->on('users_contents.user_id', 'association.fk_id')
                    ->where('association.type', 'group')
                    ->where('association.table', 'users');
            })
            ->leftJoin('shared_contents_associations as contents_d', function($q){
                $q->on('association.id', 'contents_d.id')
                    ->where('association.type', 'group')
                    ->where('association.table', 'contents');
            })
            ->leftJoin('contents as content_category', function($q){
                $q->on('association.fk_id', 'content_category.category_id')
                    ->where('association.type', 'group')
                    ->where('association.table', 'categories');
            })
            ->leftJoin('contents as content', function($q){
                $q->on('content.primary_subject_tag', 'shared_contents.primary_subject_tag');
            })
            ->select(
                'shared_contents.id',
                DB::Raw("GROUP_CONCAT(DISTINCT groups.id SEPARATOR ',') as groups_content_ids"),
                DB::Raw("GROUP_CONCAT(DISTINCT content.id SEPARATOR ',') as contents_content_ids"),
                DB::Raw("GROUP_CONCAT(DISTINCT content_category.id SEPARATOR ',') as contents_category_ids"),
                DB::Raw("GROUP_CONCAT(DISTINCT users_contents.content_id SEPARATOR ',') as user_contents_ids"),
                DB::Raw("GROUP_CONCAT(DISTINCT contents_d.fk_id SEPARATOR ',') as contents_ids")
                //,DB::Raw("concat(contents_category_ids,',',user_contents_ids,',',contents_ids) as all_videos")
                );

        $map = $map->where('shared_contents.public_token', $token)->groupBy('shared_contents.id')->get()->first();

        $ids = array();

        if(isset($map['groups_content_ids'])){
            foreach(explode(',',$map['groups_content_ids']) as $id){
                $ids[$id] = $id;
            }
        }

        if(isset($map['contents_content_ids'])){
            foreach(explode(',',$map['contents_content_ids']) as $id){
                $ids[$id] = $id;
            }
        }

        if(isset($map['contents_category_ids'])){
            foreach(explode(',',$map['contents_category_ids']) as $id){
                $ids[$id] = $id;
            }
        }

        if(isset($map['user_contents_ids'])){
            foreach(explode(',',$map['user_contents_ids']) as $id){
                $ids[$id] = $id;
            }
        }

        if(isset($map['contents_ids'])){
            foreach(explode(',',$map['contents_ids']) as $id){
                $ids[$id] = $id;
            }
        }

        $filter = array_merge(array('ids' => $ids), $filter);
        //get contents from id
        $locations = $this->getSearchableContents($user_id, $filter, 300);
        return $locations;
    }

    public function getSharedMapFiltersListByToken($_token)
    {
        $filters = $this->shearedContent
            ->leftJoin('shared_contents_associations as association', 'association.shared_content_id', 'shared_contents.id')
            ->where('shared_contents.public_token', $_token)
            ->where('table', 'filter_list')->select('association.*')->get()->toArray();

        return $filters;
    }

    public function getSharedMapBasicInfo($_token)
    {
        $filters = $this->shearedContent
            ->where('shared_contents.public_token', $_token)
            ->select('shared_contents.*')->get()->first()->toArray();

        return $filters;
    }

    public function getGroupShareData($id)
    {
        $data = $this->shearedContent->with(['user'])
            ->leftJoin('shared_contents_associations as association',
                'association.shared_content_id',
                'shared_contents.id')
            ->select('shared_contents.*','association.table','association.fk_id','association.slug','association.type')
            ->where('shared_contents.id', $id)->get();

        return $data;
    }

    public function getGroupSearchFilterList()
    {
        $data[0]['id'] = '1';
        $data[0]['filter'] = 'Category';
        $data[1]['id'] = '2';
        $data[1]['filter'] = 'Greater Community Intention';
//        $data[2]['id'] = '3';
//        $data[2]['filter'] = 'Primary Subject Tag';
        $data[3]['id'] = '4';
        $data[3]['filter'] = 'Associated Users';
        $data[4]['id'] = '5';
        $data[4]['filter'] = 'Service/Opportunity';
        return $data;
    }

    public function searchPrimarySubjectTag($user_id, $filter)
    {
        $subject_tags = $this->content;

        if(isset($filter['keyword']))
            $subject_tags = $subject_tags->where('primary_subject_tag','LIKE', '%'.$filter['keyword'].'%');

        $subject_tags = $subject_tags->select('primary_subject_tag as tag')->groupBy('primary_subject_tag')->limit(10)->get();

        return $subject_tags;
    }

    public function getUploadedContent($id)
    {
        $uploaded_files = $this->attachment->whereIn('submission_type',array('video-s-1','video-s-2','video-s-3'))
            ->where('table','contents')->where('fk_id', $id)->get();
        return $uploaded_files;
    }

    public function ajaxSearchContentGroup($text, $types = [])
    {
        $content = [];
        $r = [];
//        if($type == ''){
            if(in_array('category', $types))
                $content['category'] = $this->category->where('name', 'like', '%'.$text.'%')->limit(10)->get()->toArray();
            if(in_array('group', $types))
                $content['group'] = $this->group->where('name', 'like', '%'.$text.'%')->limit(10)->get()->toArray();
            if(in_array('GCI', $types))
                $content['gci'] = $this->sortingTag->where('tag', 'like', '%'.$text.'%')->where('tag_for','gci')->limit(10)->get()->toArray();
//        }

        foreach($content as $type => $arrays){
            foreach($arrays as $value){
                $r[] = array(
                    'id' => $value['id'],
                    'text' => empty($value['tag'])?$value['name']:$value['tag'],
                    'type' => $type,
                );
            }
        }

        return $r;
    }

    public function listHomeSlider()
    {
        $slider = $this->homeSliderFeed->with('image')
            ->leftJoin('home_slider_feed_settings', 'home_slider_feed_settings.feed_id','home_slider_feeds.id')
            ->leftJoin('groups','groups.id', 'home_slider_feed_settings.fk_id', function($q){
                $q->where('home_slider_feed_settings.type', 'group');
            })
            ->leftJoin('categories','categories.id', 'home_slider_feed_settings.fk_id', function($q){
                $q->where('home_slider_feed_settings.type', 'category');
            })->leftJoin('sorting_tags','sorting_tags.id', 'home_slider_feed_settings.fk_id', function($q){
                $q->where('home_slider_feed_settings.type', 'gci');
            })
            ->select('home_slider_feeds.*', 'home_slider_feed_settings.type', 'home_slider_feed_settings.fk_id', 'groups.name', 'categories.name', 'categories.name', 'sorting_tags.tag')
            ->get()->toArray();

        $r = array();
        $i = 0;

        foreach($slider as $val){
            $i = $val['id'];
            $r[$i]['id'] = $val['id'];
            $r[$i]['side'] = $val['side'];
            $r[$i]['title'] = $val['title'];
            $r[$i]['fk_title'] = isset($val['name'])?$val['name'] : $val['tag'];
            $r[$i]['fk_id'][] = $val['fk_id'];
            $r[$i]['type'][] = $val['type'];
            $r[$i]['types'][$val['type']][] = $val['fk_id'];
            $items = [];
            foreach($r[$i]['types'] as $key => $v){
                $items[] = $key .'-'. implode(',', $v);
            }
//            $r[$i]['type_id'][] = $items;
            $r[$i]['type_ids'] = implode('|',$items);
            $r[$i]['icon'] = isset($val['image'][0]) && !empty($val['image'][0])? $val['image'][0]['url'] : 'default_icon.jpg';
//            $i++;
        }
//        dd($r);
        return $r;
    }

    public function deleteHomeSlider($id)
    {
        return $this->homeSliderFeed->where('id', $id)->delete();
    }

    public function getLanguages()
    {
        return $this->language->get();
    }
}