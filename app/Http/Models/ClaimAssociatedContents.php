<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimAssociatedContents extends Model
{
    protected $hidden = [];
    public $timestamps = false;

    protected $table = 'claim_associated_content';

    /**
     * @var array
     */
    protected $fillable = ['claim_profile_request_id', 'type', 'fk_id'];

    public function content()
    {
        return $this->belongsTo('App\Content','fk_id');
    }

}
