<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaData extends Model
{
    protected $hidden = [];

    protected $table = 'meta_data';

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'value'];
}
