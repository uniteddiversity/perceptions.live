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
    $data['captured_date'] = isset($video_data['captured_date'])?date_format(date_create($video_data['captured_date']), 'Y-m-d'):'';
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

    $data['id'] = isset($video_data['id'])?$video_data['id']:'';
    $data['language'] = isset($video_data['language'])?$video_data['language']:'en';

    //    dd($data);
    ?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card" style="box-shadow:none;">
        <div class="card-body">
            <div class="submitprcption">
                <div class="col-lg-4">
                    <div class="box purple" style="padding-top:40px;">
                        <h5>Submit your <b>PRCPTION</b></h5>
                        <p style="margin:0;">Use this page to submit your own content that supports the exposure of cooperative, smiling people endeavors worldwide. We'll review it, get back to you if necessary, and it will become a part of the network!</p>
                        <span class="mobile_show">Read More</span>
                        <div class="more" style="margin-top:20px;">
                            <p>To keep our community thriving, and so there are no misunderstandings should your submission be rejected, we kindly ask that you refresh yourself with our <a href="https://perceptiontravel.tv/user-guidelines">User Guidelines</a> and <a href="https://perceptiontravel.tv/terms-of-service">Terms of Service</a> before using this form.</p>
                            <hr />
                            <p style="color:#4214c7;"><b>Should you encounter any errors we encourage you to <a href="https://perceptiontravel.tv/community-feedback">let us know</a>. Thanks!</b></p>
                        </div>

                    </div>
                </div>

                <div class="pagedesc col-lg-8" style="float:right;">

                    <div class="breadcrumbs">
                        <div class="line"></div>
                        <ul>
                            <li class="active" id="st1">

                                <span style="left:55px;"><i class="far fa-file-video"></i><b>1</b></span>
                            </li>
                            <li id="st2">
                                <span style="left:40px;"><i class="fas fa-video"></i><b>2</b></span>
                            </li>
                            <li id="st3">

                                <span style="left:72px;"><i class="fas fa-users"></i><b>3</b></span>
                            </li>
