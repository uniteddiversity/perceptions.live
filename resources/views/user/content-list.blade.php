@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{__('backend.uploaded_videos', ['name', __('video')])}}</h4>
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
                                <th>
                                    {{__('backend.url')}}
                                </th>
                                <th>
                                    {{__('backend.email')}}
                                </th>
                                <th>
                                    {{__('backend.location')}}
                                </th>
                                <th>
                                    {{__('backend.last_update_time')}}
                                </th>
                                <th>
                                    {{__('backend.action')}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($videos as $video)
                                <tr>
                                    <td>
                                        {{ $video->id }}
                                    </td>
                                    <td>
                                        {{ $video->title }}
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
                                    <td>
                                        {{ $video->updated_at }}
                                    </td>
                                    <td>
                                        <a href="/user/user/video-edit/{{ uid($video->id) }}" >{{__('backend.edit')}}</a>
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