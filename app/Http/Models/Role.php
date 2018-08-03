<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'slug'];
}
