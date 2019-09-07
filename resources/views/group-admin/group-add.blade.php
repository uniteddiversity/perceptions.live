@extends('layouts.app_inside')

@section('content')
    <?php
    $data['greeting_message_to_community'] = isset($group['greeting_message_to_community'])?$group['greeting_message_to_community']:'';
    $data['name'] = isset($group['name'])?$group['name']:'';
    $data['description'] = isset($group['description'])?$group['description']:'';
    $data['current_mission'] = isset($group['current_mission'])?$group['current_mission']:'';
    $data['experience_knowledge_interests'] = isset($group['experience_knowledge_interests'])?$group['experience_knowledge_interests']:'';
    $data['default_location'] = isset($group['default_location'])?$group['default_location']:'';
    $data['category_id'] = isset($group['category_id'])?$group['category_id']:'';
    $data['learn_more_url'] = isset($group['learn_more_url'])?$group['learn_more_url']:'';

    $data['contact_user_id'] = isset($group['contact_user_id'])?$group['contact_user_id']:'';
    $data['status'] = isset($group['status'])?$group['status']:'';
    $data['proof_images'] = isset($group['proofOfGroup'])?$group['proofOfGroup']:array();
    $data['avatar_images'] = isset($group['groupAvatar'])?$group['groupAvatar']:array();
    $data['id'] = isset($group['id'])?$group['id']:'';
    $group['experience_kno'] = isset($group['experienceKnowledge'])?$group['experienceKnowledge']->toArray():[];
    $data['experience_kno'] = isset($group['experience_kno'])?array_column($group['experience_kno'],'group_tag_id'):array();
    $data['group_acting_roles'] = isset($group['actingRoles'])?array_column(($group['actingRoles'])->toArray(),'group_tag_id'):array();

//    dd($data);
    ?>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Group Add/Edit</h4>
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
                        <form action="/user/group-admin/post-group-add" method="post" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <?php if(!empty($data['id'])){ ?>
                            <input type="hidden" name="id" id="id" value="{{ uid($data['id']) }}" />
                            <?php } ?>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Greeting Message to PRCPTION community</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="greeting_message_to_community" placeholder="Greeting Message to PRCPTION community" value="{{ old('greeting_message_to_community',$data['greeting_message_to_community']) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="name" placeholder="Name" value="{{ old('name',$data['name']) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea class="form-control" placeholder="Description" rows="5" name="description">{{ old('description',$data['description']) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Current Mission</label>
                                <textarea class="form-control" placeholder="Current Mission" rows="5" name="current_mission">{{ old('current_mission',$data['current_mission']) }}</textarea>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<label for="exampleInputEmail1">Experience Knowledge Interests</label>--}}
                                {{--<textarea class="form-control" placeholder="Experience Knowledge Interests" rows="5" name="experience_knowledge_interests">{{ old('experience_knowledge_interests',$data['experience_knowledge_interests']) }}</textarea>--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label for="video_producer">Group Roles</label>
                                {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="video_producer" placeholder="Video Producer" value="{{ old('video_producer') }}">--}}
                                <select class="form-control multi-select2" id="group_roles" multiple searchable="Search here.." name="group_acting_roles[]" >
                                    @foreach($user_acting_role as $role)
                                        <option value="{{$role->id}}" <?php if(in_array($role->id, old('group_acting_roles',$data['group_acting_roles']))){ echo 'selected'; } ?> >{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="skills">Experience knowledge interests (add if not exist)</label>
                                <select class="form-control multi-select2-with-tags-max5" id="experience_kno" multiple name="experience_kno[]">
                                    @foreach($experience_knowledge_tags as $m)
                                        <option value="{{base64_encode($m['id'])}}" <?php if(in_array($m['id'], old('experience_kno',$data['experience_kno']))){ echo 'selected'; } ?> >{{$m['tag']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Default Location</label>
                                <input type="text" class="form-control" placeholder="Default Location" aria-describedby="nameHelp" name="default_location" placeholder="First Name" value="{{ old('default_location',$data['default_location']) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Learn More Url</label>
                                <input type="text" class="form-control" placeholder="Learn More Url" aria-describedby="nameHelp" name="learn_more_url" placeholder="Learn More Url" value="{{ old('learn_more_url',$data['learn_more_url']) }}">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control  multi-select2" id="category_id" name="category_id">
                                    <option value="">Select</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" <?php if(old('category_id',$data['category_id']) == $category->id){ echo 'selected'; } ?>>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect1">Contact User</label>
                                <select class="form-control  multi-select2" id="exampleSelect1" name="contact_user_id">
                                    <option value="">Select</option>
                                    @foreach($user_list as $user)
                                    <option value="{{$user->id}}" <?php if(old('contact_user_id',$data['contact_user_id']) == $user->id){ echo 'selected'; } ?>>{{$user->first_name}} ({{$user->email}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="accept_tos">Proof of Group Involvement</label>
                                <input class="form-control" type="file" name="proof_of_group[]" />
                                <input class="form-control" type="file" name="proof_of_group[]" />
                                <input class="form-control" type="file" name="proof_of_group[]" />

                                <?php foreach($data['proof_images'] as $img){ ?>
                                    <li><a target="_blank" href="/storage/<?php echo $img->url ?>"><?php echo $img->name ?></a> </li>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="accept_tos">Group Avatar</label>
                                <input class="form-control" type="file" name="group_avatar" />
                            </div>

                            <?php foreach($data['avatar_images'] as $img){ ?>
                            <li><a target="_blank" href="/storage/<?php echo $img->url ?>"><?php echo $img->name ?></a> </li>
                            <?php } ?>

                            <?php if( !empty($data['id']) ){ ?>
                            <div class="form-group">
                                <label for="accept_tos">Accept Terms of Service?</label>
                                &nbsp;&nbsp;<input type="checkbox" name="accept_tos" id="accept_tos" value="1" checked />
                            </div>
                            <?php } ?>


                            <div class="form-group">
                                <?php if(Auth::user()->is('admin')){ ?>
                                <label for="status">Change Status</label>
                                <select class="form-control" id="status" name="status">
                                    @foreach($status as $st)
                                        <option value="{{$st->id}}" <?php if(old('status',$data['status']) == $st->id){ echo 'selected'; } ?>>{{$st->name}}</option>
                                    @endforeach
                                </select>
                                <?php } ?>
                            </div>

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