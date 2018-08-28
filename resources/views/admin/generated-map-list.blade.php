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
                                    Action
                                </th>
                                {{--<th>--}}
                                    {{--Id--}}
                                {{--</th>--}}
                                <th>
                                    Group
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
                            @foreach ($list as $video) <?php //dd($video) ?>
                                <tr>
                                    <td>
                                        <a href="/user/admin/map-generate/{{ uid($video->id) }}" >Edit</a>&nbsp;&nbsp;
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