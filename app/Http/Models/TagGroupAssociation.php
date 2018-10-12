<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagGroupAssociation extends Model
{
    protected $hidden = [];
    public $timestamps = false;

    protected $table = 'tag_group_associations';

    /**
     * @var array
     */
    protected $fillable = ['group_id', 'group_tag_id', 'slug'];

    public function tag()
    {
        return $this->belongsTo('App\UserSortingTag','group_tag_id');
    }
}
