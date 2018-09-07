@extends('layouts.shared_content_layout')



@section('content')
    <div style="float: left;max-width: 320px;">
        @include('partials.shared_left-side-bar')
    </div>
    <div id="map_position" style="height: 350px;float: left;width: auto;min-width: 510px; position: relative;">
        <div class="col-md-9 no-float col-sm-8half" id="map" style="width: 100%;height: 100%;">Loading..</div>
        <div class="form-groupx" style="position: absolute;z-index: 20000; height: 38px;padding:2px;background-color: transparent;top: 308px;">
            <?php echo $search_elements ?>
        </div><?php //dd($basic_info['lat']) ?>
        <input type="hidden" id="_token" value="{{$_token}}" />
        <input type="hidden" id="default_zoom" value="<?php echo (!isset($basic_info['default_zoom_level']) || $basic_info['default_zoom_level'] == 0 || empty($basic_info['default_zoom_level']))?'2':$basic_info['default_zoom_level'] ?>" />
        <input type="hidden" id="default_lat" value="<?php echo (!isset($basic_info['lat']) || $basic_info['lat'] == 0 || empty($basic_info['lat']))?'10.0':$basic_info['lat'] ?>" />
        <input type="hidden" id="default_long" value="<?php echo (!isset($basic_info['long']) || $basic_info['long'] == 0 || empty($basic_info['long']))?'5.0':$basic_info['long'] ?>" />
    </div>

    {{--<div id="loading">--}}
        {{--<div class="loading-indicator">--}}
            {{--<div class="progress progress-striped active">--}}
                {{--<div class="progress-bar progress-bar-info progress-bar-full"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}





@endsection