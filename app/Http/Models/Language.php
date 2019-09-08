<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public $table = 'languages';

    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['language', 'code'];
}
