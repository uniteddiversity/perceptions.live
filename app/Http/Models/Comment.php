<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'table', 'fk_id', 'comment', 'created_by'
        , 'modified_by', 'parent_id', 'status'];

    public function user()
    {
        return $this->hasOne('App\User', 'id','user_id');
    }

    /**
     * The has Many Relationship
     * @var array
     */

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->where('status', 1);
    }
}
