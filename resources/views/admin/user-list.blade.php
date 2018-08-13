@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User List</h4>
                    <div class="table-responsive">
                        <table class="table" id="users_llist">
                            <thead>
                            <tr>
                                <th>
                                    Joined Date
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Display name
                                </th>
                                <th>
                                    Active Status
                                </th>
                                <th>
                                    First name
                                </th>
                                <th>
                                    Groups
                                </th>
                                <th>
                                    Role
                                </th>
                                <th>
                                    Finished Submissions (Open)
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user) <?php //dd($user); ?>
                                <tr>
                                    <td>
                                        {{ date('Y-m-d', strtotime($user->created_at)) }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->display_name }}
                                    </td>
                                    <td>
                                        <?php if($user->status_id == '1'){ echo '<i class="menu-icon mdi mdi-check"></i>'; }else{ echo '<i class="menu-icon mdi mdi-close"></i>'; } ?>
                                    </td>


                                    <td>
                                        {{ $user->first_name }}
                                    </td>
                                    <td>
                                        <?php foreach($user->groups as $group){
                                            echo isset($group->group)?$group->group->name.', ':'';
                                        }?>
                                    </td>
                                    <td>
                                        <?php if(isset($user->role)){ echo $user->role->name; } ?>
                                    </td>
                                    <td>
                                        {{ $user->no_submission }}
                                    </td>
                                    <td>
                                        <a href="/user/admin/user-edit/{{ uid($user->id) }}" >Edit</a>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection