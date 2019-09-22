<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $table = 'groups';

    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id', 'greeting_message_to_community', 'name', 'description','current_mission', 'experience_knowledge_interest',
        'experience_knowledge_interests', 'default_location','contact_user_id',
        'category_id', 'learn_more_url', 'content_name', 'content_email', 'accept_tos', 'status', 'created_by'];

    public function groupStatus()
    {
        return $this->belongsTo('App\UserStatus','status');
    }

    public function proofOfGroup()
    {
        return $this->hasMany('App\Attachment', 'fk_id')->where('table','groups')
            ->where('status','=','1')
            ->where('submission_type','=','proof-of-group-in');
    }

    public function groupAvatar()
    {
        return $this->hasMany('App\Attachment', 'fk_id')->where('table','groups')
            ->where('status','=','1')
            ->where('submission_type','=','group-avatar');
    }

    public function experienceKnowledge()
    {
        return $this->hasMany('App\TagGroupAssociation','group_id')->where('slug','experience_kno');
    }

    public function gci()
    {
        return $this->hasMany('App\TagGroupAssociation','group_id')->where('slug','gci');
    }

    public function actingRoles()
    {
        return $this->hasMany('App\TagGroupAssociation','group_id')->where('slug','role');
    }

    public function image()
    {
        return $this->hasMany('App\Attachment', 'fk_id')->where('table','groups')
            ->where('status','=','1')
            ->where('submission_type','=','group-avatar');
    }

    public function category()
    {
        return $this->hasOne('App\Category','id','category_id');
    }

    public function getGroupByName($name)
    {
        $r = $this->where('name',$name)->get()->first();
        if($r)
            return $r;
        else
            return false;
    }
}
