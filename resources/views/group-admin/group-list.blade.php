@extends('layouts.app_inside')

@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">My Groups</h4>
        <div class="table-responsive">
          <table class="table" id="users_list">
            <thead>
              <tr>
                <th></th>
                <th>
                    {{__('backend.name')}}
                </th>
                <th class="d-none d-lg-table-cell">
                    {{__('backend.category')}}
                </th>
                     <th>
                         {{__('backend.videos', ['name' => __('video')])}}
                     </th>
                     <th>
                         {{__('backend.users', ['name' => __('user')])}}
                     </th>
                     <th class="d-none d-md-table-cell">
                         {{__('backend.location')}}
                     </th>
                      <th>
                       &nbsp;
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
                          <span style="color:#2B0D82;"><strong><u><a href="/user/group-admin/group-edit/{{ uid($group->id) }}">{{ $group->name }}</a></u></strong></span>
                      </td>
                      <td class="d-none d-lg-table-cell">
                 {{ $group->category->name }}
                 </td>
 <td>
   {{ $group->active_video_count }}
 </td>

 <td>
   {{ (empty($group->users_count))? 0:$group->users_count }}
 </td>

 <td class="d-none d-md-table-cell">
   {{ $group->default_location }}
 </td>
<td style="width: 150px">

  <a class="btn btn-icon-tooltip mr-2" href="/user/group-admin/group-edit/{{ uid($group->id) }}" data-toggle="tooltip" title="Edit"><i class="ti-pencil"></i></a>&nbsp;
    <a class="btn btn-icon-tooltip mr-2" href="/user/group-admin/content-list-group" data-toggle="tooltip" title="View Videos" ><i class="ti-video-clapper"></i></a>
    <a class="btn btn-icon-tooltip mr-2" href="/user/group-admin/user-to-group-add/{{ ($group->id) }}" data-toggle="tooltip" title="View/Organize Users"><i class="ti-user"></i></a>&nbsp;
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