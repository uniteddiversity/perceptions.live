<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeSliderFeedSetting extends Model
{
    protected $hidden = [];

    public $timestamps = false;

    protected $table = 'home_slider_feed_settings';

    /**
     * @var array
     */
    protected $fillable = ['id', 'feed_id', 'type', 'fk_id'];
}
