<?php

namespace User\Services;

use App\Attachment;
use App\Content;
use App\ContentAccessLevels;
use App\Group;
use App\GroupContentAssociation;
use App\MetaData;
use App\Role;
use App\SortingTag;
use App\TagContentAssociation;
use App\TagUserAssociation;
use App\User;
use App\UserContentAssociation;
use App\UserGroup;
use App\UserSortingTag;
use App\UserStatus;
use Content\Services\ContentService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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

    public function __construct(User $user, Content $content,
                                UserGroup $userGroup, Group $group, Role $role, UserContentAssociation $userContentAssociation,
                                Attachment $attachment, SortingTag $sortingTag, GroupContentAssociation $groupContentAssociation,
                                TagContentAssociation $tagContentAssociation, TagUserAssociation $tagUserAssociation, UserStatus $userStatus,
                                ContentAccessLevels $contentAccessLevels, MetaData $metaData, UserSortingTag $userSortingTag)
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
    }

    public function getUsers($filter = array(), $user_id = null)
    {
        $current_user = $this->getUser($user_id);

        $r = $this->user->with(['role', 'groups' => function($q){
            $q->with('group');
        }])
        ->leftJoin('user_groups', 'users.id', 'user_groups.user_id')
        ->leftJoin('contents', function($q){
            $q->on('users.id', 'contents.user_id')
                ->where('contents.status', '1');
        });

        if($current_user['role_id'] == 1){

        }else{
            $r = $r->where('user_groups.id', $current_user['group_id']);
        }

        if(isset($filter['group_id'])){
            $r->whereIn('user_groups.group_id', array($filter['group_id']));
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
        return $this->user->where('users.id', $user_id)->with('image','groups','actingRoles')
            ->leftJoin('user_groups', 'users.id', 'user_groups.user_id')
            ->select('users.*', 'user_groups.group_id', 'user_groups.role_id as group_role_id')
            ->first();
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

    public function getPublicContents($user_id)
    {
        $contents = $this->user->leftJoin('contents', 'contents.user_id', 'users.id')->where(function($q) use ($user_id){
            $q->where(function($r) use ($user_id){
                $r->whereIn('users.id', array($user_id))->orWhere('contents.access_level_id', '1');
            });
        })->where('contents.status', '=', 1)
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
        $contents = $this->content->with('user')
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
        if($user_info['role_id'] <> '1'){
            $user_group->where('id', $user_id['group_id']);
        }

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

            $user_group->select('groups.*', DB::Raw('users_in_group.display_name as group_admin'), DB::Raw("count(contents.id) as active_video_count"));
        }

//        $user_group->orderBy('groups.updated_at','DESC');
        if($group_id <> 0){
            $user_group = $user_group->where('groups.id', $group_id);
            $user_group->with('proofOfGroup','groupAvatar');
            $user_group = $user_group->groupBy('groups.id')->first();
        }else{
            if($full){
                $user_group = $user_group->groupBy('groups.id')->groupBy('users_in_group.id')->orderBy('groups.updated_at','DESC')->get();
            }else{
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
            $user_roles->where('id','<=', $user_id['role_id']);//must have equal or less powers
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

    public function addSortingTag($user_id, $group_id = 0, $data)
    {
        $current_user = $this->getUser($user_id);
        if($current_user['role_id'] == 1){
            return $this->sortingTag->create(array('tag' => $data['tag'], 'description' => $data['description'],
                'created_by' => $user_id, 'group_id' => $group_id));
        }

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
                            'status_id' => 2,
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
                        'status' => 2
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
        }
    }

    public function addTagToContent($tag_id, $content_id)
    {
        return $this->tagContentAssociation->create(
            array(
                'content_tag_id' => $tag_id,
                'content_id' => $content_id,
            )
        );
    }

    public function deleteTagsOfContent($content_id,$user_id)
    {
        return $this->tagContentAssociation->where('content_id', $content_id)->delete();
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
        return str_replace('@','',$input).rand(10,100).'@'.env('AUTO_GENERATED_EMAIL_DOMAIN', 'osm.com');
    }

    public function getUserActingRoles()
    {
        return $this->userSortingTag->where('slug', 'role')->get();
    }
}

