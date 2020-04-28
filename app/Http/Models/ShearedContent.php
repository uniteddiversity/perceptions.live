<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShearedContent extends Model
{
    protected $hidden = [];

    protected $table = 'shared_contents';

    /**
     * @var array
     */
    protected $fillable = ['id', 'group', 'allowed_domain', 'allowed_ip', 'created_by', 'primary_subject_tag','public_token','default_zoom_level','lat','long','default_location','description','extra_css'];

    public function user()
    {
        return $this->hasOne('App\User', 'id','created_by');
    }

    public function association()
    {
        return $this->hasMany('App\ShearedContentAssociation', 'shared_content_id','id');
    }


}
