@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{__('backend.sharable_maps')}}</h4>
                    <div class="table-responsive">
                        <table class="table" id="users_llist">
                            <thead>
                            <tr>
                                <th>
                                    {{__('backend.action')}}
                                </th>
                                <th>
                                    {{__('backend.title')}}
                                </th>
                                <th>
                                    {{__('backend.domain')}}
                                </th>
                                <th class="d-none d-md-table-cell">
                                    {{__('backend.created_by')}}
                                </th>
                                <th class="d-none d-md-table-cell">
                                    {{__('backend.created_at')}}
                                </th>
                                <th class="d-none d-md-table-cell">
                                    {{__('backend.updated_at')}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($list as $video)
                                <tr>
                                    <td>
                                        @if(Auth::user()->is('admin'))
                                            <a href="/user/admin/map-generate/{{ uid($video->id) }}" >{{__('backend.edit')}}</a>&nbsp;&nbsp;
                                        @else
                                            <a href="/user/group-admin/map-generate/{{ uid($video->id) }}" >{{__('backend.edit')}}</a>&nbsp;&nbsp;
                                        @endif
                                    </td>
                                    <td>
                                        {{ $video->group }}
                                    </td>
                                    <td>
                                        <?php if($video->status == '1'){ echo 'Approved'; }else{ echo 'Open'; } ?>
                                    </td>
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