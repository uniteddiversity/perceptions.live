<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEditVideo extends Model
{
    public $table = 'user_edit_videos';

    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'token', 'info', 'is_deleted'];
}
