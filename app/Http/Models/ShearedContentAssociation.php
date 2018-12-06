<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShearedContentAssociation extends Model
{
    protected $hidden = [];

    protected $table = 'shared_contents_associations';

    /**
     * @var array
     */
    protected $fillable = ['id', 'shared_content_id', 'table', 'fk_id', 'slug', 'type'];

//    public function videousers()
//    {
//        return $this->hasMany('App\User', 'shared_content_id')->where('table','users');
//    }

    public function contents()
    {
        return $this->belongsTo('App\Content', 'fk_id')->where('table','contents');
    }
////
////    public function tags()
////    {
////        return $this->hasMany('App\Content', 'shared_content_id')->where('table','sorting_tags');
////    }
////
////    public function categories()
////    {
////        return $this->hasMany('App\Category', 'shared_content_id')->where('table','categories');
////    }
}
