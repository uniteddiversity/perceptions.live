@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Group List</h4>
                    <div class="table-responsive">
                        <table class="table" id="users_llist">
                            <thead>
                            <tr>
                                <th>
                                    Action
                                </th>
                                <th>
                                    Date Created
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Active Status
                                </th>
                                <th>
                                    Default Location
                                </th>
                                {{--<th>--}}
                                    {{--Category--}}
                                {{--</th>--}}
                                <th>
                                    Admin
                                </th>
                                <th>
                                    Videos(open)
                                </th>
                                <th>
                                    Users in Group
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($groups as $group)
                                <tr>
                                    <td>
                                        <a href="/user/admin/group-edit/{{ uid($group->id) }}" >Edit</a>&nbsp;&nbsp;
                                        <a href="/user/admin/user-to-group-add/{{ ($group->id) }}" target="_blank" >View Users</a>

                                    </td>
                                    <td>
                                        {{ date('Y-m-d', strtotime($group->created_at)) }}
                                    </td>
                                    <td>
                                        {{ $group->name }}
                                    </td>
                                    <td>
                                        {{ $group->groupStatus->name }}
                                    </td>
                                    {{--<td>--}}
                                        {{--{{ $group->category }}--}}
                                    {{--</td>--}}
                                    <td>
                                        {{ $group->default_location }}
                                    </td>
                                    <td>
                                        {{ $group->group_admin }}
                                    </td>
                                    <td>
                                        {{ $group->active_video_count }}
                                    </td>

                                    <td>
                                        {{ (empty($group->users_count))? 0:$group->users_count }}
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