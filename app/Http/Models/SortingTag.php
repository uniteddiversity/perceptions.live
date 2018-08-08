<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SortingTag extends Model
{
    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id','tag','tag_color','description','created_by','group_id'];

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
