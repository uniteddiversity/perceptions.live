<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    public $table = 'user_status';

    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'slug'];
}
