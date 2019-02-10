<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaPackage extends Model
{
    public $table = 'media_packages';

    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'description', 'min_video_minutes', 'max_video_minutes', 'charge_per_minute', 'is_deleted'];
}
