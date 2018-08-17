<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupContentAssociation extends Model
{
    protected $hidden = [];
    public $timestamps = false;

    protected $table = 'group_content_associations';

    /**
     * @var array
     */
    protected $fillable = ['content_id', 'group_id'];

    public function group()
    {
        return $this->belongsTo('App\Group','group_id');
    }
}
