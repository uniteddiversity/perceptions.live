@extends('layouts.app_inside')

@section('content')
    <?php

    $data = array();
    $data['id'] = isset($user_data['id'])?$user_data['id']:'';
    $data['email'] = isset($user_data['email'])?$user_data['email']:'';
    $data['first_name'] = isset($user_data['first_name'])?$user_data['first_name']:'';
    $data['last_name'] = isset($user_data['last_name'])?$user_data['last_name']:'';
    $data['status_id'] = isset($user_data['status_id'])?$user_data['status_id']:'';
    $data['image'] = isset($user_data['image'])?$user_data['image']:array();
    $data['group'] = isset($user_data['groups'])?array_column($user_data['groups'],'group_id'):array();

//    dd($data);
    ?>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add User</h4>
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
                        <form action="/user/admin/post-user-add" method="post" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" name="id" id="id" value="{{ uid($data['id']) }}" />
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input <?php if(!empty($data['id'])){ echo 'disabled'; } ?> type="text" class="form-control" aria-describedby="nameHelp" name="email" placeholder="Email" value="{{ old('email',$data['email']) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="first_name" placeholder="First Name" value="{{ old('first_name',$data['first_name']) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="last_name" placeholder="Last Name" value="{{ old('last_name',$data['last_name']) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="password" placeholder="Password" value="{{ old('password') }}">
                            </div>

                            <div class="form-group">
                                <?php if(Auth::user()->is('Admin')){ ?>
                                <label for="status_id">Status</label>
                                <select class="form-control" id="status_id" name="status_id">
                                    @foreach($status as $st)
                                        <option value="{{$st->id}}" <?php if(old('status_id',$data['status_id']) == $st->id){ echo 'selected'; } ?> >{{$st->name}}</option>
                                    @endforeach
                                </select>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect1">Role</label>
                                <select class="form-control" id="exampleSelect1" name="role_id">
                                    @foreach($user_roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_avatar">User Avatar</label>
                                <input class="form-control" type="file" name="user_avatar" />
                            </div>
                            <?php foreach($data['image'] as $img){ ?>
                            <li><a target="_blank" href="/storage/<?php echo $img['url'] ?>"><?php echo $img['name'] ?></a> </li>
                            <?php } ?>

                            <?php if(Auth::user()->is('Admin')){ ?>
                            <div class="form-group">
                                <label for="group_id">Group</label>
                                <select class="form-control" id="group_id" name="group_id">
                                    <option value="">Select Group</option>
                                    @foreach($user_groups as $group)
                                        <option value="{{$group->id}}" <?php if(in_array($group->id,$data['group'])){ echo 'selected'; } ?> >{{$group->name}} ({{$group->email}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <?php } ?>


                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>



    @endsection
    <script>
        var el = document.getElementById('loading');
        el.remove(); // Removes the div with the 'div-02' id
    </script>