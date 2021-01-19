@extends('layouts.app_inside')

@section('content')
    <?php

    $data = array();
    $data['title'] = isset($video_data['title'])?$video_data['title']:'';
    $data['access_level_id'] = isset($video_data['access_level_id'])?$video_data['access_level_id']:'';
    $data['brief_description'] = isset($video_data['brief_description'])?$video_data['brief_description']:'';


    $data['video_producer'] = isset($video_data['video_producer'])?array_column($video_data['video_producer'],'user_id'):array();
    $data['onscreen'] = isset($video_data['on_screen'])?array_column($video_data['on_screen'],'user_id'):array();
    $data['co_creators'] = isset($video_data['co_creators'])?array_column($video_data['co_creators'],'user_id'):array();
    $data['groups'] = isset($video_data['groups'])?array_column($video_data['groups'],'group_id'):array();

    $data['learn_more_url'] = isset($video_data['learn_more_url'])?$video_data['learn_more_url']:'';
    $data['category_id'] = isset($video_data['category_id'])?$video_data['category_id']:'';
//    $data['grater_community_intention_id'] = isset($video_data['grater_community_intention_id'])?$video_data['grater_community_intention_id']:'';
    $data['primary_subject_tag'] = isset($video_data['primary_subject_tag'])?$video_data['primary_subject_tag']:'';
    $data['submitted_footage'] = isset($video_data['submitted_footage'])?$video_data['submitted_footage']:'';
    $data['location'] = isset($video_data['location'])?$video_data['location']:'';
    $data['url'] = isset($video_data['url'])?$video_data['url']:'';
    $data['captured_date'] = isset($video_data['captured_date'])?date_format(date_create($video_data['captured_date']), 'd-m-Y'):'';
    $data['video_date'] = isset($video_data['video_date'])?date_format(date_create($video_data['video_date']), 'Y-m-d'):'';


    $data['exchange'] = isset($video_data['exchange'][0])?$video_data['exchange'][0]['content_tag_id']:'0';

    $data['service_or_opportunity'] = isset($video_data['service_or_opportunity'])?$video_data['service_or_opportunity']:'';
    $data['sorting_tags'] = isset($video_data['sorting_tags'])?array_column($video_data['sorting_tags'],'content_tag_id'):array();
    $data['grater_community_intention_ids'] = isset($video_data['gci_tags'])?array_column($video_data['gci_tags'],'content_tag_id'):array();

    $data['user_comment'] = isset($video_data['user_comment'])?$video_data['user_comment']:'';
    $data['lat'] = isset($video_data['lat'])?$video_data['lat']:'';
    $data['long'] = isset($video_data['long'])?$video_data['long']:'';

    $data['content_set1'] = isset($video_data['content_set1'])?$video_data['content_set1']:array();
    $data['content_set2'] = isset($video_data['content_set2'])?$video_data['content_set2']:array();
    $data['content_set3'] = isset($video_data['content_set3'])?$video_data['content_set3']:array();
    $data['status'] = isset($video_data['status'])?$video_data['status']:'';
    $data['language'] = isset($video_data['language'])?$video_data['language']:'en';

    $data['id'] = isset($video_data['id'])?$video_data['id']:'';

