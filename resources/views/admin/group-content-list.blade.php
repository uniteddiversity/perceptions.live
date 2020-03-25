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