@extends('layouts.app_inside')

@section('content')
    <?php

    $data = array();
    $data['id'] = isset($user_data['id'])?$user_data['id']:'';
    $data['email'] = isset($user_data['email'])?$user_data['email']:'';
    $data['first_name'] = isset($user_data['first_name'])?$user_data['first_name']:'';
    $data['display_name'] = isset($user_data['display_name'])?$user_data['display_name']:'';
    $data['status_id'] = isset($user_data['status_id'])?$user_data['status_id']:'';
    $data['location'] = isset($user_data['location'])?$user_data['location']:'';
    $data['description'] = isset($user_data['description'])?$user_data['description']:'';
    $data['image'] = isset($user_data['image'])?$user_data['image']:array();
    $data['group'] = isset($user_data['groups'])?array_column($user_data['groups'],'group_id'):array();
    $data['user_acting_roles'] = isset($user_data['acting_roles'])?array_column($user_data['acting_roles'],'user_tag_id'):array();
    $data['access_level_id'] = isset($user_data['access_level_id'])?$user_data['access_level_id']:'';
    $data['grater_community_intention_ids'] = isset($user_data['gci'])?array_column($user_data['gci'],'user_tag_id'):array();
    $data['skills'] = isset($user_data['skill'])?array_column($user_data['skill'],'user_tag_id'):array();
//    dd($data['skills']);
    ?>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profile Settings <?php /* <button class="tag label label-info" onclick="openProfile(<?php echo $data['id'] ?>)">View my public profile</button> */ ?></h4>
                <div class="table-responsive">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
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
                        <form action="/user/user-profile-post" method="post" enctype='multipart/form-data'>
                            <?php if(!empty($data['id'])){?>
                            <input type="hidden" name="id" id="id" value="{{ uid($data['id']) }}" />
                            <?php }?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Display Name</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="display_name" placeholder="Display Name" value="{{ old('display_name',$data['display_name']) }}">
                            </div>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="email" placeholder="Email" value="{{ old('email',$data['email']) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="first_name" placeholder="First Name" value="{{ old('first_name',$data['first_name']) }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="password" placeholder="Password" value="{{ old('password') }}">
                            </div>

                            <div class="form-group">
                                <label for="video_producer">User Roles</label>
                                {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="video_producer" placeholder="Video Producer" value="{{ old('video_producer') }}">--}}
                                <select class="form-control multi-select2" id="video_producer" multiple searchable="Search here.." name="user_acting_roles[]" >
                                    @foreach($user_acting_role as $role)
                                        <option value="{{$role->id}}" <?php if(in_array($role->id, old('user_acting_roles',$data['user_acting_roles']))){ echo 'selected'; } ?> >{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <?php if(Auth::user()->is('admin')){ ?>
                            <div class="form-group">
                                <label for="status_id">Status</label>
                                <select class="form-control" id="status_id" name="status_id">
                                    @foreach($status as $st)
                                        <option value="{{$st->id}}" <?php if(old('status_id',$data['status_id']) == $st->id){ echo 'selected'; } ?> >{{$st->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <?php } ?>

                            <?php if(Auth::user()->is('admin')){ ?>
                            {{--<div class="form-group">--}}
                                {{--<label for="exampleSelect1">Role</label>--}}
                                {{--<select class="form-control" id="exampleSelect1" name="role_id">--}}
                                    {{--@foreach($user_roles as $role)--}}
                                    {{--<option value="{{$role->id}}">{{$role->name}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            <?php } ?>

                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" aria-describedby="nameHelp" name="location" placeholder="Location" value="{{ old('location',$data['location']) }}">
                                </div>

                                <div class="form-group">
                                    <label for="location">Description</label>
                                    <textarea type="text" class="form-control" rows="3" aria-describedby="nameHelp" name="description" placeholder="Description">{{ old('description',$data['description']) }}</textarea>
                                </div>





                            <div class="form-group">
                                {{--<input type="file" id="upload" value="Choose a file">--}}
                                <div id="upload-profile"></div>
                                <input type="hidden" id="imagebase64" name="profile_image">
                                {{--<a href="#" class="upload-result">Send</a>--}}



                                <label for="user_avatar">User Avatar</label>
                                <input id="upload" class="form-control" type="file" name="user_avatar" />
                                <?php foreach($data['image'] as $img){ ?>
                                <input type="hidden" value="/storage/<?php echo $img['url'] ?>" id="preset_image_path"/>
                                <a target="_blank" href="/storage/<?php echo $img['url'] ?>"><img src="/storage/<?php echo $img['url'] ?>" alt="Avatar" class="avatar profile_img_mini"></a>
                            <?php } ?>
                            </div>


                            <div class="form-group">
                                <label for="exampleSelect1">Privacy settings</label>
                                <select class="form-control" id="exampleSelect1" name="access_level_id">
                                    <?php foreach($access_levels as $access){ ?>
                                    <option value="{{$access->id}}" <?php if(old('access_level_id',$data['access_level_id']) == $access->id){ echo 'selected'; } ?> >{{$access->name}}</option>
                                    <?php }?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="grater_community_intention_id">Greater Community Intention</label>
                                <select class="form-control multi-select2-max3" id="grater_community_intention_id" multiple name="grater_community_intention_ids[]">
                                    @foreach($gci_tags as $m)
                                        <option value="{{$m['id']}}" <?php if(in_array($m['id'], old('grater_community_intention_ids',$data['grater_community_intention_ids']))){ echo 'selected'; } ?> >{{$m['tag']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="skills">Skills (add if not exist)</label>
                                <select class="form-control multi-select2-with-tags-max3" id="skills" multiple name="skills[]">
                                    @foreach($skill_tags as $m)
                                        <option value="{{base64_encode($m['id'])}}" <?php if(in_array($m['id'], old('skills',$data['skills']))){ echo 'selected'; } ?> >{{$m['tag']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <?php if(Auth::user()->is('admin')){ ?>
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

