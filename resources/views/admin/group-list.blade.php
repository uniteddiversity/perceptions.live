@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{__('backend.group_list', ['name' => __('group')])}}</h4>
                    <div class="table-responsive">
                        <table class="table" id="users_llist">
                            <thead>
                            <tr>
                                <th>
                                    {{__('backend.action')}}
                                </th>
                                <th>
                                    {{__('backend.date_created')}}
                                </th>
                                <th>
                                    {{__('backend.name')}}
                                </th>
                                <th>
                                    {{__('backend.active_status')}}
                                </th>
                                <th>
                                    {{__('backend.default_location')}}
                                </th>
                                <th>
                                    {{__('backend.admin')}}
                                </th>
                                <th>
                                    {{__('backend.video_open', ['name'=>__('video')])}}
                                </th>
                                <th>
                                    {{__('backend.users_in_group', ['name1' => __('user'), 'name2' => __('group')])}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($groups as $group)
                                <tr>
                                    <td>
                                        <a href="/user/admin/group-edit/{{ uid($group->id) }}" data-toggle="tooltip" title="Edit" ><i class="ti-pencil"></i></a>&nbsp;
                                        <a href="/user/admin/user-to-group-add/{{ ($group->id) }}" target="_blank" data-toggle="tooltip" title="View Users" ><i class="ti-user"></i></a>&nbsp;
                                        <a href="/user/admin/group-content-list/{{ ($group->id) }}" target="_blank" data-toggle="tooltip" title="View Videos" ><i class="ti-video-clapper"></i></a>
                                    </td>
                                    <td>
                                        {{ date('Y-m-d', strtotime($group->created_at)) }}
                                    </td>
                                    <td>
                                        <span class="inactive_link" onclick="openGroupProfile('<?php echo $group->id ?>')">{{ $group->name }}</span>
                                    </td>
                                    <td>
                                        {{ (isset($group->groupStatus))? $group->groupStatus->name:'' }}
                                    </td>
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