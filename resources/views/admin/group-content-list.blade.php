<?php

//dd($videos);
?>
@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Uploaded Videos</h4>
                    <div class="table-responsive group-videos-list">
                        <input type="hidden" id="data_list_id" value="{{$group_id}}" />
                        <table class="table" id="lazy-loaded-table" data-page-length='10'>
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
                                    Submitted By
                                </th>
                                <th>
                                    Approved/Open
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

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($videos as $video)
                                <tr>
                                    <td>
                                        <a href="/user/admin/video-edit/{{ uid($video->id) }}" data-toggle="tooltip" title="Edit"  ><i class="ti-pencil"></i></a>&nbsp;&nbsp;
                                        <?php if($video->status != '1'){ ?>
                                         <span id="approve_<?php echo $video->id ?>" class="approve-video inactive_link" data-value="<?php echo $video->id ?>" onclick="testFunction('<?php echo $video->id ?>')" >Approve</span>
                                        <?php } ?>
                                    </td>
                                    {{--<td>--}}
                                        {{--{{ $video->id }}--}}
                                    {{--</td>--}}
                                    <td>
                                        {{ $video->title }}
                                    </td>
                                    <td>
                                        <?php
                                        if(isset($video->user) && isset($video->user)){
                                            echo '@'.$video->user['display_name'];
                                        }else{
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if($video->status == '1'){ echo 'Approved'; }else{ echo 'Open'; } ?>
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