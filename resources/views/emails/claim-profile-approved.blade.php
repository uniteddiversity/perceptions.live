<div>Greetings from Perceptions.Live!<br><br></div>
<div>
    The following Claim Profile request, requested by {{$data['email']}}, has been approved!
</div>
<div>
    First Name:<strong> {{ $data->needUser['first_name'] }}</strong><br><br>
</div>
<div>
    Display Name: <strong>{{ $data->needUser['display_name'] }}</strong><br><br>
</div>
<div>
    E-mail: <strong>{{ $data->needUser['email'] }}</strong><br><br>
</div>
<div>
    Please use the following auto-generated password to login--and then be sure to change it!:<br>
    <div>
        Password : <strong>{{ $new_password }}</strong>
    </div>
</div>
<div>See you soon!<br><br></div>