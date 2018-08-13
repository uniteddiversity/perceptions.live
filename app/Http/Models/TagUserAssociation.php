<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagUserAssociation extends Model
{
    protected $hidden = [];
    public $timestamps = false;

    protected $table = 'tag_user_associations';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'user_tag_id', 'slug'];
}
