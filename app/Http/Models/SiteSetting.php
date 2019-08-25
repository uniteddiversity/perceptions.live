<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $hidden = [];

    protected $table = 'site_settings';

    /**
     * @var array
     */
    protected $fillable = ['id', 'key', 'value', 'other', 'user_id'];

    public function deleteAll(){
        $this->where('id' ,'<>' , '')->delete();
    }

    public function getAll(){
        return $this->whereIn('key',array('home_centered_title'))->get();
    }
}
