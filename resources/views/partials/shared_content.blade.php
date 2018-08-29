@extends('layouts.shared_content_layout')



@section('content')
    <div style="float: left;max-width: 320px;">
        @include('partials.shared_left-side-bar')
    </div>
    <div id="map_position" style="height: 350px;float: left;width: auto;min-width: 510px; position: relative;">
        <div class="col-md-9 no-float col-sm-8half" id="map" style="width: 100%;height: 100%;">Loading..</div>
        <div class="form-groupx" style="position: absolute;z-index: 20000; height: 38px;padding:2px;background-color: white;top: 308px;left: 10px;width: 460px">
            <div style="margin:0px;padding: 0px;width: 155px;float: left;">
                <input type="text" class="form-control" aria-describedby="nameHelp" name="search_text" id="search_text" placeholder="Search">
            </div>
            <div style="padding-right: 0px;padding-left: 10px;width: 150px;float: left;">
                <select class="form-control" id="content_search_cat">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{$cat->id}}" >{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
            <div style="padding-right: 0px;padding-left: 10px;width: 150px;float: left;">
                <buttonc class="btn btn-primary" onclick="searchVideo()">Search</buttonc>
                <buttonc class="btn btn-primary" onclick="resetSearch()">Reset</buttonc>
            </div>
        </div>
        <input type="hidden" id="_token" value="{{$_token}}" />
    </div>

    {{--<div id="loading">--}}
        {{--<div class="loading-indicator">--}}
            {{--<div class="progress progress-striped active">--}}
                {{--<div class="progress-bar progress-bar-info progress-bar-full"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}





@endsection