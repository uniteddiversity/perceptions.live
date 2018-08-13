<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSortingTag extends Model
{
    protected $hidden = [];

    protected $table = 'user_sorting_tags';
    /**
     * @var array
     */
    protected $fillable = ['id','name','slug'];
}
