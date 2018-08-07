@extends('layouts.app_inside')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add User to Group</h4>
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
                            <label for="exampleSelect1">Role</label>
                            <select class="form-control" id="exampleSelect1" name="users_in_groups[]">
                                <option value="">Select Group</option>
                                @foreach($groups as $group)
                                <option value="{{$group->id}}">{{$group->name}} ({{$group->email}})</option>
                                @endforeach
                            </select>
                        </div>
                        <form action="/user/admin/post-user-add" method="post" enctype='multipart/form-data'>
                            <div class="form-group">
                                <label for="exampleSelect1">Users</label>
                                <select class="form-control multi-select2" id="exampleSelect1" multiple name="users[]">
                                    <option value="">Select Group</option>
                                    @foreach($user_list as $user)
                                    <option value="{{$user->id}}">{{$user->name}} ({{$user->email}})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleSelect1">Users in Group</label>
                                <select class="form-control multi-select2" id="exampleSelect1" multiple name="users_in_groups[]">
                                    {{--@foreach($user_groups as $group)--}}
                                    {{--<option value="{{$group->id}}">{{$group->name}} ({{$group->email}})</option>--}}
                                    {{--@endforeach--}}
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Add to Group</button>
                            <button type="submit" class="btn btn-primary">Remove from Group</button>
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