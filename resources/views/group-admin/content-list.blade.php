@extends('layouts.app_inside')

@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Uploaded Videos</h4>
        <div class="table-responsive">
          <table class="table" id="users_llist">
            <thead>
              <tr>
                <th>
                  Id
                </th>
                <th>
                  Title
                </th>
                {{--<th>--}}
                {{--Date--}}
                {{--</th>--}}
                <th class="d-none d-lg-table-cell">
                  URL
                </th>
                <!-- <th>
                  Email
                </th> -->
                <!-- <th>
                  Location
                </th> -->
                <th class="d-none d-lg-table-cell">
                  Last Updated Time
                </th>
                <th>Info</th>
                <th class="d-none d-md-table-cell">
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($videos as $video)
              <tr>
                <td>
                  <a href="/contact-us">{{ $video->id }}</a>
                </td>
                <td style="max-width: 30%">
                  <a href="{{ $video->url }}">{{ $video->title }}</a>
                </td>
                {{--<td>--}}
                {{--{{ $video->date }}--}}
                {{--</td>--}}
                <td class="d-none d-lg-table-cell" style="max-width: 30%">
                  {{ $video->url }}
                </td>
                <!-- <td style="max-width: 150px">
                  {{ isset($video->user)?$video->user->email:'' }}
                </td> -->
                <!-- <td>
                  {{ $video->location }}
                </td> -->
                <td class="d-none d-lg-table-cell">
                  {{ $video->updated_at }}
                </td>
                <td style="width: 100px">
                  <button type="button" class="btn btn-icon-tooltip mr-2" data-toggle="tooltip" title="{{ isset($video->user)?$video->user->email:'' }}">
                    <i class="fas fa-envelope-open-text"></i>
                  </button>
                  <button type="button" class="btn btn-icon-tooltip" data-toggle="tooltip" title="{{ $video->location }}">
                    <i class="fas fa-map-marker-alt"></i>
                  </button>
                </td>
                <td class="d-none d-md-table-cell">
                  {{--<a href="/user/group-admin/video-edit/{{ uid($video->id) }}" >Edit</a>--}}
                  <a class="btn btn-icon-tooltip" href="/contact-us"><i class="fas fa-edit"></i></a>
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
