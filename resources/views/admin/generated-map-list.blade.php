@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sharable Maps</h4>
                    <div class="table-responsive">
                        <table class="table" id="users_llist">
                            <thead>
                            <tr>
                                <th>
                                    Action
                                </th>
                                {{--<th>--}}
                                    {{--Id--}}
                                {{--</th>--}}
                                <th>
                                    Title
                                </th>
                                <th>
                                    Domain
                                </th>
                                {{--<th>--}}
                                    {{--Date--}}
                                {{--</th>--}}
                                <th>
                                    Created By
                                </th>
                                <th>
                                    Created At
                                </th>
                                <th>
                                    Updated At
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($list as $video)
                                <tr>
                                    <td>
                                        @if(Auth::user()->is('admin'))
                                            <a href="/user/admin/map-generate/{{ uid($video->id) }}" >Edit</a>&nbsp;&nbsp;
                                        @else
                                            <a href="/user/group-admin/map-generate/{{ uid($video->id) }}" >Edit</a>&nbsp;&nbsp;
                                        @endif
                                    </td>
                                    {{--<td>--}}
                                        {{--{{ $video->id }}--}}
                                    {{--</td>--}}
                                    <td>
                                        {{ $video->group }}
                                    </td>
                                    <td>
                                        <?php if($video->status == '1'){ echo 'Approved'; }else{ echo 'Open'; } ?>
                                    </td>
                                    {{--<td>--}}
                                        {{--{{ $video->date }}--}}
                                    {{--</td>--}}
                                    <td>
                                        {{ isset($video->user)?'@'.$video->user->display_name:'' }}
                                    </td>
                                    <td>
                                        {{ $video->created_at }}
                                    </td>
                                    <td>
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


@endsection