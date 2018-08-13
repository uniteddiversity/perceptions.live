<?php

namespace App\Controllers;

use App\Content;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    public $content;

    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminLocationList()
    {
        $location_list = $this->content
            ->select('contents.location', DB::Raw("GROUP_CONCAT(DISTINCT users.display_name SEPARATOR ', ') as display_names"),
                DB::Raw('count(DISTINCT contents_active.id) active_videos'),
                DB::Raw('count(DISTINCT users.id) associate_users'),
                DB::Raw('count(DISTINCT groups.id) associate_groups')
                ,DB::Raw("GROUP_CONCAT(DISTINCT moderator_users.display_name SEPARATOR ', ') as moderators")
            )
            ->leftJoin('user_content_associations', 'user_content_associations.content_id', 'contents.id')
            ->leftJoin('users', 'users.id', 'user_content_associations.user_id')
            ->leftJoin('group_content_associations', 'group_content_associations.content_id', 'contents.id')
            ->leftJoin('user_content_associations as user_content_associations_moderator', 'user_content_associations_moderator.content_id', 'contents.id')
            ->leftJoin('groups', 'groups.id', 'group_content_associations.group_id')
            ->leftJoin('contents as contents_active', function ($q) {
                $q->on('contents_active.id', 'contents.id')
                    ->where('contents.status', '1');
            })
            ->leftJoin('users as moderator_users', function($q){
                $q->whereIn('moderator_users.role_id', array(100,110,1))
                ->on('user_content_associations_moderator.user_id', 'moderator_users.id')
                ;
            })
//            ->where('contents.status', '1')
            ->groupBy('contents.location')
//            ->toSql();
            ->get()->toArray();

//        dd($location_list);
        return view('admin.location-list')
            ->with(compact('location_list'));
    }
}
