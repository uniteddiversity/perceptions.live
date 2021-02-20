@extends('layouts.app_inside')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card" id="user_content_add">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Terms</h4>
                <div class="table-responsive">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                <?php //dd($errors) ?>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <form action="/user/admin/setting/platform-config" method="post" id="submit_content" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="form-group">
                                <label for="exampleInputEmail1">Site title</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="site_title" placeholder="Title" value="{{$site_title}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Site URL</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="site_url" placeholder="Site URL" value="{{$site_url}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Site logo</label>
                                <input type="file" class="form-control" aria-describedby="nameHelp" name="site_logo" placeholder="Logo" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Site icon</label>
                                <input type="file" class="form-control" aria-describedby="nameHelp" name="site_icon" placeholder="Icon" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Site mission</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="site_mission" placeholder="Mission" value="{{$site_mission}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Site mission description</label>
                                <textarea type="text" class="form-control" aria-describedby="nameHelp" name="site_mission_description" placeholder="Mission description" >{{$site_mission_description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Site mission image</label>
                                <input type="file" class="form-control" aria-describedby="nameHelp" name="site_mission_image" placeholder="Mission image" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Google recaptcha key</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="g_recaptcha_key" placeholder="Recaptcha key" value="{{$g_recaptcha_key}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Google recaptcha secret</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="g_recaptcha_secret" placeholder="Recaptcha secret" value="{{$g_recaptcha_secret}}">
                            </div>

                            <hr/>
                            <h5 class="card-title">Email settings</h5>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mail host</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="mail_host" placeholder="Host" value="{{$mail_host}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mail port</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="mail_port" placeholder="port" value="{{$mail_port}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mail username</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="mail_username" placeholder="username" value="{{$mail_username}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mail password</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="mail_password" placeholder="password" value="{{$mail_password}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mail encryption</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="mail_encryption" placeholder="Encryption" value="{{$mail_encryption}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Outgoing email name</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="outgoing_email_name" placeholder="Outgoing email name" value="{{$outgoing_email_name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Outgoing email address</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="outgoing_email_address" placeholder="Outgoing email address" value="{{$outgoing_email_address}}">
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('backend.submit')}}</button>
                        </form>
                </div>
            </div>
        </div>
    </div>


    @endsection