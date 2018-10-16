<?php

namespace User\Services;

use App\Attachment;
use App\ClaimProfileRequests;
use App\Content;
use App\ContentAccessLevels;
use App\Group;
use App\GroupContentAssociation;
use App\MetaData;
use App\Role;
use App\SortingTag;
use App\TagContentAssociation;
use App\TagGroupAssociation;
use App\TagUserAssociation;
use App\User;
use App\UserContentAssociation;
use App\UserGroup;
use App\UserSortingTag;
use App\UserStatus;
use Content\Services\ContentService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

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
    /**
     * @var UserGroup
     */
    private $userGroup;
    /**
     * @var Group
     */
    private $group;
    /**
     * @var Role
     */
    private $role;
    /**
     * @var UserContentAssociation
     */
    private $userContentAssociation;
    /**
     * @var Attachment
     */
    private $attachment;
    /**
     * @var SortingTag
     */
    private $sortingTag;
    /**
     * @var GroupContentAssociation
     */
    private $groupContentAssociation;
    /**
     * @var TagContentAssociation
     */
    private $tagContentAssociation;
    /**
     * @var TagUserAssociation
     */
    private $tagUserAssociation;
    /**
     * @var UserStatus
     */
    private $userStatus;
    /**
     * @var ContentAccessLevels
     */
    private $contentAccessLevels;
    /**
     * @var MetaData
     */
    private $metaData;
    /**
     * @var UserSortingTag
     */
    private $userSortingTag;
    /**
     * @var ClaimProfileRequests
     */
    private $claimProfileRequests;
    /**
     * @var TagGroupAssociation
     */
    private $tagGroupAssociation;

    public function __construct(User $user, Content $content,
                                UserGroup $userGroup, Group $group, Role $role, UserContentAssociation $userContentAssociation,
                                Attachment $attachment, SortingTag $sortingTag, GroupContentAssociation $groupContentAssociation,
                                TagContentAssociation $tagContentAssociation, TagUserAssociation $tagUserAssociation, UserStatus $userStatus,
                                ContentAccessLevels $contentAccessLevels, MetaData $metaData, UserSortingTag $userSortingTag, ClaimProfileRequests $claimProfileRequests,
                                TagGroupAssociation $tagGroupAssociation)
    {
        $this->user = $user;
        $this->content = $content;
        $this->userGroup = $userGroup;
        $this->group = $group;
        $this->role = $role;
        $this->userContentAssociation = $userContentAssociation;
        $this->attachment = $attachment;
        $this->sortingTag = $sortingTag;
        $this->groupContentAssociation = $groupContentAssociation;
        $this->tagContentAssociation = $tagContentAssociation;
        $this->tagUserAssociation = $tagUserAssociation;
        $this->userStatus = $userStatus;
        $this->contentAccessLevels = $contentAccessLevels;
        $this->metaData = $metaData;
        $this->userSortingTag = $userSortingTag;
        $this->claimProfileRequests = $claimProfileRequests;
        $this->tagGroupAssociation = $tagGroupAssociation;
    }

    public function getUsers($filter = array(), $user_id = null)
    {
        $current_user = $this->getUser($user_id);

        $r = $this->user->with(['role','image','groups' => function($q){
            $q->with('group');
        }])
        ->leftJoin('user_groups', 'users.id', 'user_groups.user_id')
        ->leftJoin('contents', function($q){
            $q->on('users.id', 'contents.user_id')
                ->where('contents.status', '1');
        });

        if($current_user['role_id'] == 1){

        }else{
            $r = $r->where('users.access_level_id', '1');
            //should list only public users
//            $r = $r->where('user_groups.id', $current_user['group_id']);
        }

        if(isset($filter['group_id'])){
            $r = $r->whereIn('user_groups.group_id', array($filter['group_id']));
        }

        if(isset($filter['filter_system_users'])){
            $r = $r->where('users.status_id', '5');
        }

//        $r->select('users.id','users.*','user_groups.id as group_id');
        $r->select('users.id','users.*',
            DB::Raw("COUNT(contents.id) as no_submission"));
        $r->groupBy('users.id')->orderBy('updated_at', 'DESC');
        $r = $r->get();

        return $r;
    }

    public function getUser($user_id)
    {
        return $this->user->where('users.id', $user_id)->with(['image','groups',
            'actingRoles' => function($q){
                $q->with('tag');
            },
            'gci' => function($q){
                $q->with('tag');
            },
            'skill' => function($q){
                $q->with('tag');
            }])
            ->leftJoin('user_groups', 'users.id', 'users.location', 'user_groups.user_id')
            ->select('users.*', 'user_groups.group_id', 'user_groups.role_id as group_role_id')
            ->first();
    }

    public function getUserStatus($user_id)
    {
        $status = '';
        $user_info = $this->user->where('users.id', $user_id)
            ->select('users.access_level_id','users.last_active')->first();

        if(!empty($user_info['last_active'])){
            $start  = date_create($user_info['last_active']);
            $end 	= date_create(); // Current time and date
            $diff  	= date_diff( $start, $end );
            $diff_sec = ((($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i)*60 + $diff->s;
        }else{
            $diff_sec = 10000;
        }

        if($user_info['access_level_id'] == '1'){//public
            $status = 'public';
        }elseif($user_info['access_level_id'] == '2'){//only logged
            if($diff_sec <= 120){
                $status = 'logged-in';
            }else{
                $status = 'only-logged';
            }
        }elseif($user_info['access_level_id'] == '3'){//private
            $status = 'private';
        }

        return $status;
    }

    public function getGroupInfo($group_id, $full = false, $public = false)
    {
        $group_info = $this->group->where('groups.id', $group_id)->with(['proofOfGroup','groupAvatar','actingRoles' => function($q){
            $q->with('tag');
        }])
            ->first()->toArray();

        if($full){
            if(isset($group_info['id'])){
                $group_info['users'] = $this->user->leftJoin('user_groups','users.id', 'user_groups.user_id')
                    ->select('users.*')
                    ->where('user_groups.group_id', $group_info['id']);

                if($public)
                    $group_info['users'] = $group_info['users']->where('users.access_level_id', 1);//visible only public

                $group_info['users'] = $group_info['users']->get()->toArray();
                $group_info['videos'] = $this->content
                    ->leftJoin('group_content_associations','group_content_associations.content_id', 'contents.id')
                    ->where('group_content_associations.group_id', $group_info['id'])
                    ->where('contents.status', 1)
                    ->select('contents.*')
                    ->groupBy('contents.id')
                    ->get()->toArray();
            }
        }


        return $group_info;
    }

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

    public function getPublicContents($user_id, $filter = array(), &$count = 0)
    {
        $contents = $this->content->with(['videoProducer' => function($q){
            $q->with('user');
        }])
            ->leftJoin('users', 'contents.user_id', 'users.id')->where(function($q) use ($user_id){
                $q->where(function($r) use ($user_id){
                    $r->whereIn('users.id', array($user_id))->orWhere('contents.access_level_id', '1');
                });
            })->leftJoin('tag_content_associations', function($q){
                $q->on( 'contents.id', 'tag_content_associations.content_id');
                $q->where( 'tag_content_associations.tag_for', 'gci');
            })->leftJoin('tag_content_associations as search_tag', function($q){
                $q->on( 'contents.id', 'search_tag.content_id');
                $q->where( 'search_tag.tag_for', 'gci');
            })
            ->leftJoin('sorting_tags', function($q){
                $q->on('sorting_tags.id', 'tag_content_associations.content_tag_id');
            })
            ->leftJoin('user_content_associations',
                'user_content_associations.content_id', 'contents.id')
            ->leftJoin('group_content_associations',
                'group_content_associations.content_id', 'contents.id')
            ->leftJoin('user_groups',
                'user_groups.group_id', 'group_content_associations.group_id')
            ->leftJoin('user_sorting_tags',
                'user_content_associations.user_association_tag_slug', 'user_sorting_tags.slug')
            ->leftJoin('groups',
                'groups.id', 'user_groups.group_id')

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

        if(isset($filter['video_id']) && !empty($filter['video_id'])){
            $contents = $contents->where('contents.id', $filter['video_id']);
        }

        if(isset($filter['user_involvement']) && !empty($filter['user_involvement'])){
            $contents = $contents->where('user_content_associations.user_id', $filter['user_involvement']);
        }

        if(isset($filter['group_involvement']) && !empty($filter['group_involvement'])){
            $contents = $contents->where('user_groups.user_id', $filter['group_involvement']);
        }

        $contents = $contents->select('contents.id', DB::Raw("SUBSTRING(contents.brief_description, 1, 128) as trim_description"), 'contents.lat', 'contents.long', 'contents.title', 'contents.url',
                'users.display_name','contents.created_at','contents.location','contents.user_id','contents.primary_subject_tag',DB::Raw("GROUP_CONCAT(DISTINCT (user_sorting_tags.name) SEPARATOR ', ') as user_association"), DB::Raw("GROUP_CONCAT(DISTINCT (groups.name) SEPARATOR ', ') as group_names"),
                DB::Raw("GROUP_CONCAT(DISTINCT (concat(sorting_tags.tag_color,'-',sorting_tags.id,'-',sorting_tags.tag)) SEPARATOR ', ') as tag_colors") )
            ->groupBy('contents.id')->orderBy('contents.updated_at', 'DESC')->limit(500)->get();
        $r = array(); $i = 0;

        foreach($contents as $c){
            if(isset($c['lat']) && isset($c['long'])){
                $r[$i] = $c;
                $r[$i]['video'] = $c['url'];
                $i++;
            }
        }

        $count = $i;
        return $r;
    }

    public function getAvailableContents($id)
    {
        $contents = $this->content->where('id', $id)
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
        $contents = $this->content->with(['user',
        'gciTags'=>function($q){
            $q->with('tag');
        },'coCreators'=>function($q){
            $q->with('user');
        },'onScreen'=>function($q){
            $q->with('user');
        },'videoProducer'=>function($q){
            $q->with('user');
        },'groups'=>function($q){
            $q->with('group');
        },'sortingTags'=>function($q){
                $q->with('tag');
        },'category'])
            ->where('contents.id',$id)
                ->where('contents.status', '=', 1)
                ->leftJoin('users', 'contents.user_id', 'users.id')->where(function($q) use ($user_id){
            $q->where(function($r) use ($user_id){
                $r->whereIn('users.id', array($user_id))->orWhere('contents.access_level_id', '1');
            });
        })
            ->select('contents.*', 'users.first_name', 'users.display_name')
            ->get();

        $contents = isset($contents[0])?$contents[0] : array();
        return $contents;
    }

    function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    function groupList($user_id, $full = false, $group_id = 0)
    {
        $user_info = $this->getUser($user_id);

        $user_group = $this->group;
        if($full){
            $user_group = $user_group->with('groupStatus');
            $user_group = $user_group->leftJoin(DB::raw('(SELECT count(user_id) as users_count, group_id FROM user_groups GROUP BY group_id) as user_groups'), 'id', 'user_groups.group_id')
            ->leftJoin('group_content_associations', 'group_content_associations.group_id', 'groups.id')
            ->leftJoin('contents', function($q){
                $q->on('group_content_associations.content_id', 'contents.id')
                    ->where('contents.status', '1');
            })

            ->leftJoin('user_groups as user_groups2', 'user_groups2.group_id', 'groups.id')
            ->leftJoin('users as users_in_group', function($q){
                $q->on('user_groups2.user_id', 'users_in_group.id')
                    ->where('users_in_group.role_id', '100');
            });

            $user_group = $user_group->select('groups.*', DB::Raw('GROUP_CONCAT(DISTINCT users_in_group.display_name SEPARATOR ", ") as group_admin'),
                DB::Raw("count(DISTINCT contents.id) as active_video_count"), 'user_groups.users_count');
//            $user_group->select('groups.*', DB::Raw("count(contents.id) as active_video_count"));


        }

//        $user_group->orderBy('groups.updated_at','DESC');
        if($group_id <> 0){
            $user_group = $user_group->where('groups.id', $group_id);
            $user_group->with(['proofOfGroup','groupAvatar','actingRoles','experienceKnowledge' => function($q){
                $q->with('tag');
            }]);
            $user_group = $user_group->groupBy('groups.id')->first();
        }else{
            if($full){
                $user_group = $user_group->groupBy('groups.id')->orderBy('groups.updated_at','DESC')->get();
            }else{
                $user_group = $user_group->select('groups.*');
                if($user_info['role_id'] <> '1'){
                    $user_group = $user_group->leftJoin('user_groups', 'user_groups.group_id', 'groups.id');
                    $user_group = $user_group->where('user_groups.user_id', $user_info['id']);
                }
                $user_group = $user_group->groupBy('groups.id')->orderBy('groups.updated_at','DESC')->get();

            }
        }

        return $user_group;
    }

    function deleteUserFromGroup($user_id, $group_id = 0)
    {
        $user_gr = $this->userGroup->where('user_id', $user_id);
        if($group_id){
            $user_gr->where('group_id', $group_id);
        }

        return $user_gr->delete();
    }

    function deleteUserFromTag($user_id, $slug)
    {
        $user_gr = $this->tagUserAssociation->where('user_id', $user_id)->where('slug', $slug);
        return $user_gr->delete();
    }

    function deleteGroupFromTag($group_id, $slug)
    {
        $user_gr = $this->tagGroupAssociation->where('group_id', $group_id)->where('slug', $slug);
        return $user_gr->delete();
    }

    function addTagToUser($user_id, $tag_id, $slug)
    {
        return $this->tagUserAssociation->create(
            array(
                'user_id' => $user_id,
                'user_tag_id' => $tag_id,
                'slug' => $slug
            )
        );
    }

    function addTagToGroup($group_id, $tag_id, $slug)
    {
        return $this->tagGroupAssociation->create(
            array(
                'group_id' => $group_id,
                'group_tag_id' => $tag_id,
                'slug' => $slug
            )
        );
    }

    function deleteUsersFromGroup($group_id)
    {
        return $this->userGroup->where('group_id', $group_id)->delete();
    }

    function addUserToGroup($user_id, $group_id, $role_id = 0)
    {
        return $this->userGroup->create(
            array(
                'user_id' => $user_id,
                'group_id' => $group_id,
                'role_id' => 120
            )
        );
    }

    function getUserRoles($user_id)
    {
        $user_info = $this->getUser($user_id);
        $user_roles = $this->role;
        if($user_info['role_id'] <> '1'){
            $user_roles = $user_roles->where('id','>=', ($user_info['role_id']));//must have equal or less powers
        }

        $user_group = $user_roles->orderBy('id', 'DESC')->get();
        return $user_group;
    }

    function updateUserContentAssociations($user_id, $content_id, $association_tag_slug)
    {
        $this->userContentAssociation->create(
            array(
                'content_id' => $content_id,
                'user_id' => $user_id,
                'user_association_tag_slug' => $association_tag_slug
            )
        );
    }

    function deleteUserContentAssociations($user_id, $content_id, $association_tag_slug)
    {
        return $this->userContentAssociation->where('content_id', $content_id)->where('user_association_tag_slug', $association_tag_slug)->delete();
    }


    public function uploadAttachment($file,$user_id, $fk_id, $submission_type, $table, $status = 1)
    {
//        $filename = $file->storeAs('public',$submission_type.'_'.microtime().'_'.$table);
        $filename = $file->store('public');
        $ori_name = File::name($filename);

        if(isset($ori_name)){
            $extension = File::extension($filename);
            Attachment::create([
                'table' => $table,
                'fk_id' => $fk_id,
                'name' => $ori_name,
                'url' => str_replace('public/','',$filename),
                'submission_type' => $submission_type,
                'extension' => $extension,
                'status' => $status,
                'created_by' => $user_id
            ]);
        }
    }

    public function uploadAttachmentBase64($data,$user_id, $fk_id, $submission_type, $table, $status = 1)
    {
        $filename = $submission_type.'_'.microtime().'_'.$table.'.png';
//        $filename = $file->store('public');
//        $ori_name = File::name($filename);
        if(empty($data))
            return;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
//        file_put_contents('/public/storage/image64.png', $data);
        $ori_name = $filename;
        Storage::put('/public/'.$filename, $data);

        if(isset($ori_name)){
            $extension = File::extension($filename);
            Attachment::create([
                'table' => $table,
                'fk_id' => $fk_id,
                'name' => $ori_name,
                'url' => str_replace('public/','',$filename),
                'submission_type' => $submission_type,
                'extension' => $extension,
                'status' => $status,
                'created_by' => $user_id
            ]);
        }
    }

    public function deleteAttachmentByFkId($user_id, $fk_id, $submission_type, $table, $delete_hard_copy = false)
    {
        return $this->attachment->where('fk_id',$fk_id)->where('submission_type', $submission_type)->where('table',$table)->delete();
    }

    public function getSortingTags($user_id, $only_selectable = false)
    {
        $current_user = $this->getUser($user_id);

        $tag = $this->sortingTag;
        if($only_selectable){
            $tag = $tag->where('not_selectable', '0');
        }
        if($current_user['role_id'] != 1){
            $tag = $tag->where(function($q) use($current_user){
                $q->where('group_id', $current_user['group_id'])
                    ->orWhere('created_by', $current_user['id'])
                    ->orWhere('group_id', '0');
            });
        }
        $tag = $tag->where('status', 1);

        return $tag->get();
    }

    public function getGreaterCommunityIntentionTag()
    {
        $tag = $this->sortingTag->where('tag_for', 'gci');
        return $tag->get();
    }

    public function getSkillsTag()
    {
        $tag = $this->sortingTag->where('tag_for', 'skill');
        return $tag->get();
    }

    public function addSortingTag($user_id, $group_id = 0, $data)
    {
        $current_user = $this->getUser($user_id);
        //anyone can add sorting tag for now.
//        if($current_user['role_id'] == 1){
            return $this->sortingTag->create(array('tag' => $data['tag'], 'description' => $data['description'],
                'created_by' => $user_id, 'group_id' => $group_id));
//        }

    }

    function updateGroupContentAssociations($user_id, $content_id, $group_id)
    {
        return $this->groupContentAssociation->create(
            array(
                'content_id' => $content_id,
                'group_id' => $group_id
            )
        );
    }

    function deleteGroupContentAssociations($user_id, $content_id)
    {
        return $this->groupContentAssociation->where('content_id', $content_id)->delete();
    }

    public function addIfNotExist($value, $type, $user_id = 0)
    {
        switch($type){
            case 'user':
                $email = $this->getAutoGeneratedEmail($value);
                $validator = Validator::make(array('email' => $email, 'display_name' => $value), [
                    'email' => 'required|email|unique:users',
                    'display_name' => 'required|unique:users'
                ]);
                if (!$validator->fails()) {
                    return $this->user->create(
                        array(
                            'email' => $email,
                            'first_name' => $value,
                            'display_name' => $value,
                            'status_id' => 5,
                            'role_id' => 120,
                            'password' => bcrypt($this->randomPassword()),
                        )
                    );
                }else{
                    return $this->user->where('display_name', $value)->first();
                }
                break;
            case 'group':
                return $this->group->create(
                    array(
                        'name' => $value,
                        'status' => 5
                    )
                );
                break;
            case 'tag':
                $current_user = $this->getUser($user_id);
                return $this->sortingTag->create(
                    array('tag' => $value,
                        'description' => '',
                        'created_by' => $user_id,
                        'tag_for' => 'content',
                        'group_id' => isset($current_user['group_id'])?$current_user['group_id']: 0
                    )
                );
                break;
            case 'skill':
                $current_user = $this->getUser($user_id);
                return $this->sortingTag->create(
                    array('tag' => $value,
                        'description' => '',
                        'created_by' => $user_id,
                        'tag_for' => 'skill',
                        'group_id' => isset($current_user['group_id'])?$current_user['group_id']: 0
                    )
                );
                break;
        }
    }

    public function addTagToContent($tag_id, $content_id, $tag_for = 'contents')
    {
        return $this->tagContentAssociation->create(
            array(
                'content_tag_id' => $tag_id,
                'content_id' => $content_id,
                'tag_for' => $tag_for,
            )
        );
    }

    public function deleteTagsOfContent($content_id,$user_id, $tag_for = 'contents')
    {
        return $this->tagContentAssociation->where('content_id', $content_id)->where('tag_for', $tag_for)->delete();
    }

//    public function addTagToUser($tag_id, $user_id)
//    {
//        return $this->tagContentAssociation->create(
//            array(
//                'user_tag_id' => $tag_id,
//                'user_id' => $user_id,
//            )
//        );
//    }

    public function deleteTagsOfUser($user_id, $deleting_user_id)
    {
        return $this->tagContentAssociation->where('user_tag_id', $user_id)->delete();
    }

    public function deleteTagsOfUserBySlug($user_id, $deleting_user_id, $slug)
    {
        return $this->tagUserAssociation->where('user_id', $user_id)->where('slug', $slug)->delete();
    }

    public function deleteTagsOfGroupBySlug($group_id, $slug)
    {
        return $this->tagGroupAssociation->where('group_id', $group_id)->where('slug', $slug)->delete();
    }

    public function getStatus()
    {
        return $this->userStatus->get();
    }

    public function getAccessLevels()
    {
        return $this->contentAccessLevels->get();
    }

    public function getAutoGeneratedEmail($input)
    {
        return str_replace('@','',$input).rand(10,100).'@'.env('AUTO_GENERATED_EMAIL_DOMAIN', 'perceptions.live');
    }

    public function getUserActingRoles()
    {
        return $this->userSortingTag->where('slug', 'role')->get();
    }

    public function getAssociatedVideosForUser($user_id)
    {
        return $this->content
            ->leftJoin('user_content_associations', 'user_content_associations.content_id', 'contents.id')
            ->where(function($q) use ($user_id){
                $q->where('user_content_associations.user_id', $user_id)
                    ->orWhere('contents.user_id', $user_id);
            })->where('status', '1')->select('contents.*')->groupBy('contents.id')->get();
    }

    public function getClaimRequestsForUser($user_id)
    {
        return $this->claimProfileRequests->with(['proof','associatedContent' => function($q){
            $q->with('content');
        },'requestedUser'])->where('fk_id', $user_id)->where('type', 'users')->get();
    }

    public function getUsersList($user_id, $filter, $limit = 30)
    {
        $users = $this->user;

        if(isset($filter['keyword']) && !empty($filter['keyword'])){
            $users = $users->where(function($q) use($filter){
                $q->where('display_name', 'like', '%'.$filter['keyword'].'%');
                $q->orWhere('first_name', 'like', '%'.$filter['keyword'].'%');
            });
        }

        if(isset($filter['ids'])){
            $users = $users->whereIn('id', $filter['ids']);
        }

        $users = $users->where('access_level_id', '1')->where('status_id','<>','3');//only public and not deleted

        $users = $users->select('users.*')->limit($limit);
        return $users->get();
    }

    public function getGroupList($user_id, $filter, $limit = 30)
    {
        $groups = $this->group;

        if(isset($filter['keyword']) && !empty($filter['keyword'])){
            $groups = $groups->where(function($q) use($filter){
                $q->where('name', 'like', '%'.$filter['keyword'].'%');
                $q->orWhere('description', 'like', '%'.$filter['keyword'].'%');
            });
        }

        if(isset($filter['ids'])){
            $groups = $groups->whereIn('groups.id', $filter['ids']);
        }

        $groups = $groups->where('status','=','1');//only public and not deleted

        $groups = $groups->select('groups.*')->limit($limit);
        return $groups->get();
    }

    public function updateLastActive($user_id)
    {
        $user = $this->user->where('id',$user_id)->first();
        $user->last_active = date_create();
        $user->save();
    }
}

