@extends('layouts.app_inside')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add User</h4>
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
                        <form action="/user/admin/post-user-add" method="post" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="email" placeholder="Email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="password" placeholder="Password" value="{{ old('password') }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleSelect1">Status</label>
                                <select class="form-control" id="exampleSelect1" name="status_id">
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect1">Role</label>
                                <select class="form-control" id="exampleSelect1" name="role_id">
                                    @foreach($user_roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_avatar">User Avatar</label>
                                <input class="form-control" type="file" name="user_avatar" />
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect1">Role</label>
                                <select class="form-control" id="exampleSelect1" name="group_id">
                                    <option value="">Select Group</option>
                                    @foreach($user_groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}} ({{$group->email}})</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
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