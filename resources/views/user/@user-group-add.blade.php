@extends('layouts.app_inside')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Add User to Group</h4>
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

      <div class="form-group">
        <label for="exampleSelect1">Select Group</label>
        <select class="form-control" id="user-assign-group-groupadmin" name="users_in_groups[]">
          <option value="">Select Group</option>
          @foreach($groups as $group)
          <option value="{{$group->id}}" <?php if ($group_id == $group->id) {
                                            echo 'selected';
                                          } ?>>{{$group->name}} ({{$group->email}})</option>
          @endforeach
        </select>
      </div>

      <form action="/user/moderator/post-user-group-add/{{$group_id}}" method="post" enctype='multipart/form-data'>
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        {{--<div class="row">--}}
        {{--<div class="col-sm-5">--}}
        {{--<label for="exampleSelect1">Users</label>--}}
        {{--<select class="form-control multi-select2" id="exampleSelect1" multiple name="users[]" style="height:300px">--}}
        {{--<option value="">Select Group</option>--}}
        {{--@foreach($user_list as $user)--}}
        {{--<option value="{{$user->id}}">{{$user->first_name}} ({{$user->email}})</option>--}}
        {{--@endforeach--}}
        {{--</select>--}}
        {{--</div>--}}
        {{--<div class="col-sm-1">--}}
        {{--<div class="row">--}}
        {{--<div class="form-group">--}}
        {{--<button class="form-control" type="submit" class="btn btn-primary"> >> </button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
        {{--<div class="form-group">--}}
        {{--<button class="form-control" type="submit" class="btn btn-primary"> << </button>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--</div>--}}
        {{--<div class="col-sm-5">--}}
        {{--<label for="exampleSelect1">Users in Group</label>--}}
        {{--<select class="form-control multi-select2" id="exampleSelect1" multiple name="users_in_groups[]" style="height:300px">--}}
        {{--@foreach($user_list_in_group as $user)--}}
        {{--<option value="{{$user->id}}" selected>{{$user->first_name}} ({{$user->email}})</option>--}}
        {{--@endforeach--}}
        {{--</select>--}}
        {{--</div>--}}
        {{--</div>--}}

        <?php

        $user_ids = [];
        foreach ($user_list_in_group as $user) {
          $user_ids[$user['id']] = $user['id'];
        }
        ?>
        <div class="form-group">
          <label for="exampleSelect1">Users in Group</label>
          <select class="form-control multi-select2" id="exampleSelect1" multiple name="users_in_groups[{{$group_id}}][]" style="height:300px">
            @foreach($user_list as $user)
            <option value="{{$user->id}}" <?php if (isset($user_ids[$user->id])) {
                                            echo 'selected';
                                          } ?>>{{$user->first_name}} ({{$user->email}})</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary btn-submit">Add Selected to Group</button>

      </form>
    </div>
  </div>
</div>



@endsection
<script>
  var el = document.getElementById('loading');
  el.remove(); // Removes the div with the 'div-02' id
</script>