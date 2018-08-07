<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $table = 'groups';

    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id', 'greeting_message_to_community', 'name', 'description','current_mission', 'experience_knowledge_interest',
        'experience_knowledge_interests', 'default_location','contact_user_id',
        'category_id', 'learn_more_url', 'content_name', 'content_email', 'accept_tos'];
}
