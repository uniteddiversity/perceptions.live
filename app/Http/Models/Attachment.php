<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id', 'fk_id', 'submission_type', 'table', 'name', 'url', 'extension', 'status', 'created_by'];
}
