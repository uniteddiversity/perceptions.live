<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaProject extends Model
{
    public $table = 'media_projects';

    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'title', 'location', 'video_date', 'description', 'status'];
}
