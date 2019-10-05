<div>
    Following Claim request has been approved, that has been requested by {{$data['email']}}!
</div>
<div>
    First name: {{ $data->needUser['first_name'] }}
</div>
<div>
    First name: {{ $data->needUser['display_name'] }}
</div>
<div>
    First name: {{ $data->needUser['email'] }}
</div>
<div>
    Please Use following auto generated password to login
    <div>
        Password : <b>{{ $new_password }}</b>
    </div>
</div>