//dd($data);
//    dd($data['service_or_opportunity']);
    ?>
    <div class="col-lg-12 grid-margin stretch-card" id="user_content_add">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php if(!empty($data['id'])){ ?>{{__('backend.edit_video', ['name' => __('content')])}}<?php }else{ ?>{{__('backend.add_video', ['name' => __('content')])}}<?php } ?> <span style="font-size: 12px;"><?php if(!empty($data['id'])){ ?><a class="btn btn-primary btn-xs" onclick="openVideo('<?php echo $data['id'] ?>')" href="#" >{{__('backend.video_profile', ['name' => __('content')])}}</a><?php } ?></span></h4>
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
                        <form action="/user/admin/post-upload-video" method="post" id="submit_content" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" name="id" id="csrf-token" value="<?php echo uid($data['id']) ?>" />
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('backend.video_title')}}</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="title" placeholder="Title" value="{{ old('title',$data['title']) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea">{{__('backend.location')}}</label>
                                <input type="text" class="form-control" id="leaflet_search_addr" aria-describedby="nameHelp" name="location" placeholder="Location" value="{{ old('location',$data['location']) }}">
                            </div>
                            <div class="form-group">
                                <label for="video_id">{{__('backend.captured_date')}}</label>
                                <input type="text" autocomplete="off" class="form-control datepicker" aria-describedby="nameHelp" name="captured_date" placeholder="Captured Date" value="{{ old('captured_date',$data['captured_date']) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect1">{{__('backend.access_level')}}</label>
                                <select class="form-control" id="exampleSelect1" name="access_level_id">
                                    <?php foreach($access_levels as $access){ ?>
                                        <option value="{{$access->id}}" <?php if(old('access_level_id',$data['access_level_id']) == $access->id){ echo 'selected'; } ?> >{{$access->name}}</option>
                                    <?php }?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleTextarea">{{__('backend.brief_description')}}</label>
                                <textarea name="brief_description" class="form-control" id="exampleTextarea" rows="3">{{ old('brief_description',$data['brief_description']) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="video_producer">{{__('backend.producer_or_display_name', ['name1'=>__('content')])}}</label>
                                {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="video_producer" placeholder="Video Producer" value="{{ old('video_producer') }}">--}}
                                <select class="form-control multi-select2-with-tags" id="video_producer" multiple searchable="Search here.." name="video_producer[]" >
                                    @foreach($user_list as $user)
                                    <option value="{{base64_encode($user->id)}}" <?php if(in_array($user->id, old('video_producer',$data['video_producer']))){ echo 'selected'; } ?> >{{$user->display_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="onscreen">{{__('backend.on_screen_or_display_name')}}</label>
                                {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="onscreen" placeholder="Onscreen" value="{{ old('onscreen') }}">--}}
                                <select class="form-control multi-select2-with-tags" id="onscreen" multiple searchable="Search here.." name="onscreen[]" >
                                    @foreach($user_list as $user)
                                    <option value="{{base64_encode($user->id)}}" <?php if(in_array($user->id, old('onscreen',$data['onscreen']))){ echo 'selected'; } ?> >{{$user->display_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="co_creators">{{__('backend.co_creator_or_display_name')}}</label>
                                {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="co_creators" placeholder="Co Creators" value="{{ old('co_creators') }}">--}}
                                <select class="form-control multi-select2-with-tags" multiple id="co_creators" searchable="Search here.." name="co_creators[]" >
                                    @foreach($user_list as $user)
                                    <option value="{{base64_encode($user->id)}}" <?php if(in_array($user->id, old('co_creators',$data['co_creators']))){ echo 'selected'; } ?> >{{$user->display_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="groups">{{__('backend.organizations_groups', ['name' => __('group')])}}</label>
                                <select class="form-control multi-select2-with-tags" id="groups" multiple searchable="Search here.." name="groups[]" >
                                    @foreach($groups as $group)
                                        <option value="{{base64_encode($group->id)}}" <?php if(in_array($group->id, old('groups',$data['groups']))){ echo 'selected'; } ?> >{{$group->name}} ({{$group->email}})</option>
                                    @endforeach
                                </select>
                                {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="organization" placeholder="Organization" value="{{ old('organization') }}">--}}
                            </div>
                            <div class="form-group">
                                <label for="learn_more_url">{{__('backend.learn_more_url')}}</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" id="learn_more_url" name="learn_more_url" placeholder="Learn More Url" value="{{ old('learn_more_url',$data['learn_more_url']) }}">
                            </div>




                            <div class="form-group">
                                <label for="category_id">{{__('backend.category')}}</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    <option value="0">{{__('backend.select')}}</option>
                                    @foreach($categories as $cat)
                                    <option value="{{$cat->id}}" <?php if($cat->id == old('category_id',$data['category_id'])){ echo 'selected'; } ?> >{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleSelect1">{{__('backend.grater_community_intention')}}</label>
                                <select class="form-control multi-select2-max3" id="grater_community_intention_id" multiple name="grater_community_intention_ids[]">
                                    @foreach($gci_tags as $m)
                                    <option value="{{$m['id']}}" <?php if(in_array($m['id'], old('grater_community_intention_ids',$data['grater_community_intention_ids']))){ echo 'selected'; } ?> >{{$m['tag']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="primary_subject_tag">{{__('backend.primary_subject_tag', ['limit' => 40])}}</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" id="primary_subject_tag" name="primary_subject_tag" placeholder="Primary Subject Tag" value="{{ old('primary_subject_tag',$data['primary_subject_tag']) }}">
                            </div>
                            <div class="form-group">
                                <label for="sorting_tags">{{__('backend.sorting_tags')}}</label>
                                <select class="form-control multi-select2-with-tags" id="sorting_tags" multiple name="sorting_tags[]">
                                    @foreach($sorting_tags as $tag)
                                        <option value="{{base64_encode($tag['id'])}}" <?php if(in_array($tag->id, old('sorting_tags',$data['sorting_tags']))){ echo 'selected'; } ?> >{{$tag['tag']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <?php if(!empty($data['id']) && !Auth::user()->is('admin')){?>
                                <input type="hidden" value="0" id="lat_val" name="lat" value="{{ old('lat',$data['lat']) }}">
                                <input type="hidden" value="0" id="long_val" name="long" value="{{ old('long',$data['long']) }}">
                            <?php }elseif(Auth::user()->is('admin')){?>
                            <div class="form-group">
                                <label for="exampleTextarea">{{__('backend.lat_long')}}</label>
                                <div class="row">
                                    <div class="col-2"><input type="text" class="form-control" aria-describedby="nameHelp" id="lat_val" name="lat" placeholder="Lat" value="{{ old('lat',$data['lat']) }}"></div>
                                    <div class="col-2"><input type="text" class="form-control" aria-describedby="nameHelp" id="long_val" name="long" placeholder="Long" value="{{ old('long',$data['long']) }}"></div>
                                </div>
                            </div>
                            <?php }else{?>
                                <input type="hidden" value="0" id="lat_val" name="lat" value="{{ old('lat',$data['lat']) }}">
                                <input type="hidden" value="0" id="long_val" name="long" value="{{ old('long',$data['long']) }}">
                            <?php } ?>


                            <div class="form-group">
                                <label for="exampleTextarea">{{__('backend.url')}}</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="url" placeholder="URL" value="{{ old('url',$data['url']) }}">
                            </div>
                            <input type="hidden" value="<?php echo date('Y-m-d') ?>" name="video_date" />

                            <div class="form-group">
                                <label for="is_exchange">{{__('backend.exchange_yes_no')}}</label>
                                <input class="form-control" type="checkbox" id="is_exchange" <?php if(!empty(old('exchange',$data['exchange']))){ ?> checked <?php } ?> value="1" name="exchange" style="width: 50px;"/>
                            </div>
                            <div class="form-group" id="exchange_enabled" <?php if(empty(old('exchange',$data['exchange']))){ ?> style="visibility: hidden;" <?php } ?> >
                                <label for="is_exchange">{{__('backend.exchange_yes_ser_opp')}}</label>
                                <select class="form-control multi-select2" id="service_or_opportunity" name="service_or_opportunity">
                                    <option value="0">Select</option>
                                    <option value="1" <?php if(old('exchange',$data['exchange']) == '1'){ echo 'selected'; } ?> >{{__('backend.service')}}</option>
                                    <option value="2" <?php if(old('exchange',$data['exchange']) == '2'){ echo 'selected'; } ?> >{{__('backend.opportunity')}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleSelect1">{{__('backend.submitted_footage')}}</label>
                                <select class="form-control" id="submitted_footage" name="submitted_footage">
                                    <option value="yes" <?php if(old('submitted_footage',$data['submitted_footage']) == 'yes'){ echo 'selected'; } ?> >{{__('backend.yes')}}</option>
                                    <option value="no" <?php if(old('submitted_footage',$data['submitted_footage']) == 'no'){ echo 'selected'; } ?> >{{__('backend.no')}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="accept_tos">{{__('backend.video_content')}}</label>
                                <input class="form-control" type="file" name="content_set1[]" />{{__('backend.content_set', ['name1' => '1'])}}

                                <?php
                                if(isset($uploaded_files)){
                                    echo '<span class="downlod-content-files">';
                                    foreach($uploaded_files as $file){
                                        if($file['submission_type'] == 'video-s-1')
                                            echo '<br/><a href="/storage/'.$file['url'].'" target="_blank" />'.$file['url'].'</a>';
                                    }
                                    echo '</span>';
                                }
                                ?>

                                <input class="form-control" type="file" name="content_set2[]" />{{__('backend.content_set', ['name1' => '2'])}}
                                <?php
                                if(isset($uploaded_files)){
                                    echo '<span class="downlod-content-files">';
                                    foreach($uploaded_files as $file){
                                        if($file['submission_type'] == 'video-s-2')
                                            echo '<br/><a href="/storage/'.$file['url'].'" target="_blank" />'.$file['url'].'</a>';
                                    }
                                    echo '</span>';
                                }
                                ?>

                                <input class="form-control" type="file" name="content_set3[]" />{{__('backend.content_set', ['name1' => '3'])}}

                                <?php
                                if(isset($uploaded_files)){
                                    echo '<span class="downlod-content-files">';
                                    foreach($uploaded_files as $file){
                                        if($file['submission_type'] == 'video-s-3')
                                            echo '<br/><a href="/storage/'.$file['url'].'" target="_blank" />'.$file['url'].'</a>';
                                    }
                                    echo '</span>';
                                }

                                ?>
                            </div>

                            <div class="form-group">
                                <label for="exampleTextarea">{{__('backend.additional_comments')}}</label>
                                <textarea type="text" class="form-control" aria-describedby="nameHelp" name="user_comment" placeholder="Additional Comments" rows="4">{{ old('user_comment',$data['user_comment']) }}</textarea>
                            </div>

                            <div class="form-group">
                                <?php if(Auth::user()->is('admin') || Auth::user()->is('group-admin') || Auth::user()->is('moderator')){ ?>
                                <label for="status">{{__('backend.status')}}</label>
                                <select class="form-control" id="status" name="status">
                                    @foreach($status as $st)
                                        <option value="{{$st->id}}" <?php if(old('status',$data['status']) == $st->id){ echo 'selected'; } ?> >{{$st->name}}</option>
                                    @endforeach
                                </select>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label for="status">{{__('backend.language')}}</label>
                                <select class="form-control" id="language" name="language">
                                    @foreach($languages as $lng)
                                    <option value="{{$lng->code}}" <?php if(old('language',$data['language']) == $lng->code){ echo 'selected'; } ?> >{{$lng->language}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="button" onclick="submit_content()" class="btn btn-primary">{{__('backend.submit')}}</button>
                        </form>
                </div>
            </div>
        </div>
    </div>


    @endsection
    <script>
//        var el = document.getElementById('loading');
//        el.remove(); // Removes the div with the 'div-02' id
    </script>