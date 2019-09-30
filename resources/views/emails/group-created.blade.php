<div>
    Name: {{ $data['name'] }}
</div>
<div>
    Description: {{ $data['description'] }}
</div>
<div>
    click <a href="{{env('APP_DOMAIN')}}/user/admin/group-edit/{{uid($data['id'])}}" >here</a> to view the group
</div>