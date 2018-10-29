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


    //    dd($data);
    ?>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="submitprcption">
                    <h4 class="card-title" style="margin-bottom: 10px; text-align: center;">Submit Your PRCPTION</h4>
                    <div class="pagedesc" align="center">
                        <p>Use this page to submit your own content that supports the exposure of cooperative, smiling people endeavors worldwide. We'll review it, get back to you if necessary, and it will become a part of the network!</p>
                        <p>To keep our community thriving, and so there are no misunderstandings should your submission be rejected, we kindly ask that you refresh yourself with our <a href="https://perceptiontravel.tv/user-guidelines">User Guidelines</a> and <a href="https://perceptiontravel.tv/terms-of-service">Terms of Service</a> before using this form.</p>
						<p><em>Should you encounter any errors we encourage you to <a href="https://perceptiontravel.tv/community-feedback">let us know</a>. Thanks!</em></p>
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
                    <form action="/user/post-upload-video" method="post" id="submit_content" enctype='multipart/form-data'>
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <input type="hidden" name="id" id="csrf-token" value="<?php echo uid($data['id']) ?>" />
                  
                        <div class="formdesctext">
                            <hr>
                            <strong>Your PRCPTION's Media</strong>
                            <em>Before we begin: is this media online already? Or do you need to be connected with an editor?</em>
                        </div>
						
					  <div class="form-group">
                    
                            <select class="form-control" id="submitted_footage" name="submitted_footage" onchange="displayVideoContentUpload()">
                                <option value="no" <?php if(old('submitted_footage',$data['submitted_footage']) == 'no'){ echo 'selected'; } ?> >My video is completed.</option>
                                <option value="yes" <?php if(old('submitted_footage',$data['submitted_footage']) == 'yes'){ echo 'selected'; } ?> >I need to submit my footage!</option>

                            </select>
                        </div>
						
                        <div class="form-group" id="submit_footage_form" <?php if(old('submitted_footage',$data['submitted_footage']) == 'yes'){ echo 'style="display:true"'; }else{ echo 'style="display:none"'; } ?> >
							    <div class="formdesctext">
                            <strong>Cool! PRCPTION Travel will be excited to work with you!</strong>
                            <em>Before you begin, please <a href="https://perceptiontravel.tv/share/" target="_blank">familiarize yourself with the steps required</a> for your video to be edited. The process is designed to split the responsibility of sharing inspiring and community-building stories around the world; please play your part by organizing your footage appropriately before submission.</em>
                        </div>
							
			
                            <label for="submit_footage_form">Upload Your Content (max 200MB each)</label>
                            <input class="form-control" type="file" name="content_set1[]" /> <a href="https://perceptiontravel.tv/share/#step1" target="_blank">Step 1</a>: Who? Where? When?
                            <input class="form-control" type="file" name="content_set2[]" /> <a href="https://perceptiontravel.tv/share/#step2" target="_blank">Step 2</a>: What's Up?
                            <input class="form-control" type="file" name="content_set3[]" /> <a href="https://perceptiontravel.tv/share/#step3" target="_blank">Step 3</a>: Why? How?
                        </div>
					
                        <div class="form-group">
                            <label for="exampleTextarea">If it's already completed, what is the video's URL? (YouTube, Vimeo, etc)</label>
                            <input type="text" class="form-control" aria-describedby="nameHelp" name="url" placeholder="URL" value="{{ old('url',$data['url']) }}">
                        </div>
						
                        <div class="form-group">
                            <label for="exampleTextarea">Comments, notes, or concerns about this PRCPTION that we (or the video editor) should know?</label>
                            <textarea type="text" class="form-control" aria-describedby="nameHelp" name="user_comment" placeholder="Additional Comments" rows="4">{{ old('user_comment',$data['user_comment']) }}</textarea>
                        </div>

                        <div class="form-group">
                            <?php if(Auth::user()->is('admin') || Auth::user()->is('group-admin') || Auth::user()->is('moderator')){ ?>
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                @foreach($status as $st)
                                    <option value="{{$st->id}}" <?php if(old('status',$data['status']) == $st->id){ echo 'selected'; } ?> >{{$st->name}}</option>
                                @endforeach
                            </select>
                            <?php } ?>
                        </div>

                </div>

						<div class="formdesctext">
                            <hr>
                           <strong>Media Info</strong>
                            <em>In this section, please fill in the basic details about your PRCPTION submission.</em>
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
                        <div class="formdesctext">
                            <hr>
                            <strong>Users Involved</strong>
                            <em>In this section, please choose the individuals and groups who have been a part of this PRCPTION. If no name appears, press 'enter' to add them as a shadow profile--don't worry, you can let them know and they can <a href="/claim-profile">claim their empty profile</a> whenever they want.</em>
                        </div>

                        <div class="form-group">
                            <label for="video_producer">Video Producer(s) (you may tag yourself)</label>
                            {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="video_producer" placeholder="Video Producer" value="{{ old('video_producer') }}">--}}
                            <select class="form-control multi-select2-with-tags" id="video_producer" multiple searchable="Search here.." name="video_producer[]" >
                                @foreach($user_list as $user)
                                    <option value="{{base64_encode($user->id)}}" <?php if(in_array($user->id, old('video_producer',$data['video_producer']))){ echo 'selected'; } ?> >{{$user->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="onscreen">Who's Onscreen? (individuals and/or organizations)</label>
                            {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="onscreen" placeholder="Onscreen" value="{{ old('onscreen') }}">--}}
                            <select class="form-control multi-select2-with-tags" id="onscreen" multiple searchable="Search here.." name="onscreen[]" >
                                @foreach($user_list as $user)
                                    <option value="{{base64_encode($user->id)}}" <?php if(in_array($user->id, old('onscreen',$data['onscreen']))){ echo 'selected'; } ?> >{{$user->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="co_creators">Co-Creator(s) (music credits, co-producers, etc.)</label>
                            {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="co_creators" placeholder="Co Creators" value="{{ old('co_creators') }}">--}}
                            <select class="form-control multi-select2-with-tags" multiple id="co_creators" searchable="Search here.." name="co_creators[]" >
                                @foreach($user_list as $user)
                                    <option value="{{base64_encode($user->id)}}" <?php if(in_array($user->id, old('co_creators',$data['co_creators']))){ echo 'selected'; } ?> >{{$user->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="groups">Community, Group, or Organization(s) Involved</label>
                            <select class="form-control multi-select2-with-tags" id="groups" multiple searchable="Search here.." name="groups[]" >
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

                        <div class="formdesctext">
                            <hr>
                            <strong>Visibility, Sorting, and Filters</strong>
                            <em>Who and how should people find this PRCPTION?</em>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">Privacy Settings: Who can find this PRCPTION?</label>
                            <select class="form-control" id="exampleSelect1" name="access_level_id">
                                <?php foreach($access_levels as $access){ ?>
                                <option value="{{$access->id}}" <?php if(old('access_level_id',$data['access_level_id']) == $access->id){ echo 'selected'; } ?> >{{$access->name}}</option>
                                <?php }?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Umbrella Category</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="0">Select</option>
                                @foreach($categories as $cat)
                                    <option value="{{$cat->id}}" <?php if($cat->id == old('category_id',$data['category_id'])){ echo 'selected'; } ?> >{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleSelect1">Greater Community Intention</label>
                            <select class="form-control multi-select2-max3" id="grater_community_intention_id" multiple name="grater_community_intention_ids[]">
                                @foreach($gci_tags as $m)
                                    <option value="{{$m['id']}}" <?php if(in_array($m['id'], old('grater_community_intention_ids',$data['grater_community_intention_ids']))){ echo 'selected'; } ?> >{{$m['tag']}}</option>
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
                            <input class="form-control" type="checkbox" id="is_exchange" <?php if(!empty(old('exchange',$data['exchange']))){ ?> checked <?php } ?> value="1" name="exchange" style="width: 50px;"/>
                            <label for="is_exchange"> Is there some sort of exchange being offered in this PRCPTION? (work trade, volunteer, etc)</label>
                        </div>
                        <div class="form-group" id="exchange_enabled" <?php if(empty(old('exchange',$data['exchange']))){ ?> style="visibility: hidden;" <?php } ?> >
                            <span class="exchange"><label for="is_exchange">Is this exchange a service or an opportunity being offered?</label>
                            <select class="form-control multi-select2" id="service_or_opportunity" name="service_or_opportunity">
                                <option value="0">Please choose one</option>
                                <option value="1" <?php if(old('exchange',$data['exchange']) == '1'){ echo 'selected'; } ?> >Service</option>
                                <option value="2" <?php if(old('exchange',$data['exchange']) == '2'){ echo 'selected'; } ?> >Opportunity</option>
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
                        {{--<div class="col-2"><input type="text" class="form-control" aria-describedby="nameHelp" id="lat_val" name="lat" placeholder="Lat" value="{{ old('lat') }}"></div>--}}
                        {{--<div class="col-2"><input type="text" class="form-control" aria-describedby="nameHelp" id="long_val" name="long" placeholder="Long" value="{{ old('long') }}"></div>--}}
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

						
                        <button type="button" onclick="submit_content()" class="btn btn-primary" style="background: #4214c7; border-color: #fff;">Submit PRCPTION</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

			hr { padding-top: 15px; padding-bottom: 10px; }
			
div.formdesctext strong { font-weight: 800; font-family: raleway; color: #2B0D82; font-size: 20px; margin: auto; display: block; padding-bottom: 10px; }
div.submitprcption { width: 50%; margin: auto; }

			.form-group {padding-top:10px;}
			
			a { color: #2B0D82 !important; }
			a:hover { color:#2b0bae !important; }
			
		</style>
@endsection
<script>
    //        var el = document.getElementById('loading');
    //        el.remove(); // Removes the div with the 'div-02' id
</script>