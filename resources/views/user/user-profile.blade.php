@extends('layouts.app_inside')
@section('content')
<?php
$data = array();
$data['id'] = isset($user_data['id']) ? $user_data['id'] : '';
$data['email'] = isset($user_data['email']) ? $user_data['email'] : '';
$data['first_name'] = isset($user_data['first_name']) ? $user_data['first_name'] : '';
$data['display_name'] = isset($user_data['display_name']) ? $user_data['display_name'] : '';
$data['status_id'] = isset($user_data['status_id']) ? $user_data['status_id'] : '';
$data['location'] = isset($user_data['location']) ? $user_data['location'] : '';
$data['description'] = isset($user_data['description']) ? $user_data['description'] : '';
$data['image'] = isset($user_data['image']) ? $user_data['image'] : array();
$data['group'] = isset($user_data['groups']) ? array_column($user_data['groups'], 'group_id') : array();
$data['user_acting_roles'] = isset($user_data['acting_roles']) ? array_column($user_data['acting_roles'], 'user_tag_id') : array();
$data['access_level_id'] = isset($user_data['access_level_id']) ? $user_data['access_level_id'] : '';
$data['grater_community_intention_ids'] = isset($user_data['gci']) ? array_column($user_data['gci'], 'user_tag_id') : array();
$data['skills'] = isset($user_data['skill']) ? array_column($user_data['skill'], 'user_tag_id') : array();
//    dd($data['skills']);
?>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card form-card">
    <div class="card-body">
      <div class="submitprcption">
        <h4 class="card-title" style="margin-bottom: 10px; text-align: center;">Account and Profile Settings
        </h4>
        <div class="pagedesc" align="center">
          <p>The information here will be the data that will connect you to connections and collaborations around the world. Have fun and please keep it as accurate as possible! :)
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
                @foreach ($errors->all() as $error)
                <li>{{ $error }}
                </li>
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
              <?php if (!empty($data['id'])) { ?>
                <input type="hidden" name="id" id="id" value="{{ uid($data['id']) }}" />
              <?php } ?>
              <div class="formdesctext">
                <strong>Your Account</strong>
                Private settings.
              </div>
              <div class="form-content">
                <div class="form-group">
                  <label for="exampleInputEmail1">@DisplayName
                  </label>
                  <input type="text" class="form-control" aria-describedby="nameHelp" name="display_name" placeholder="Display Name" value="{{ old('display_name',$data['display_name']) }}">
                </div>
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <div class="form-group">
                  <label for="exampleInputEmail1">Your Email
                  </label>
                  <input type="text" class="form-control" aria-describedby="nameHelp" name="email" placeholder="Email" value="{{ old('email',$data['email']) }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Change Your Password
                  </label>
                  <input type="text" class="form-control" aria-describedby="nameHelp" name="password" placeholder="Password" value="{{ old('password') }}">
                </div>
                <div class="form-group">
                  <label for="exampleSelect1">Your Privacy Settings
                  </label>
                  <div class="custom_select">
                    <select class="form-control" id="exampleSelect1" name="access_level_id">
                      <?php foreach ($access_levels as $access) { ?>
                        <option value="{{$access->id}}" <?php if (old('access_level_id', $data['access_level_id']) == $access->id) {
                                                            echo 'selected';
                                                          } ?>>{{$access->name}}
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="formdesctext">
                <strong>About You</strong>
                Personalize your profile. Let the network know a little about yourself.
              </div>
              <div class="form-content">
                <div class="form-group">
                  <label for="exampleInputEmail1">First Name
                  </label>
                  <input type="text" class="form-control" aria-describedby="nameHelp" name="first_name" placeholder="First Name" value="{{ old('first_name',$data['first_name']) }}">
                </div>
                <div class="form-group">
                  <label for="location">Current Location
                  </label>
                  <input type="text" class="form-control" aria-describedby="nameHelp" name="location" placeholder="Location" value="{{ old('location',$data['location']) }}">
                </div>
                <div class="form-group">
                  <label for="location">A Little About Yourself
                  </label>
                  <textarea type="text" class="form-control" rows="3" aria-describedby="nameHelp" name="description" placeholder="Description">{{ old('description',$data['description']) }}
                  </textarea>
                </div>
                <div class="form-group">
                  {{--
                  <input type="file" id="upload" value="Choose a file">--}}
                  <div id="upload-profile">
                  </div>
                  <input type="hidden" id="imagebase64" name="profile_image">
                  {{--
                  <a href="#" class="upload-result">Send
                  </a>--}}
                  <label for="user_avatar">Avatar (1MB or less please!)
                  </label>
                  <input id="upload" class="form-control" type="file" name="user_avatar" style="width: 40%;" />
                  <?php foreach ($data['image'] as $img) { ?>
                    <input type="hidden" value="/storage/<?php echo $img['url'] ?>" id="preset_image_path" />
                    <a target="_blank" href="/storage/<?php echo $img['url'] ?>">
                      <img src="/storage/<?php echo $img['url'] ?>" alt="Avatar" class="avatar profile_img_mini">
                    </a>
                  <?php } ?>
                </div>
              </div>
              <div class="formdesctext">
                <strong>Connections and Collaborations
                </strong>
                These are the details by which others will discover you. What skills do you have to offer? What values do you represent?
              </div>
              <div class="form-content">
                <div class="form-group">
                  <label for="video_producer">Your Collaboration Roles (select as many as you'd like)
                  </label>
                  {{--
                  <input type="text" class="form-control" aria-describedby="nameHelp" name="video_producer" placeholder="Video Producer" value="{{ old('video_producer') }}">--}}
                  <select class="form-control multi-select2" id="video_producer" multiple searchable="Search here.." name="user_acting_roles[]">
                    @foreach($user_acting_role as $role)
                    <option value="{{$role->id}}" <?php if (in_array($role->id, old('user_acting_roles', $data['user_acting_roles']))) {
                                                    echo 'selected';
                                                  } ?>>{{$role->name}}
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="grater_community_intention_id">Your Greater Community Intentions (max. 3)
                  </label>
                  <select class="form-control multi-select2-max3" id="grater_community_intention_id" multiple name="grater_community_intention_ids[]">
                    @foreach($gci_tags as $m)
                    <option value="{{$m['id']}}" <?php if (in_array($m['id'], old('grater_community_intention_ids', $data['grater_community_intention_ids']))) {
                                                    echo 'selected';
                                                  } ?>>{{$m['tag']}}
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="skills">Your Skills
                  </label>
                  <select class="form-control multi-select2-with-tags-max3" id="skills" multiple name="skills[]">
                    @foreach($skill_tags as $m)
                    <option value="{{base64_encode($m['id'])}}" <?php if (in_array($m['id'], old('skills', $data['skills']))) {
                                                                  echo 'selected';
                                                                } ?>>{{$m['tag']}}
                    </option>
                    @endforeach
                  </select>
                </div>
                <?php if (Auth::user()->is('admin')) { ?>
                  <div class="form-group">
                    <label for="group_id">Group
                    </label>
                    <select class="form-control" id="group_id" name="group_id">
                      <option value="">Select Group
                      </option>
                      @foreach($user_groups as $group)
                      <option value="{{$group->id}}" <?php if (in_array($group->id, $data['group'])) {
                                                          echo 'selected';
                                                        } ?>>{{$group->name}} ({{$group->email}})
                      </option>
                      @endforeach
                    </select>
                  </div>
                <?php } ?>
                <?php if (Auth::user()->is('admin')) { ?>
                  <div class="form-group">
                    <label for="status_id">Status
                    </label>
                    <select class="form-control" id="status_id" name="status_id">
                      @foreach($status as $st)
                      <option value="{{$st->id}}" <?php if (old('status_id', $data['status_id']) == $st->id) {
                                                      echo 'selected';
                                                    } ?>>{{$st->name}}
                      </option>
                      @endforeach
                    </select>
                  </div>
                <?php } ?>
                <?php if (Auth::user()->is('admin')) { ?>
                  {{--
                  <div class="form-group">--}}
                  {{--
                    <label for="exampleSelect1">Role
                    </label>--}}
                  {{--
                    <select class="form-control" id="exampleSelect1" name="role_id">--}}
                  {{--@foreach($user_roles as $role)--}}
                  {{--
                      <option value="{{$role->id}}">{{$role->name}}
                  </option>--}}
                  {{--@endforeach--}}
                  {{--
                    </select>--}}
                  {{--
                  </div>--}}
                <?php } ?>
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-submit" style="background: #4214c7; border-color: #fff;">Update My Profile
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>

  /* User/Group Admin Edit */

  .pagedesc {
    font-size: 20px;
    font-family: 'Open Sans', sans-serif;
    line-height: 1em;
    padding-bottom: 20px;
  }

  div.formdesctext {
    font-size: 14.4px;
    line-height: 20px;
    font-family: 'Open Sans', sans-serif;
    font-style: normal;
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

  @media only screen and (max-width: 768px) {
    div.formdesctext strong {
      font-size: 20px;
      line-height: 24px;
    }
  }

  @media only screen and (max-width: 576px) {
    .main-body .card {
      width: 100%;
    }
  }


</style>
@endsection
@section('scripts')
<script>
  var el = document.getElementById('loading');
  el.remove();
  // Removes the div with the 'div-02' id
</script>
@endsection