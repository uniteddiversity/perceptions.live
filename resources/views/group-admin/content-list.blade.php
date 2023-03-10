@extends('layouts.app_inside')

@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{__('backend.group_videos', ['name1' => __('group'), 'name2' => __('video')])}}</h4>
        <div class="table-responsive">
          <table class="table" id="users_llist">
            <thead>
              <tr>
                <th>
                  {{__('backend.id')}}
                </th>
                <th>
                  {{__('backend.title')}}
                </th>
                <th class="d-none d-lg-table-cell">
                  {{__('backend.last_update_time')}}
                </th>
                <th class="d-none d-md-table-cell"></th>
                <th>

                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($videos as $video)
              <tr>
                <td>
                  <a href="/contact-us" target="new">{{ $video->id }}</a>
                </td>
                <td style="max-width: 30%">
                  <strong><u><a href="{{ $video->url }}">{{ $video->title }}</a></u></strong>
                </td>
                {{--<td>--}}
                {{--{{ $video->date }}--}}
                {{--</td>--}}

                <!-- <td style="max-width: 150px">
                  {{ isset($video->user)?$video->user->email:'' }}
                </td> -->
                <!-- <td>
                  {{ $video->location }}
                </td> -->
                <td class="d-none d-lg-table-cell">
                  {{ date('Y-m-d', strtotime($video->updated_at)) }}
                </td>
                <td  class="d-none d-md-table-cell" style="width: 100px">
                  <button type="button" class="btn btn-icon-tooltip mr-2" data-toggle="tooltip" title="{{ isset($video->user)?$video->user->display_name:'' }}">
                    <i class="fas fa-envelope-open-text"></i>
                  </button>
                  <button type="button" class="btn btn-icon-tooltip" data-toggle="tooltip" title="{{ $video->location }}">
                    <i class="fas fa-map-marker-alt"></i>
                  </button>
                </td>
                <td>
                  {{--<a href="/user/group-admin/video-edit/{{ uid($video->id) }}" >Edit</a>--}}
                  <a class="btn btn-icon-tooltip" href="/contact-us"><i class="fas fa-edit"></i></a>
                  <a class="btn btn-icon-tooltip s_margin-left" onclick="return confirm('Are you sure you want to delete?')" href="/user/group-admin/video-delete/{{ uid($video['id']) }}"><i class="fas fa-trash"></i></a>
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
