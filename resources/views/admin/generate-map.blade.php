@extends('layouts.app_inside')

@section('content')
<?php

//    $data['id'] = isset($video_data['id'])?$video_data['id']:'';
$data['grater_community_intention_ids'] = isset($video_share['gci_tags']) ? array_column($video_share['gci_tags'], 'content_tag_id') : array();


$data['id'] = isset($edit_data[0]['id']) ? $edit_data[0]['id'] : '';
$data['group'] = isset($edit_data[0]['group']) ? $edit_data[0]['group'] : '';
$data['status'] = isset($edit_data[0]['status']) ? $edit_data[0]['status'] : '';
//    $data['filters'] = isset($video_share['filters'])?$edit_data['filters']:'';
$data['domain'] = isset($edit_data[0]['allowed_domain']) ? $edit_data[0]['allowed_domain'] : '';
$data['primary_subject_tag'] = isset($edit_data[0]['primary_subject_tag']) ? $edit_data[0]['primary_subject_tag'] : '';
$data['default_zoom_level'] = isset($edit_data[0]['default_zoom_level']) ? $edit_data[0]['default_zoom_level'] : '';
$data['_token'] = isset($edit_data[0]['public_token']) ? $edit_data[0]['public_token'] : '';
$data['lat'] = isset($edit_data[0]['lat']) ? $edit_data[0]['lat'] : '';
$data['long'] = isset($edit_data[0]['long']) ? $edit_data[0]['long'] : '';
$data['default_location'] = isset($edit_data[0]['default_location']) ? $edit_data[0]['default_location'] : '';
$data['filter_list'] = isset($edit_data['filter_list']) ? $edit_data['filter_list'] : array();
//dd($data['_token']);
$data["sorting_tags"] = array();
$data["contents"] = array();
$data["users"] = array();
$data["categories"] = array();

if (isset($edit_data)) {
  foreach ($edit_data as $editd) {
    if (isset($editd['id'])) {
      $data[$editd['table']][] = $editd['fk_id'];
    }
  }
}

