@extends('layouts.app_inside')

@section('content')
    <?php

    $data = array();
    $data['id'] = isset($user_data['id'])?$user_data['id']:'';
    $data['email'] = isset($user_data['email'])?$user_data['email']:'';
    $data['first_name'] = isset($user_data['first_name'])?$user_data['first_name']:'';
    $data['display_name'] = isset($user_data['display_name'])?$user_data['display_name']:'';
    $data['status_id'] = isset($user_data['status_id'])?$user_data['status_id']:'';
    $data['image'] = isset($user_data['image'])?$user_data['image']:array();
    $data['group'] = isset($user_data['groups'])?array_column($user_data['groups'],'group_id'):array();
    $data['user_acting_roles'] = isset($user_data['acting_roles'])?array_column($user_data['acting_roles'],'user_tag_id'):array();
    $data['location'] = isset($user_data['location'])?$user_data['location']:'';
    $data['role_id'] = isset($user_data['role_id'])?$user_data['role_id']:'';
    ?>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{__('backend.add_edit_user', ['name' => __('user')])}}</h4>
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
                                <label for="video_producer">{{__('backend.user_roles', ['name', __('user')])}}</label>
                                {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="video_producer" placeholder="Video Producer" value="{{ old('video_producer') }}">--}}
                                <select class="form-control multi-select2" id="video_producer" multiple searchable="Search here.." name="user_acting_roles[]" >
                                    @foreach($user_acting_role as $role)
                                        <option value="{{$role->id}}" <?php if(in_array($role->id, old('user_acting_roles',$data['user_acting_roles']))){ echo 'selected'; } ?> >{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <?php if(Auth::user()->is('admin')){ ?>
                                <label for="status_id">{{__('backend.status')}}</label>
                                <select class="form-control" id="status_id" name="status_id">
                                    @foreach($status as $st)
                                        <option value="{{$st->id}}" <?php if(old('status_id',$data['status_id']) == $st->id){ echo 'selected'; } ?> >{{$st->name}}</option>
                                    @endforeach
                                </select>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect1">{{__('backend.role')}}</label>
                                <select class="form-control" id="exampleSelect1" name="role_id">
                                    @foreach($user_roles as $role)
                                    <option <?php if($data['role_id'] == $role->id){ echo 'selected'; } ?> value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                                <div class="form-group">
                                    <label for="location">{{__('backend.location')}}</label>
                                    <input type="text" class="form-control" aria-describedby="nameHelp" name="location" placeholder="Location" value="{{ old('location',$data['location']) }}">
                                </div>

                            <div class="form-group">
                                <div id="upload-profile"></div>
                                <input type="hidden" id="imagebase64" name="profile_image">

                                <label for="user_avatar">{{__('backend.user_avatar', ['name' => __('user')])}}</label>
                                <input id="upload" class="form-control" type="file" name="user_avatar" />
                                <?php foreach($data['image'] as $img){ ?>
                                <a target="_blank" href="/storage/<?php echo $img['url'] ?>"><img width="150" src="/storage/<?php echo $img['url'] ?>" alt="Avatar" class="avatar"></a>
                            <?php } ?>
                            </div>


                            <?php if(Auth::user()->is('admin')){ ?>
                            <div class="form-group">
                                <label for="group_id">{{__('backend.group', ['name' => __('group')])}}</label>
                                <select class="form-control" id="group_id" name="group_id">
                                    <option value="">{{__('backend.select_group', ['name' => __('group')])}}</option>
                                    @foreach($user_groups as $group)
                                        <option value="{{$group->id}}" <?php if(in_array($group->id,$data['group'])){ echo 'selected'; } ?> >{{$group->name}} ({{$group->email}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <?php } ?>



                                <?php if($data['status_id'] == '4'){ ?>
                                <hr/>
                                <div class="form-group">
                                    <label for="profile_claim_request">Profile Claim Request</label>
                                    <table class="table">
                                        <tr>
                                            <th>Email</th>
                                            <th>Comment</th>
                                            <th>Requester</th>
                                            <th>Proof</th>
                                            <th>{{__('backend.associated_videos', ['name' => __('video')])}}</th>
                                        </tr>
                                        <?php foreach($claim_request as $request){
                                        $user_data = isset($request->requestedUser->id)? '@'.$request->requestedUser->display_name:'';
                                            ?>
                                        <tr>
                                            <td><?php echo $request['email'] ?>
                                            </td>
                                            <td><?php echo $request['comments'] ?>
                                            </td>
                                            <td><?php echo $user_data ?></td>
                                            <td>
                                                <?php foreach($request->proof as $proof){
                                                    if(isset($proof->id)){
                                                        echo '<br/><a href="/storage/'.$proof->url.'" >'.$proof->name.'</a>';
                                                    }
                                                } ?>
                                            </td>
                                            <td>
                                                <?php foreach($request->associatedContent as $content){
                                                    if(isset($content->content)){
                                                        echo '<br/><a href="/user/admin/video-edit/'.uid($content->content->id).'" >'.$content->content->title.'</a>';
                                                    }
                                                } ?>
                                            </td>
                                        </tr>

                                        <?php } ?>
                                    </table>

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