<?php

namespace Content\Services;

use App\Content;
use App\MetaData;
use App\ShearedContent;
use App\ShearedContentAssociation;
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

    public function __construct(MetaData $metaData, Content $content, User $user, ShearedContent $shearedContent, ShearedContentAssociation $shearedContentAssociation)
    {
        $this->metaData = $metaData;
        $this->content = $content;
        $this->user = $user;
        $this->shearedContent = $shearedContent;
        $this->shearedContentAssociation = $shearedContentAssociation;
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

    public function getContentList($user_id, $filter = array())
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

        if(isset($filter['open_list'])){
            $videos = $videos->where('status','<>', '1');
        }

        if(isset($filter['ids'])){
            $videos = $videos->whereIn('contents.id', $filter['ids']);
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

    public function getSearchableContents($user_id, $filter = array(), $limit = 10)
    {
        $user_info = $this->getUser($user_id);

        $contents = $this->user
            ->leftJoin('contents', 'contents.user_id', 'users.id')
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

        if(isset($filter['category_id']) && !empty($filter['category_id'])){
            $contents = $contents->where('category_id', $filter['category_id']);
        }

        if(isset($filter['only_my_group'])){
            $contents = $contents->where('group_content_associations.group_id','=', $user_info['group_id']);
        }

        if(isset($filter['ids'])){
            $contents = $contents->whereIn('contents.id', $filter['ids']);
        }

        $contents = $contents->select('contents.id', 'contents.description', 'contents.lat', 'contents.long', 'contents.title', 'contents.url',
            'users.display_name','contents.created_at','contents.location','contents.user_id',
            DB::Raw("GROUP_CONCAT(DISTINCT (concat(sorting_tags.tag_color,'-',sorting_tags.id,'-',sorting_tags.tag)) SEPARATOR ', ') as tag_colors") )
            ->groupBy('contents.id')->orderBy('contents.updated_at', 'DESC')->limit($limit)->get();
        $r = array(); $i = 0;

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


    public function generateMap($token, $user_id = 0)
    {
        $map = $this->shearedContent->with(['user'])
            ->leftJoin('shared_contents_associations as association', 'association.shared_content_id', 'shared_contents.id')
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
            ->select(
                'shared_contents.id',
                DB::Raw("GROUP_CONCAT(DISTINCT content_category.id SEPARATOR ',') as contents_category_ids"),
                DB::Raw("GROUP_CONCAT(DISTINCT users_contents.content_id SEPARATOR ',') as user_contents_ids"),
                DB::Raw("GROUP_CONCAT(DISTINCT contents_d.fk_id SEPARATOR ',') as contents_ids")
                //,DB::Raw("concat(contents_category_ids,',',user_contents_ids,',',contents_ids) as all_videos")
                )
            ->where('shared_contents.public_token', $token)->groupBy('shared_contents.id')->get()->first();

        $ids = array();

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

        //get contents from id
        $locations = $this->getSearchableContents($user_id, array('ids' => $ids), 300);
        return $locations;
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
}