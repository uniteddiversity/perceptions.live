@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{__('backend.uploaded_videos', ['name' => __('video')])}}</h4>
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
                                <th>
                                    {{__('backend.last_update_time')}}
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($videos as $video)
                                <tr>
                                    <td>
                                        <a href="/user/admin/video-edit/{{ uid($video->id) }}" >{{__('backend.edit')}}</a>&nbsp&nbsp
                                        <?php if($video->status != '1'){ ?>
                                         <span id="approve_<?php echo $video->id ?>" class="approve-video inactive_link" data-value="<?php echo $video->id ?>" onclick="testFunction('<?php echo $video->id ?>')" >{{__('backend.approve')}}</span>
                                        <?php } ?>&nbsp&nbsp
                                        <a href="/user/admin/comment-list/{{ uid($video->id) }}/contents" >{{__('backend.comments')}}</a>
                                    </td>
                                    <td>
                                        {{ $video->title }}
                                    </td>
                                    <td>
                                        <?php if($video->status == '1'){ echo 'Approved'; }else{ echo 'Open'; } ?>
                                    </td>
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