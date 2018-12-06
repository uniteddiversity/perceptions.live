<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagContentAssociation extends Model
{
    protected $hidden = [];
    public $timestamps = false;

    protected $table = 'tag_content_associations';

    /**
     * @var array
     */
    protected $fillable = ['content_id', 'content_tag_id', 'tag_for'];

    public function tag()
    {
        return $this->hasOne('App\SortingTag','id','content_tag_id');
    }
}
