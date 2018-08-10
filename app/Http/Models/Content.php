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
}
