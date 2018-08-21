<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimProfileRequests extends Model
{
    protected $hidden = [];
    public $timestamps = false;

    protected $table = 'claim_profile_request';

    /**
     * @var array
     */
    protected $fillable = ['type', 'display_name', 'email', 'comments', 'fk_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User','fk_id');
    }

    public function requestedUser()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function proof()
    {
        return $this->hasMany('App\Attachment', 'fk_id')->where('table','claim_profile_requests')
            ->where('status','=','1')
            ->where('submission_type','=','claim-proof');
    }

    public function associatedContent()
    {
        return $this->hasMany('App\ClaimAssociatedContents', 'claim_profile_request_id');
    }
}
