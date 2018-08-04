<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['name', 'access_level_id', 'type', 'content', 'lat', 'long', 'user_id', 'is_deleted','user_ip', 'url'];
}
