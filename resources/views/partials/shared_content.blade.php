@extends('layouts.shared_content_layout')



@section('content')
    <div style="float: left;max-width: 320px;">
        @include('partials.shared_left-side-bar')
    </div>
    <div class="col-md-9 no-float col-sm-8half" id="map" style="height: 350px;float: left;width: auto;min-width: 450px;">Loading..</div>
    {{--<div id="loading">--}}
        {{--<div class="loading-indicator">--}}
            {{--<div class="progress progress-striped active">--}}
                {{--<div class="progress-bar progress-bar-info progress-bar-full"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <input type="hidden" id="_token" value="{{$_token}}" />

@endsection