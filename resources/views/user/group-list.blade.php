@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card" id="user_group_list">
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
                                <th class="d-none d-md-block">
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
                                        @if($group->status == 2)
                                        <a href="/user/group-edit/{{ uid($group->id) }}" data-toggle="tooltip" title="Edit" ><i class="ti-pencil"></i></a>&nbsp;
                                        @endif
                                        <!--                                        <a href="/user/group-admin/group-content-list/{{ ($group->id) }}" target="_blank" data-toggle="tooltip" title="View Videos" ><i class="ti-video-clapper"></i></a>-->
                                    </td>
                                    <td class="d-none d-md-block">
                                        {{ date('Y-m-d', strtotime($group->created_at)) }}
                                    </td>
                                    <td>
                                        <span class="inactive_link" onclick="openGroupProfile('<?php echo $group->id ?>')">{{ $group->name }}</span>
                                    </td>
                                    <td>
                                        {{ (isset($group->groupStatus))? $group->groupStatus->name:'' }}
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