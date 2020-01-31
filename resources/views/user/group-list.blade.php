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
                </th>
                <th>
                  Name
                </th>
                {{--<th>--}}
                {{--Category--}}
                {{--</th>--}}
                <th>
                  Admin
                </th>
                <th class="d-none d-md-table-cell">
                  Videos(open)
                </th>
                <th class="d-none d-md-table-cell">
                  Users in Group
                </th>
                <th class="d-none d-lg-table-cell">
                  Default Location
                </th>
                </th>
                <th class="d-none d-lg-table-cell">
                  Date Created
                <th>
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($groups as $group)
              <tr>
                <td style="width: 20px">
                  <a class="custom-badge badge-{{ (isset($group->groupStatus))? $group->groupStatus->name:'' }}" data-toggle="tooltip" title="{{ (isset($group->groupStatus))? $group->groupStatus->name:'' }}"></a>
                </td>
                <td>
                  <span class="inactive_link" onclick="openGroupProfile('<?php echo $group->id ?>')">{{ $group->name }}</span>
                </td>
                {{--<td>--}}
                {{--{{ $group->category }}--}}
                {{--</td>--}}
                <td>
                  {{ $group->group_admin }}
                </td>
                <td class="d-none d-md-table-cell">
                  {{ $group->active_video_count }}
                </td>
                <td class="d-none d-md-table-cell">
                  {{ (empty($group->users_count))? 0:$group->users_count }}
                </td>
                <td class="d-none d-lg-table-cell">
                  {{ $group->default_location }}
                </td>
                <td class="d-none d-lg-table-cell">
                  {{ date('Y-m-d', strtotime($group->created_at)) }}
                </td>
                <td>
                  @if($group->status == 2)
                  <a class="btn btn-icon-tooltip" href="/user/group-edit/{{ uid($group->id) }}" data-toggle="tooltip" title="Edit"><i class="ti-pencil"></i></a>&nbsp;
                  @endif
                  <!--                                        <a href="/user/group-admin/group-content-list/{{ ($group->id) }}" target="_blank" data-toggle="tooltip" title="View Videos" ><i class="ti-video-clapper"></i></a>-->
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