<div>
    Type : {{ $target_data['type'] }}
</div>
<div>
    Title : {{ isset($target_data['content']) && isset($target_data['content'])? $target_data['content']['title']: ''}}
</div>
<div>
    User : @ {{ isset($data[0]->user['display_name'])? $data[0]->user['display_name'] : '' }}
</div>
<div>
    Comment : {{ isset($data[0]['comment'])? $data[0]['comment'] : '' }}
</div>
<div>
    Status : {{ ($data[0]['status'] == '1')? 'Approved' : 'Un Approved' }}
</div>
<div>
    click <a href="{{env('APP_DOMAIN')}}/user/admin/comment-list/{{uid($data[0]['fk_id'])}}/{{uid($data[0]['table'])}}" >here</a> to view the comment
</div>