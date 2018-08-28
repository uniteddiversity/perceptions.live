@extends('layouts.app_inside')

@section('content')
    <?php

//    $data['id'] = isset($video_data['id'])?$video_data['id']:'';
    $data['grater_community_intention_ids'] = isset($video_share['gci_tags'])?array_column($video_share['gci_tags'],'content_tag_id'):array();


    $data['id'] = isset($edit_data[0]['id'])?$edit_data[0]['id']:'';
    $data['group'] = isset($edit_data[0]['group'])?$edit_data[0]['group']:'';
    $data['status'] = isset($edit_data[0]['status'])?$edit_data[0]['status']:'';
//    $data['filters'] = isset($video_share['filters'])?$edit_data['filters']:'';
    $data['domain'] = isset($edit_data[0]['allowed_domain'])?$edit_data[0]['allowed_domain']:'';
    $data['primary_subject_tag'] = isset($edit_data[0]['primary_subject_tag'])?$edit_data[0]['primary_subject_tag']:'';
    $data['_token'] = isset($edit_data[0]['public_token'])?$edit_data[0]['public_token']:'';
//dd($data['_token']);
    $data["sorting_tags"] = array();
    $data["contents"] = array();
    $data["users"] = array();
    $data["categories"] = array();

    if(isset($edit_data)){
        foreach($edit_data as $editd){
            if(isset($editd['id'])){
                $data[$editd['table']][] = $editd['fk_id'];
            }
        }
    }

//    dd($data['sorting_tags']);
    ?>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php if(!empty($data['id'])){ ?>Edit Map<?php }else{ ?>Build Your Map<?php } ?> <span style="font-size: 12px;"><?php if(!empty($data['id'])){ ?><a class="btn btn-primary btn-xs" onclick="openVideo('<?php echo $data['id'] ?>')" href="#" >Video Profile</a><?php } ?></span></h4>
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
                        <form action="/user/admin/post-map-generate" method="post" id="submit_content" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <?php if($data['id']){?>
                                <input type="hidden" name="id" id="csrf-token" value="<?php echo uid($data['id']) ?>" />
                            <?php } ?>
                            <div class="form-group">
                                <label for="group">Group</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="group" placeholder="Group" value="{{ old('group',$data['group']) }}">
                            </div>
                            <div class="form-group">
                                <label for="domain">Domain</label>
                                <input type="text" class="form-control" id="domain" aria-describedby="nameHelp" name="domain" placeholder="Domain" value="{{ old('domain',$data['domain']) }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleSelect1">Filters</label>
                                <select class="form-control multi-select2-max3" id="grater_community_intention_id" multiple name="grater_community_intention_ids[]">
                                    @foreach($gci_tags as $m)
                                        <option value="{{$m['id']}}" <?php if(in_array($m['id'], old('grater_community_intention_ids',$data['sorting_tags']))){ echo 'selected'; } ?> >{{$m['tag']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="categories">Categories</label>
                                <select class="form-control multi-select2-max3" id="categories" multiple name="categories[]">
                                    @foreach($categories as $m)
                                        <option value="{{$m['id']}}" <?php if(in_array($m['id'], old('categories',$data['categories']))){ echo 'selected'; } ?> >{{$m['name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <hr/>
                            <div class="form-group">
                                <label for="exampleSelect1">Content (Select the content you would like to include in your map)</label>
                            </div>

                            <div class="form-group">
                                <label for="exampleSelect1">Group</label>
                                <select class="form-control select2-ajax-groups" id="public_videos" multiple name="groups[]">
                                    <?php //dd($selected_groups);
                                    foreach($selected_groups as $int_data){
                                        echo '<option value="'.$int_data['id'].'" selected >'.$int_data['text'].'</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="primary_subject_tag">Primary Subject Tag</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="primary_subject_tag" placeholder="Primary Subject Tag" value="{{ old('primary_subject_tag',$data['primary_subject_tag']) }}">
                            </div>


                            <div class="form-group">
                                <label for="associated_users">Associated Users</label>
                                <select class="form-control select2-ajax-users" id="associated_users" multiple name="associated_users[]">
                                    <?php foreach($selected_users as $int_data){
                                        echo '<option value="'.$int_data['id'].'" selected >'.$int_data['text'].'</option>';
                                    } ?>

                                </select>
                            </div>


                            <hr/>
                            <div class="form-group">
                                <label for="exampleSelect1">Additional Videos</label>
                            </div>
                            <div class="form-group">
                                <label for="my_group_videos">Your Group's Videos</label>
                                <select class="form-control select2-ajax-my-groups-content" id="my_group_videos" multiple name="my_group_videos[]">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="public_videos">All Public Videos</label>
                                <select class="form-control select2-ajax-content" id="public_videos" multiple name="public_videos[]">
                                    <?php foreach($selected_videos as $int_data){
                                        echo '<option value="'.$int_data['id'].'" selected >'.$int_data['text'].'</option>';
                                    } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit & Preview</button>

                            <hr/>
                            <?php if($data['id']){ ?>
                            <div class="form-group">
                                <label for="public_videos">Shearable Code</label>
                                <p style="background-color: #cccccc;color: black;">
                                    <textarea id="shearable_code" class="form-control">&lt;iframe src="<?php echo env('APP_DOMAIN', $_SERVER['SERVER_NAME']) ?>/home/shared/group/<?php echo $data['_token'] ?>" width="100%" height="350" &gt; &lt;/iframe&gt;</textarea>

                                </p>
                            </div>

                            <div class="form-group">
                                <label for="exampleSelect1">Preview Map</label>
                                <iframe src="<?php echo env('APP_DOMAIN', $_SERVER['SERVER_NAME']) ?>/home/shared/group/<?php echo $data['_token'] ?>" width="100%" height="350"></iframe>
                            </div>
                            <?php } ?>
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