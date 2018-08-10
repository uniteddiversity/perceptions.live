<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentAccessLevels extends Model
{
    public $table = 'user_status';

    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'slug'];
}
