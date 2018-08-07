<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserContentAssociation extends Model
{
    protected $hidden = [];
    public $timestamps = false;

    protected $table = 'user_content_associations';

    /**
     * @var array
     */
    protected $fillable = ['content_id', 'user_id', 'user_association_tag_slug'];
}
