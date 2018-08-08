@extends('layouts.app_inside')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Video</h4>
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
                        <form action="/user/post-upload-video" method="post" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="title" placeholder="Title" value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect1">Access Level</label>
                                <select class="form-control" id="exampleSelect1" name="access_level_id">
                                    <option value="1">Public</option>
                                    <option value="2">Only Registered</option>
                                    <option value="3">Private</option>
                                </select>
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
                                <textarea name="brief_description" class="form-control" id="exampleTextarea" rows="3">{{ old('brief_description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" rows="3">{{ old('description') }}</textarea>
                            </div>


                            <div class="form-group">
                                <label for="exampleTextarea">Video Producer(s)</label>
                                {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="video_producer" placeholder="Video Producer" value="{{ old('video_producer') }}">--}}
                                <select class="form-control multi-select2" multiple searchable="Search here.." name="video_producer[]" >
                                    @foreach($user_list as $user)
                                    <option value="{{$user->id}}">{{$user->first_name}} ({{$user->email}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea">Onscreen</label>
                                {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="onscreen" placeholder="Onscreen" value="{{ old('onscreen') }}">--}}
                                <select class="form-control multi-select2" multiple searchable="Search here.." name="onscreen[]" >
                                    @foreach($user_list as $user)
                                    <option value="{{$user->id}}">{{$user->first_name}} ({{$user->email}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea">Co Creator(s)</label>
                                {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="co_creators" placeholder="Co Creators" value="{{ old('co_creators') }}">--}}
                                <select class="form-control multi-select2" multiple searchable="Search here.." name="co_creators[]" >
                                    @foreach($user_list as $user)
                                    <option value="{{$user->id}}">{{$user->first_name}} ({{$user->email}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea">Organization(s)/Group(s)</label>
                                <select class="form-control multi-select2" multiple searchable="Search here.." name="groups[]" >
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}} ({{$group->email}})</option>
                                    @endforeach
                                </select>
                                {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="organization" placeholder="Organization" value="{{ old('organization') }}">--}}
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea">Learn More Url</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="learn_more_url" placeholder="Learn More Url" value="{{ old('learn_more_url') }}">
                            </div>




                            <div class="form-group">
                                <label for="exampleSelect1">Category</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    <option value="0">Select</option>
                                    @foreach($categories as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleSelect1">Greater Community Intention</label>
                                <select class="form-control" id="grater_community_intention_id" name="grater_community_intention_id">
                                    <option value="0">Select</option>
                                    @foreach($meta_array['gci'] as $m)
                                    <option value="{{$m['id']}}">{{$m['value']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect1">Primary Subject Tag (40 max)</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="primary_subject_tag_id" placeholder="Primary Subject Tag" value="{{ old('primary_subject_tag_id') }}">
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

                            <div class="form-group">
                                <label for="exampleSelect1">Submitted Footage</label>
                                <select class="form-control" id="submitted_footage" name="submitted_footage">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea">Location</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="location" placeholder="Location" value="{{ old('location') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea">Lat/Long</label>
                                <div class="row">
                                    <div class="col-2"><input type="text" class="form-control" aria-describedby="nameHelp" name="lat" placeholder="Lat" value="{{ old('lat') }}"></div>
                                    <div class="col-2"><input type="text" class="form-control" aria-describedby="nameHelp" name="long" placeholder="Long" value="{{ old('long') }}"></div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="exampleTextarea">URL</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="url" placeholder="URL" value="{{ old('url') }}">
                            </div>

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

                            <div class="form-group">
                                <label for="video_id">Captured Date</label>
                                <input type="text" class="form-control datepicker" aria-describedby="nameHelp" name="captured_date" placeholder="Captured Date" value="{{ old('captured_date','2018-01-01') }}">
                            </div>

                            <div class="form-group">
                                <label for="video_id">Video Date</label>
                                <input type="text" class="form-control datepicker" aria-describedby="nameHelp" name="video_date" placeholder="Video Date" value="{{ old('video_date','2018-01-01') }}">
                            </div>

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
                            <div class="form-group">
                                <label for="is_exchange">Exchange (Y/N)</label>
                                <input class="form-control" type="checkbox" id="is_exchange" value="{{ old('exchange') }}" name="exchange" style="width: 50px;"/>
                            </div>
                            <div class="form-group" id="exchange_enabled" <?php if(empty(old('exchange'))){ ?> style="visibility: hidden;" <?php } ?> >
                                <label for="is_exchange">If Exchange Yes, Service / Opportunity?</label>
                                <select class="form-control multi-select2" id="service_or_opportunity" name="service_or_opportunity">
                                    <option value="0">Select</option>
                                    <option value="1">Service</option>
                                    <option value="2">Opportunity</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleSelect1">Sorting Tags</label>
                                <select class="form-control multi-select2" id="secondary_subject_tag_id" multiple name="video_role">
                                    <option value="0">Select</option>
                                    @foreach($sorting_tags as $tag)
                                        <option value="{{$tag['id']}}">{{$tag['tag']}}</option>
                                    @endforeach
                                </select>
                            </div>

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

                            <div class="form-group">
                                <label for="accept_tos">Video Content</label>
                                <input class="form-control" type="file" name="content_set1[]" /> Content Set 1
                                <input class="form-control" type="file" name="content_set2[]" /> Content Set 2
                                <input class="form-control" type="file" name="content_set3[]" /> Content Set 3
                            </div>

                            <div class="form-group">
                                <label for="exampleTextarea">Additional Comments</label>
                                <textarea type="text" class="form-control" aria-describedby="nameHelp" name="user_comment" placeholder="Additional Comments" rows="4">{{ old('user_comment') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
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