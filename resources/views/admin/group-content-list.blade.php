@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{__('backend.uploaded_videos', ['name' => __('video')])}}</h4>
                    <div class="table-responsive group-videos-list">
                        <input type="hidden" id="data_list_id" value="{{$group_id}}" />
                        <table class="table" id="lazy-loaded-table" data-page-length='10'>
                            <thead>
                            <tr>
                                <th>
                                    {{__('backend.action')}}
                                </th>
                                <th>
                                    {{__('backend.title')}}
                                </th>
                                <th>
                                    {{__('backend.submitted_by')}}
                                </th>
                                <th>
                                    {{__('backend.approved_open')}}
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

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>

    </style>

@endsection