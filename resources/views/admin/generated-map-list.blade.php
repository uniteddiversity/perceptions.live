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
                                <th class="d-none d-md-table-cell">
                                    Created By
                                </th>
                                <th class="d-none d-md-table-cell">
                                    Created At
                                </th>
                                <th class="d-none d-md-table-cell">
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
                                    <td class="d-none d-md-table-cell">
                                        {{ isset($video->user)?'@'.$video->user->display_name:'' }}
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        {{ $video->created_at }}
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


@endsection