//    dd($data);
?>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card form-card">
    <div class="card-body">
        <div class="submitprcption">
          <h4 class="card-title" style="margin-bottom: 10px; text-align: center;"><?php if (!empty($data['id'])) { ?>Edit Map<?php } else { ?>Generate A New Map<?php } ?> <span style="font-size: 12px;"><?php if (!empty($data['id'])) { ?><a class="btn btn-primary btn-xs" onclick="openVideo('<?php echo $data['id'] ?>')" href="#">Video Profile</a><?php } ?></span>
          </h4>
          <div class="pagedesc" align="center">
            <p>Build a group map that you can embed on your community's website.
            </p>
            <p>
              <em>Should you encounter any errors we encourage you to
                <a href="/contact-us">let us know</a>. Thanks!
              </em>
            </p>
            <div class="table-responsive">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            <?php //dd($errors) 
            ?>
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
        @if(Auth::user()->is('admin'))
        <form action="/user/admin/post-map-generate" method="post" id="submit_content" enctype='multipart/form-data'>
          @else
          <form action="/user/group-admin/post-map-generate" method="post" id="submit_content" enctype='multipart/form-data'>
            @endif

            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <?php if ($data['id']) { ?>
              <input type="hidden" name="id" id="csrf-token" value="<?php echo uid($data['id']) ?>" />
            <?php } ?>
            <div class="form-content">
      <div class="formdesctext">
        <strong>Website Details
        </strong>
        Required information so our API can give access to your domain name.
      </div>
            <div class="form-group">
              <label for="group">Title of Map</label>
              <input type="text" class="form-control" aria-describedby="nameHelp" name="group" placeholder="Group" value="{{ old('group',$data['group']) }}">
            </div>
            <div class="form-group">
              <label for="domain">Domain</label>
              <input type="text" class="form-control" id="domain" aria-describedby="nameHelp" name="domain" placeholder="Domain" value="{{ old('domain',$data['domain']) }}">
            </div>
            </div>
            <div class="formdesctext">
              <strong>Map Look & Feel
              </strong>
              Where is the map's focus? How much distance should it cover? How can users filter the map for their own browsing purposes?
            </div>
              <div class="form-content">
            <div class="form-group">
              <label for="leaflet_search_addr">Default Location</label>
              <input onkeyup="addr_search_new()" type="text" class="form-control" id="leaflet_search_addr" aria-describedby="nameHelp" name="default_location" placeholder="Where does the map start?" value="{{ old('default_location',$data['default_location']) }}">
              <input type="hidden" class="form-control" aria-describedby="nameHelp" id="lat_val" name="lat" placeholder="Lat" value="{{ old('lat',$data['lat']) }}">
              <input type="hidden" class="form-control" aria-describedby="nameHelp" id="long_val" name="long" placeholder="Long" value="{{ old('long',$data['long']) }}">

            </div>
            <div class="form-group">
                <label for="default_zoom_level">Default Zoom Level (0-15)</label>
                <input type="text" class="form-control" id="default_zoom_level" aria-describedby="nameHelp" name="default_zoom_level" placeholder="0: the whole world // 7: US state or large European country // 15: neighborhood" value="{{ old('default_zoom_level',$data['default_zoom_level']) }}">
            </div>

            <div class="form-group">
              <label for="filter_list">Map Browsing Filters</label>
              <select class="form-control multi-select2-max3" id="filter_list" multiple name="filter_list[]">
                @foreach($filter_list as $m)
                <option value="{{$m['id']}}" <?php if (in_array($m['id'], old('filter_list', $data['filter_list']))) {
                                                echo 'selected';
                                              } ?>>{{$m['filter']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="formdesctext">
            <strong>Content
            </strong>
            Select the content to be displayed on the map.
          </div>
            <?php /*
                            {{--<div class="form-group">--}}
                                {{--<label for="grater_community_intention_id">Great Community Intention</label>--}}
                                {{--<select class="form-control multi-select2-max3" id="grater_community_intention_id" multiple name="grater_community_intention_ids[]">--}}
                                    {{--@foreach($gci_tags as $m)--}}
                                        {{--<option value="{{$m['id']}}" <?php if(in_array($m['id'], old('grater_community_intention_ids',$data['sorting_tags']))){ echo 'selected'; } ?> >{{$m['tag']}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="categories">Categories</label>--}}
                                {{--<select class="form-control multi-select2-max3" id="categories" multiple name="categories[]">--}}
                                    {{--@foreach($categories as $m)--}}
                                        {{--<option value="{{$m['id']}}" <?php if(in_array($m['id'], old('categories',$data['categories']))){ echo 'selected'; } ?> >{{$m['name']}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}

                            */ ?>
              <div class="form-content">
            <div class="form-group">
              <label for="exampleSelect1">My Groups</label>
              <select class="form-control select2-ajax-groups" id="public_videos" multiple name="groups[]">
                <?php //dd($selected_groups);
                foreach ($selected_groups as $int_data) {
                  echo '<option value="' . $int_data['id'] . '" selected >' . $int_data['text'] . '</option>';
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="primary_subject_tag">Primary Subject Tag</label>
              <input type="text" class="form-control" aria-describedby="nameHelp" name="primary_subject_tag" placeholder="Primary Subject Tag" value="{{ old('primary_subject_tag',$data['primary_subject_tag']) }}">
            </div>

            <div class="form-group">
              <label for="associated_users">Associated Users</label>
              <select class="form-control map-sharing-ajax-users" id="associated_users" multiple name="associated_users[]">
                <?php foreach ($selected_users as $int_data) {
                  echo '<option value="' . $int_data['id'] . '" selected >' . $int_data['text'] . '</option>';
                } ?>

              </select>
            </div>

              <div class="form-group">
                  <label for="associated_users">Extra videos</label>
                  <select class="form-control select2-ajax-content" id="other_contents" multiple name="associated_contents[]">
                      <?php foreach($selected_videos as $int_data){
                      echo '<option value="'.$int_data['id'].'" selected >'.$int_data['text'].'</option>';
                      } ?>
                  </select>
              </div>
            <?php /*
                            {{--<hr/>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="exampleSelect1">Additional Videos</label>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="my_group_videos">Your Group's Videos</label>--}}
                                {{--<select class="form-control select2-ajax-my-groups-content" id="my_group_videos" multiple name="my_group_videos[]">--}}

                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="public_videos">All Public Videos</label>--}}
                                {{--<select class="form-control select2-ajax-content" id="public_videos" multiple name="public_videos[]">--}}
                                    {{--<?php foreach($selected_videos as $int_data){--}}
                                        {{--echo '<option value="'.$int_data['id'].'" selected >'.$int_data['text'].'</option>';--}}
                                    {{--} ?>--}}
                                {{--</select>--}}
                            {{--</div>--}}
 */ ?>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary">Submit & Preview</button>
            </div>

            <?php if ($data['id']) { ?>
              <div class="form-group">
                <label for="public_videos">Copy & Paste This To Your Website:</label>
                <p style="background-color: #cccccc;color: black;">
                  <textarea id="shearable_code" class="form-control">&lt;iframe border="0" frameBorder="0" src="<?php echo env('APP_DOMAIN', $_SERVER['SERVER_NAME']) ?>/home/shared/group/<?php echo $data['_token'] ?>?output=embed" width="100%" height="600" &gt; &lt;/iframe&gt;</textarea>

                </p>
              </div>

              <div class="form-group">
                <label for="exampleSelect1">Preview Map</label>
                <iframe border="0" frameBorder="0" src="<?php echo env('APP_DOMAIN', $_SERVER['SERVER_NAME']) ?>/home/shared/group/<?php echo $data['_token'] ?>?output=embed" width="100%" height="600"></iframe>
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

<style>

  .table-responsive .card-title {
    padding: 20px 10px;
    margin-bottom: 30px;
    border-bottom: 2px solid #e6defc;
  }
  form {
    margin-bottom: 0;
  }
  .table-responsive .form-group {
    float: none !important;
  }

  .form-footer {
    padding: 20px 40px;
    background: #e6defc;
    text-align: left;
  }

  .form-footer button {
    margin: 0 !important;
    float: none
  }
  .pagedesc {
    font-size: 20px;
    font-family: 'Open Sans', sans-serif;
    line-height: 1em;
    padding-bottom: 20px;
  }

  div.formdesctext {
    font-size: 14.4px !important;;
    line-height: 20px !important;;
    font-family: 'Open Sans', sans-serif !important;
    font-style: normal !important;;
    text-align: left;
    color: #797979;
    margin-bottom: 20px;
    padding: 20px 40px;
    border-bottom: 2px solid #e6defc;
  }

  div.formdesctext strong {
    margin: auto;
    font-family: 'Open Sans', sans-serif;
    font-size: 26px;
    font-weight: 600;
    line-height: 1.1;
    color: #4214c7;
    display: block;
    margin-bottom: 10px
  }

  div.submitprcption {
    width: 50%;
    margin: auto;
  }

  form {
    margin-bottom: 0
  }

  .form-content {
    padding-bottom: 20px;
    border-bottom: 2px solid #e6defc;
  }

  .form-content .form-group {
    float: none;
  }

  .form-footer {
    padding: 20px 40px;
    background: #e6defc;
    text-align: left;
  }

  .form-footer button {
    margin: 0 !important;
    float: none
  }

  .form-group .custom_select {
    height: auto;
    float: none;
  }

  .form-group .custom_select::before {
    bottom: 18px;
    top: auto
  }

  a {
    color: #2B0D82 !important;
  }

  a:hover {
    color: #2b0bae !important;
  }
  @media only screen and (max-width: 992px) {
    .main-body .card {
      width: 100%;
    }
  }

  }
</style>