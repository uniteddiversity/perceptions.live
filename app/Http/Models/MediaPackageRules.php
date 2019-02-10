<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaPackageRules extends Model
{
    public $table = 'media_package_rules';

    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id', 'package_id', 'rule_key', 'rule_description', 'amount', 'is_deleted'];
}
