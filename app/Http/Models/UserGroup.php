<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    public $table = 'user_groups';

    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id', 'group_id', 'user_id', 'role_id'];

    public function group()
    {
        return $this->hasOne('App\Group', 'id','group_id');
    }

    public function contentsAssociation()
    {
        return $this->hasMany('App\GroupContentAssociation', 'group_id','id');
    }
}