<!--                            <li id="st4">-->
<!--                                <span style="left:100%; margin-left:-104px;"><i class="fas fa-filter"></i><b>4</b></span>-->
<!--                            </li>-->
                        </ul>
                    </div>

                    <div class="table-responsive">

                        @if ($errors->any())
                        <div style="padding:20px;background:rgb(248,248,248); border-bottom:2px solid #e6defc;">
                            <div class="alert alert-danger">
                                <ul>
                                    <?php //dd($errors) ?>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <form action="/user/post-upload-video" method="post" id="submit_content" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" name="id" id="csrf-token" value="<?php echo uid($data['id']) ?>" />


                            <div class="step" id="st1">
                                <!-- top text -->
                                <div class="text_top">
                                    <span><i class="far fa-file-video"></i><b>2</b></span>
                                    <h4>Media Info</h4>
                                    <p>In this section, please fill in the basic details about your PRCPTION submission.</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title of this PRCPTION</label>
                                    <input type="text" class="form-control" aria-describedby="nameHelp" name="title" placeholder="Title" value="{{ old('title',$data['title']) }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea">Location (City, Country)</label>
                                    <input type="text" class="form-control" id="leaflet_search_addr" aria-describedby="nameHelp" name="location" placeholder="Location" value="{{ old('location',$data['location']) }}">
                                </div>
                                <div class="form-group">
                                    <label for="video_id">Date of PRCPTION</label>
                                    <input type="text" autocomplete="off" class="form-control datepicker" aria-describedby="nameHelp" name="captured_date" placeholder="Captured Date" value="{{ old('captured_date',$data['captured_date']) }}">
                                </div>
                                {{--<div class="form-group">--}}
                                {{--<label for="exampleSelect1">Type</label>--}}
                                {{--<select class="form-control" id="exampleSelect1" name="type">--}}
                                {{--<option value="2">Youtube Video</option>--}}
                                {{--<option value="1">Uploaded Video</option>--}}
                                {{--</select>--}}
                                {{--</div>--}}

                                <div class="form-group">
                                    <label for="exampleTextarea">Brief Description</label>
                                    <textarea name="brief_description" class="form-control" id="exampleTextarea" rows="3">{{ old('brief_description',$data['brief_description']) }}</textarea>
                                </div>
                                {{--<div class="form-group">--}}
                                {{--<label for="description">Description</label>--}}
                                {{--<textarea name="description" class="form-control" id="description" rows="3">{{ old('description') }}</textarea>--}}
                                {{--</div>--}}
                                <!-- btns -->
                                <div class="btn_outer">
                                    <a href="#" class="btn"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                                    <a href="#" class="btn click" rel="st2">Next Step <i class="fas fa-long-arrow-alt-right"></i></a>
                                </div>
                                <!-- btns -->
                            </div>

                            <!-- step -->
                            <div class="step hidden" id="st2">
                                <!-- top text -->
                                <div class="text_top">
                                    <span><i class="fas fa-video"></i><b>3</b></span>
                                    <h4>Your <b>PRCPTION's</b> Media</h4>
                                    <p>Before we begin: is this media online already? Or do you need to be connected with an editor?</p>
                                </div>
                                <!-- top text -->

                                <div class="form-group">
                                    <div class="custom_select">
                                        <select class="form-control" id="submitted_footage" name="submitted_footage" onchange="displayVideoContentUpload()" placeholder="How is your video?">

                                            <option value="no" <?php if(old('submitted_footage',$data['submitted_footage'])=='no' ){ echo 'selected' ; } ?> >My video is completed.</option>
                                            <option id="2" value="yes" <?php if(old('submitted_footage',$data['submitted_footage'])=='yes' ){ echo 'selected' ; } ?> >I need to submit my footage!</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" id="submit_footage_form" <?php if(old('submitted_footage',$data['submitted_footage'])=='yes' ){ echo 'style="display:true"' ; }else{ echo 'style="display:none"' ; } ?> >
                                    <div class="tinfo">
                                        <p style="margin:0; color:rgb(81, 81, 81);">
                                            <b style="color:#4214c7;">Cool! PRCPTION Travel will be excited to work with you! :)</b>
                                            <br /><br />
                                            Before you begin, please <a href="https://perceptiontravel.tv/share/" target="_blank">familiarize yourself with the steps required</a> for your video to be edited. The process is designed to split the responsibility of sharing inspiring and community-building stories around the world; please play your part by organizing your footage appropriately before submission.</p>
                                    </div>


                                    <label for="submit_footage_form">Upload Your Content (max 200MB each)</label>

                                    <label>Who? Where? When?</label>
                                    <a class="question" href="#" data-toggle="modal" data-target="#step1">
                                        <i class="fas fa-question"></i></a>
                                    <div class="drag">
                                        <input class="form-control" type="file" name="content_set1[]" />
                                        <p>Drag your files here or click in this area.</p>
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>

                                    <label>What's Up?</label>
                                    <a class="question" href="#" data-toggle="modal" data-target="#step2"> <i class="fas fa-question"></i></a>
                                    <div class="drag">
                                        <input class="form-control" type="file" name="content_set2[]" />
                                        <p>Drag your files here or click in this area.</p>
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>


                                    <label>Why? How?</label>
                                    <a class="question" href="#" data-toggle="modal" data-target="#step3"> <i class="fas fa-question"></i></a>
                                    <div class="drag">
                                        <input class="form-control" type="file" name="content_set3[]" />
                                        <p>Drag your files here or click in this area.</p>
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>

                                </div>

                                <div class="form-group url">
                                    <label for="exampleTextarea">If it's already completed, what is the video's URL? (YouTube, Vimeo, etc)</label>
                                    <input type="text" class="form-control" aria-describedby="nameHelp" name="url" placeholder="URL" value="{{ old('url',$data['url']) }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleTextarea">Comments, notes, or concerns about this PRCPTION that we (or the video editor) should know?</label>
                                    <textarea type="text" class="form-control" aria-describedby="nameHelp" name="user_comment" placeholder="Additional Comments" rows="4">{{ old('user_comment',$data['user_comment']) }}</textarea>
                                </div>

                                <div class="form-group" style="padding:0 40px;">
                                    <?php if(Auth::user()->is('admin') && ( (Auth::user()->is('group-admin') || Auth::user()->is('moderator')) && !empty($data['id']) )){ ?>
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        @foreach($status as $st)
                                        <option value="{{$st->id}}" <?php if(old('status',$data['status'])==$st->id){ echo 'selected'; } ?> >{{$st->name}}</option>
                                        @endforeach
                                    </select>
                                    <?php } ?>
                                </div>
                                <!-- btns -->
                                <div class="btn_outer">
                                    <a href="#" class="btn click" rel="st1"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                                    <a href="#" class="btn click" rel="st3" style="float:right;">Next Step <i class="fas fa-long-arrow-alt-right"></i></a>
                                    <!-- submit button //hidden for DEMO ONLY -->
                                    <button type="button" onclick="submit_content()" class="btn dark" rel="st4" style="display:none;">Submit PRCPTION</button>
                                </div>
                                <!-- btns -->
                            </div>
                            <!-- step -->

                            <!-- step -->
                            <div class="step hidden" id="st3">
                                <!-- top text -->
                                <div class="text_top">
                                    <span><i class="fas fa-users"></i><b>1</b></span>
                                    <h4>Users Involved</h4>
                                    <p>In this section, please choose the individuals and groups who have been a part of this PRCPTION. If no name appears, press 'enter' to add them as a shadow profile--don't worry, you can let them know and they can <a href="/claim-profile">claim their empty profile</a> whenever they want.</p>
                                </div>

                                <div class="form-group">
                                    <label for="video_producer">Video Producer(s) (you may tag yourself)</label>
                                    {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="video_producer" placeholder="Video Producer" value="{{ old('video_producer') }}">--}}
                                    <select class="form-control multi-select2-with-tags" id="video_producer" multiple searchable="Search here.." name="video_producer[]">
                                        @foreach($user_list as $user)
                                        <option value="{{base64_encode($user->id)}}" <?php if(in_array($user->id, old('video_producer',$data['video_producer']))){ echo 'selected'; } ?> >{{$user->display_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="onscreen">Who's Onscreen? (individuals and/or organizations)</label>
                                    {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="onscreen" placeholder="Onscreen" value="{{ old('onscreen') }}">--}}
                                    <select class="form-control multi-select2-with-tags" id="onscreen" multiple searchable="Search here.." name="onscreen[]">
                                        @foreach($user_list as $user)
                                        <option value="{{base64_encode($user->id)}}" <?php if(in_array($user->id, old('onscreen',$data['onscreen']))){ echo 'selected'; } ?> >{{$user->display_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="co_creators">Co-Creator(s) (music credits, co-producers, etc.)</label>
                                    {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="co_creators" placeholder="Co Creators" value="{{ old('co_creators') }}">--}}
                                    <select class="form-control multi-select2-with-tags" multiple id="co_creators" searchable="Search here.." name="co_creators[]">
                                        @foreach($user_list as $user)
                                        <option value="{{base64_encode($user->id)}}" <?php if(in_array($user->id, old('co_creators',$data['co_creators']))){ echo 'selected'; } ?> >{{$user->display_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="groups">Community, Group, or Organization(s) Involved</label>
                                    <select class="form-control multi-select2-with-tags" id="groups" multiple searchable="Search here.." name="groups[]">
                                        @foreach($groups as $group)
                                        <option value="{{base64_encode($group->id)}}" <?php if(in_array($group->id, old('groups',$data['groups']))){ echo 'selected'; } ?> >{{$group->name}} ({{$group->email}})</option>
                                        @endforeach
                                    </select>
                                    {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="organization" placeholder="Organization" value="{{ old('organization') }}">--}}
                                </div>
                                <div class="form-group">
                                    <label for="learn_more_url">URL (web address) to learn more about the contents of this video: </label>
                                    <input type="text" class="form-control" aria-describedby="nameHelp" id="learn_more_url" name="learn_more_url" placeholder="Learn More Url" value="{{ old('learn_more_url',$data['learn_more_url']) }}">
                                </div>
                                <div class="form-group">
                                    @if(env('GOOGLE_RECAPTCHA_KEY'))
                                    <div class="g-recaptcha"
                                         data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                                    </div>
                                    @endif
                                </div>
                                <!-- btns -->
                                <div class="btn_outer">
                                    <a href="#" class="btn"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
<!--                                    <a href="#" class="btn click" rel="st4">Next Step <i class="fas fa-long-arrow-alt-right"></i></a>-->
                                    <button type="button" onclick="submit_content()" class="btn dark">Submit PRCPTION</button>
                                </div>
                                <!-- btns -->
                            </div>



                            <div class="step hidden" id="st4">
                                <!-- top text -->
                                <div class="text_top">
                                    <span><i class="fas fa-filter"></i><b>4</b></span>
                                    <h4>Visibility, Sorting, and Filters</h4>
                                    <p>Who and how should people find this PRCPTION?</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelect1">Privacy Settings: Who can find this PRCPTION?</label>
                                    <div class="custom_select">
                                        <select class="form-control" id="exampleSelect1" name="access_level_id">
                                            <?php foreach($access_levels as $access){ ?>
                                            <option value="{{$access->id}}" <?php if(old('access_level_id',$data['access_level_id'])==$access->id){ echo 'selected'; } ?> >{{$access->name}}</option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Umbrella Category</label>
                                    <div class="custom_select">
                                        <select class="form-control" id="category_id" name="category_id">
                                            <option value="0">Select</option>
                                            @foreach($categories as $cat)
                                            <option value="{{$cat->id}}" <?php if($cat->id == old('category_id',$data['category_id'])){ echo 'selected'; } ?> >{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelect1">Greater Community Intention</label>

                                    <select class="form-control multi-select2-max3" id="grater_community_intention_id" multiple name="grater_community_intention_ids[]">
                                        @foreach($gci_tags as $m)
                                        <option value="{{$m['id']}}" <?php if(in_array($m['id'], old('grater_community_intention_ids',$data['grater_community_intention_ids']))){ echo 'selected' ; } ?> >{{$m['tag']}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="primary_subject_tag">What's the Primary Subject of the PRCPTION?</label>
                                    <input type="text" class="form-control" aria-describedby="nameHelp" id="primary_subject_tag" name="primary_subject_tag" placeholder="Primary Subject Tag" value="{{ old('primary_subject_tag',$data['primary_subject_tag']) }}">
                                </div>
                                <div class="form-group">
                                    <label for="sorting_tags">Sorting Tags (like hashtags!)</label>
                                    <select class="form-control multi-select2-with-tags" id="sorting_tags" multiple name="sorting_tags[]">
                                        @foreach($sorting_tags as $tag)
                                        <option value="{{base64_encode($tag['id'])}}" <?php if(in_array($tag->id, old('sorting_tags',$data['sorting_tags']))){ echo 'selected'; } ?> >{{$tag['tag']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status">Language</label>
                                    <select class="form-control" id="language" name="language">
                                        @foreach($languages as $lng)
                                        <option value="{{$lng->code}}" <?php if(old('language',$data['language']) == $lng->code){ echo 'selected'; } ?> >{{$lng->language}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="checkbox" id="is_exchange" <?php if(!empty(old('exchange',$data['exchange']))){ ?> checked
                                    <?php } ?> value="1" name="exchange"/>
                                    <label class="exc" for="is_exchange"> Is there some sort of exchange being offered in this PRCPTION? (work trade, volunteer, etc)</label>
                                </div>
                                <div class="form-group" id="exchange_enabled" <?php if(empty(old('exchange',$data['exchange']))){ ?> style="visibility: hidden; padding:0 40px;"
                                    <?php } ?> >
                                    <span class="exchange"><label for="is_exchange">Is this exchange a service or an opportunity being offered?</label>
                                        <select class="form-control multi-select2" id="service_or_opportunity" name="service_or_opportunity">
                                            <option value="0">Please choose one</option>
                                            <option value="1" <?php if(old('exchange',$data['exchange'])=='1' ){ echo 'selected' ; } ?> >Service</option>
                                            <option value="2" <?php if(old('exchange',$data['exchange'])=='2' ){ echo 'selected' ; } ?> >Opportunity</option>
                                        </select></span>
                                </div>




                                {{--<div class="form-group">--}}
                                {{--<label for="exampleSelect1">Secondary Subject Tag</label>--}}
                                {{--<select class="form-control" id="secondary_subject_tag_id" name="secondary_subject_tag_id">--}}
                                {{--<option value="0">Select</option>--}}
                                {{--@foreach($meta_array['sst'] as $m)--}}
                                {{--<option value="{{$m['id']}}">{{$m['value']}}</option>--}}
                                {{--@endforeach--}}
                                {{--</select>--}}
                                {{--</div>--}}



                                {{--<div class="form-group">--}}
                                {{--<label for="exampleTextarea">Lat/Long</label>--}}
                                {{--<div class="row">--}}
                                {{--<div class="col-2"><input type="text" class="form-control" aria-describedby="nameHelp" id="lat_val" name="lat" placeholder="Lat" value="{{ old('lat') }}">
                            </div>--}}
                            {{--<div class="col-2"><input type="text" class="form-control" aria-describedby="nameHelp" id="long_val" name="long" placeholder="Long" value="{{ old('long') }}">
                    </div>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    <?php if(!empty($data['id']) && !Auth::user()->is('admin')){?>
                    <input type="hidden" value="0" id="lat_val" name="lat" value="{{ old('lat',$data['lat']) }}">
                    <input type="hidden" value="0" id="long_val" name="long" value="{{ old('long',$data['long']) }}">
                    <?php }elseif(Auth::user()->is('admin')){?>
                    <div class="form-group">
                        <label for="exampleTextarea">Lat/Long</label>
                        <div class="row">
                            <div class="col-2"><input type="text" class="form-control" aria-describedby="nameHelp" id="lat_val" name="lat" placeholder="Lat" value="{{ old('lat',$data['lat']) }}"></div>
                            <div class="col-2"><input type="text" class="form-control" aria-describedby="nameHelp" id="long_val" name="long" placeholder="Long" value="{{ old('long',$data['long']) }}"></div>
                        </div>
                    </div>
                    <?php }else{?>
                    <input type="hidden" value="0" id="lat_val" name="lat" value="{{ old('lat',$data['lat']) }}">
                    <input type="hidden" value="0" id="long_val" name="long" value="{{ old('long',$data['long']) }}">
                    <?php } ?>

                    {{--<div class="form-group">--}}
                    {{--<label for="exampleTextarea">Url Split</label>--}}
                    {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="url_split" placeholder="Url Split" value="{{ old('url_split') }}">--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                    {{--<label for="exampleTextarea">Full Embed Code</label>--}}
                    {{--<textarea name="full_embed_code" class="form-control" id="full_embed_code" rows="3">{{ old('full_embed_code') }}</textarea>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                    {{--<label for="video_id">Video Id</label>--}}
                    {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="video_id" placeholder="Video Id" value="{{ old('video_id') }}">--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                    {{--<label for="video_id">Video Id Old</label>--}}
                    {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="video_id_old" placeholder="Video Id Old" value="{{ old('video_id_old') }}">--}}
                    {{--</div>--}}



                    {{--<div class="form-group">--}}
                    {{--<label for="video_id">Video Date</label>--}}
                    {{--<input type="text" class="form-control datepicker" aria-describedby="nameHelp" name="video_date" placeholder="Video Date" value="{{ old('video_date',$data['video_date']) }}">--}}
                    {{--</div>--}}
                    <input type="hidden" value="<?php echo date('Y-m-d') ?>" name="video_date" />
                    {{--<div class="form-group">--}}
                    {{--<label for="exampleInputEmail1">Youtube URL</label>--}}
                    {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="url" placeholder="URL" value="{{ old('url') }}">--}}
                    {{--<small id="nameHelp" class="form-text text-muted">Youtube URL</small>--}}
                    {{--</div>--}}
                    {{--<fieldset class="form-group">--}}
                    {{--<legend>Location</legend>--}}
                    {{--<div class="form-check">--}}
                    {{--<label class="form-check-label">--}}
                    {{--<input type="text" class="form-check-input" name="lat" placeholder="Lat" value="{{ old('lat') }}">--}}
                    {{--</label>--}}
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                    {{--<label class="form-check-label">--}}
                    {{--<input type="text" class="form-check-input" name="long" placeholder="Long" value="{{ old('long') }}">--}}
                    {{--</label>--}}
                    {{--</div>--}}
                    {{--</fieldset>--}}



                    {{--users only items--}}
                    {{--<div class="form-group">--}}
                    {{--<label for="exampleSelect1">Roles</label>--}}
                    {{--<select class="form-control multi-select2" multiple id="c_roles" name="c_roles[]">--}}
                    {{--<option value="0">Select</option>--}}
                    {{--@foreach($meta_array['c-role'] as $m)--}}
                    {{--<option value="{{$m['id']}}">{{$m['value']}}</option>--}}
                    {{--@endforeach--}}
                    {{--</select>--}}
                    {{--</div>--}}
                    <!-- btns -->
                    <div class="btn_outer">
                        <a href="#" class="btn click" rel="st3"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                        <button type="button" onclick="submit_content()" class="btn dark">Submit PRCPTION</button>
                    </div>
                    <!-- btns -->
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal modal_steps fade" id="step1" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="position: relative;">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="modal-body">
                <h2><b>STEP 1:</b></h2>
                <h1>Who? Where? When?</h1>
                <h2 class="two">Introduce yourself as a relatable human being to the world.</h2>
                <p><b>Goal: approx. 1 minute</b></p>
                <p><b>REQUIRED:</b> 40-60 seconds introductory audio/video.

                    Introduce yourself, or the organization, or both.

                    Where is the subject of your video/story located?

                    Mention the date and the era of what's going on.</p>
                <p class="nomargin"><b>You may also include related photos and videos (audio will be cut).</b></p>

            </div>
            <div class="youtube">
                <iframe width="100%" height="260px" src="https://www.youtube.com/embed/jNF9IamqLmA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="text">
                <p><b>Video Example:</b></p>
                <p>showing <b>Artist Name</b> from the video <a href=#>Video Title Link</a></p>
            </div>
        </div>
    </div>
</div>

<div class="modal modal_steps fade" id="step2" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="position: relative;">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="modal-body">
                <h2><b>STEP 2:</b></h2>
                <h1>What’s up?</h1>
                <h2 class="two">Present information to the world via your perspective.</h2>
                <p><b>Goal: 1 minute 30 seconds</b></p>
                <p style="margin-bottom:0;"><b>REQUIRED:</b> 60-90 seconds of information-packed content, including vocal explanations and visuals of "what's up."

                    What would you like to share? Explain, describe, present, or sell it to us. It can be anything!<br /> <br /><b>Some examples:</b></p>
                <p class="bullets">
                    <i class="fas fa-bullseye"></i> your words, an opinion or testimony <br />
                    <i class="fas fa-bullseye"></i> an activity or event<br />
                    <i class="fas fa-bullseye"></i> a cause or mission that you support
                </p>
                <p class="nomargin"><b>Please include several photos and/or video clips of "what's up."</b></p>

            </div>
            <div class="youtube">
                <iframe width="100%" height="260px" src="https://www.youtube.com/embed/jNF9IamqLmA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="text">
                <p><b>Video Example:</b></p>
                <p>showing <b>Artist Name</b> from the video <a href=#>Video Title Link</a></p>
            </div>
        </div>
    </div>
</div>

<div class="modal modal_steps fade" id="step3" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="position: relative;">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="modal-body">
                <h2><b>STEP 3:</b></h2>
                <h1>Why? How?</h1>
                <h2 class="two">Engage the world with your passion!</h2>
                <p><b>Goal: 1 minute</b></p>
                <p style="margin-bottom:0;">
                    <b>REQUIRED: A conclusion and call-to-action of some sort.</b><br /><br />
                    Why are you creating this video?

                    What should the audience come away with after watching?

                    How can the viewer participate?

                    Your words might inspire someone, so be mindful of how you present your message!
                </p>>
                <p class="nomargin"><b>Once again, you are free to include more photos and videos to help tell your story.</b></p>

            </div>
            <div class="youtube">
                <iframe width="100%" height="260px" src="https://www.youtube.com/embed/jNF9IamqLmA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="text">
                <p><b>Video Example:</b></p>
                <p>showing <b>Artist Name</b> from the video <a href=#>Video Title Link</a></p>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
        $('.drag input').change(function() {
            $(this).parent().find('p').text(this.files.length + " file(s) selected");
        });
    });

</script>
<script>
    $('#submitted_footage').change(function() {
        if ($("option#2:selected").length) {
            // do something here
            $('.url').addClass('hidden');
        } else {

            $('.url').removeClass('hidden');
        }
    })

</script>
<!-- script for mobile "show more" text -->
<script>
    $('.card .box .mobile_show').on('click', function(e) {
        $('.more').toggleClass("active"); //you can list several class names 
        $(this).toggleClass("hidden"); //you can list several class names 
        e.preventDefault();
    });

</script>
<!-- script for steps to toggle them hide/activate -->
<!-- maybe add script to verify if input fields are completed before going to next step -->
<script>
    $('.table-responsive .btn_outer .btn.click').on('click', function(e) {
        $(this).parent().parent().toggleClass("hidden"); //you can list several class names 
        var num = $(this).attr('rel');
        $('.step' + '#' + num).removeClass("hidden");
        $('.breadcrumbs ul li').removeClass("active");
        $('.breadcrumbs ul li' + '#' + num).addClass("active");
        e.preventDefault();
    });
    $('.table-responsive .btn_outer button').on('click', function(e) {
        $(this).parent().parent().toggleClass("hidden"); //you can list several class names 
        var num = $(this).attr('rel');
        $('.step' + '#' + num).removeClass("hidden");
        $('.breadcrumbs ul li').removeClass("active");
        $('.breadcrumbs ul li' + '#' + num).addClass("active");
        e.preventDefault();
    });

</script>


<style>
    .pagedesc {
        font-size: 20px;
        font-family: questrial;
        line-height: 1em;
        padding-bottom: 20px;
    }

    div.formdesctext {
        color: slategray;
        font-size: 14px;
        font-style: italic;
        font-family: questrial;
        line-height: 1em;
        padding-bottom: 20px;
    }

    hr {
        padding-top: 15px;
        padding-bottom: 10px;
    }

    div.formdesctext strong {
        font-weight: 800;
        color: #2B0D82;
        font-size: 20px;
        margin: auto;
        display: block;
        padding-bottom: 10px;
    }

    div.submitprcption {
        width: 50%;
        margin: auto;
    }

    .form-group {
        padding-top: 10px;
    }

    a {
        color: #2B0D82 !important;
    }

    a:hover {
        color: #2b0bae !important;
    }

</style>
@endsection
<script>
    //        var el = document.getElementById('loading');
    //        el.remove(); // Removes the div with the 'div-02' id

</script>
