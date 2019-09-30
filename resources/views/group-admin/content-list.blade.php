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
                                <th>
                                    URL
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Location
                                </th>
                                <th>
                                    Last Updated Time
                                </th>
                                <th>
                                    Action
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
                                        {{--<a href="/user/group-admin/video-edit/{{ uid($video->id) }}" >Edit</a>--}}
                                        <a href="/contact-us" >Edit</a>
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