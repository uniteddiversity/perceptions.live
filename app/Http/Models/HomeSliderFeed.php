<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeSliderFeed extends Model
{
    protected $hidden = [];

    public $timestamps = false;

    protected $table = 'home_slider_feeds';

    /**
     * @var array
     */
    protected $fillable = ['id', 'side', 'title', 'type', 'fk_id'];

    public function image()
    {
        return $this->hasMany('App\Attachment', 'fk_id')->where('table','home_slider_feeds ')
            ->where('status','=','1')
            ->where('submission_type','home_slider_feeds');
    }

    public function setting()
    {
        return $this->hasMany('App\HomeSliderFeedSetting', 'feed_id');
    }
}
