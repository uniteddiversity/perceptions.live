@extends('layouts.app_inside')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{__('backend.add_user_to_group', ['name1' => __('user'), 'name2' => __('group')])}}</h4>
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

                        <div class="form-group">
                            <label for="exampleSelect1">{{__('backend.select_group', ['name' => __('group')])}}</label>
                            <select class="form-control" id="user-assign-group" name="users_in_groups[]">
                                <option value="">{{__('backend.select_group', ['name' => __('group')])}}</option>
                                @foreach($groups as $group)
                                <option value="{{$group->id}}" <?php if($group_id == $group->id){ echo 'selected'; } ?> >{{$group->name}} ({{$group->email}})</option>
                                @endforeach
                            </select>
                        </div>

                        <form action="/user/admin/post-user-group-add/{{$group_id}}" method="post" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                            <?php

                            $user_ids = [];
                            foreach($user_list_in_group as $user){
                                $user_ids[$user['id']] = $user['id'];
                            }
                            ?>
                            <div class="form-group">
                                <label for="exampleSelect1">{{__('backend.users_in_group', ['name1' => __('user'), 'name2' => __('group')])}}</label>
                                <select class="form-control multi-select2" id="exampleSelect1" multiple name="users_in_groups[{{$group_id}}][]" style="height:300px">
                                    @foreach($user_list as $user)
                                        <option value="{{$user->id}}" <?php if(isset($user_ids[$user->id])){ echo 'selected'; } ?> >{{$user->first_name}} ({{$user->email}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-submit">{{__('backend.add_selected_to_group', ['name' => __('group')])}}</button>

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