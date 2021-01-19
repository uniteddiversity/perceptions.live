<?php

//dd($videos);
?>
@extends('layouts.app_inside')

@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Group Videos</h4>
        <div class="table-responsive group-videos-list">
          <input type="hidden" id="data_list_id" value="{{$group_id}}" />
          <table class="table" id="lazy-loaded-table-group-admin" data-page-length='10'>
            <thead>
              <tr>
                <th>
                  {{__('backend.action')}}
                </th>
                <th>
                  {{__('backend.title')}}
                </th>
                <th>
                  {{__('backend.submitted_by')}}
                </th>
                <th>
                  {{__('backend.approve_open')}}
                </th>
                <th>
                  {{__('backend.url')}}
                </th>
                <th>
                  {{__('backend.email')}}
                </th>
                <th>
                  {{__('backend.location')}}
                </th>
                <th class="d-none d-md-table-cell">
                  {{__('backend.last_update_time')}}
                </th>

              </tr>
            </thead>
            <tbody>
              @foreach ($videos as $video)
              <tr>
                <td>
                  <a href="/user/group-admin/video-edit/{{ uid($video->id) }}" data-toggle="tooltip" title="Edit"><i class="ti-pencil"></i></a>&nbsp;&nbsp;
                </td>
                {{--<td>--}}
                {{--{{ $video->id }}--}}
                {{--</td>--}}
                <td>
                  {{ $video->title }}
                </td>
                <td>
                  <?php
                  if (isset($video->user) && isset($video->user)) {
                    echo '@' . $video->user['display_name'];
                  } else {
                    echo '-';
                  }
                  ?>
                </td>
                <td>
                  <?php if ($video->status == '1') {
                    echo 'Approved';
                  } else {
                    echo 'Open';
                  } ?>
                </td>
                {{--<td>--}}
                {{--{{ $video->date }}--}}
                {{--</td>--}}
                <td>
                  {{ $video->url }}
                </td>
                <td>
                  {{ isset($video->user)?$video->user->email:'' }}
                </td>
                <td>
                  {{ $video->location }}
                </td>
                <td class="d-none d-md-table-cell">
                  {{ $video->updated_at }}
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

<style>
  /*.group-videos-list .dataTables_scrollBody{*/
  /*height: 400px;*/
  /*}*/
</style>

@endsection