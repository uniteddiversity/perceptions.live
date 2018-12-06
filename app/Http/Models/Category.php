<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id', 'name'];
}
