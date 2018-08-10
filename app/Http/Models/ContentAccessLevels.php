<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentAccessLevels extends Model
{
    public $table = 'content_access_levels';

    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'slug'];
}
