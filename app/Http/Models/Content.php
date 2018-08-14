<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['title', 'access_level_id', 'description', 'lat', 'long', 'user_id', 'status','user_ip', 'url',
        'captured_date','video_date','video_producer','onscreen','learn_more_url','co_creators','category_id','grater_community_intention_id',
        'primary_subject_tag','secondary_subject_tag_id','submitted_footage','brief_description','location','url_split','full_embed_code',
        'video_id','video_id_old','user_comment'];

//    public function role()
//    {
//        return $this->belongsTo('App\Role');
//    }
//
//    public function content()
//    {
//        return $this->hasMany('App\Content')->where('contents.is_deleted', '<>', 1);
//    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function coCreators()
    {
        return $this->hasMany('App\UserContentAssociation','content_id')->where('user_association_tag_slug','co-cr');
    }

    public function onScreen()
    {
        return $this->hasMany('App\UserContentAssociation','content_id')->where('user_association_tag_slug','on-s');
    }

    public function videoProducer()
    {
        return $this->hasMany('App\UserContentAssociation','content_id')->where('user_association_tag_slug','vd-p');
    }

    public function groups()
    {
        return $this->hasMany('App\GroupContentAssociation','content_id');
    }

    public function sortingTags()
    {
        return $this->hasMany('App\TagContentAssociation','content_id')->where('tag_for', 'contents');
    }

    public function gciTags()
    {
        return $this->hasMany('App\TagContentAssociation','content_id')->where('tag_for', 'gci');
    }
}
