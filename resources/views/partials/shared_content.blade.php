@extends('layouts.shared_content_layout')

@section('content')
<div class="sh_container">
    <div class="right">
        @include('partials.shared_left-side-bar')
    </div>
    <div class="left" style="position: relative">
        <div id="map" style="width: 100%;height: 100%;">Loading..</div>
        <a target="_blank" href="https://www.perceptions.live"><div class="sh_watermark" ></div></a>
        <div class="form-groupx" style="left: 40px;position: absolute;z-index: 2; height: 38px;padding:2px;background-color: transparent;bottom: 12px;">
        <?php echo $search_elements ?>

    </div>
        <div id="custom-popup-upload-close">
            <a href="#" class="participate" id="step2">
                <i class="fas fa-cloud-upload-alt pointer" style="cursor:pointer"></i>
            </a>
        </div>
</div>
    @include('partials.home-upload-popup');
<style>

</style>
    <style>
        .dot {
            height: 22px;
            width: 22px;
            border-radius: 50%;
            display: inline-block;
            margin: 2px;
            cursor: pointer;
        }

        .dot-small {
            height: 10px;
            width: 10px;
            border-radius: 50%;
            display: inline-block;
            margin: 2px;
            cursor: pointer;
        }

        .leaflet-popup-content{
            margin: 0px;
        }
    </style>
<!--    <div id="map_position" style="height: 350px;float: left;width: auto;min-width: 900px; position: relative;">-->
<!--        <div id="map" style="width: 100%;height: 100%;">Loading..</div>-->
<!--        <div class="form-groupx" style="position: absolute;z-index: 2; height: 38px;padding:2px;background-color: transparent;top: 308px;">-->
<!--            --><?php //echo $search_elements ?>
<!--        </div>--><?php ////dd($basic_info['lat']) ?>
        <input type="hidden" id="_token" value="{{$_token}}" />
        <input type="hidden" id="default_zoom" value="<?php echo (!isset($basic_info['default_zoom_level']) || $basic_info['default_zoom_level'] == 0 || empty($basic_info['default_zoom_level']))?'2':$basic_info['default_zoom_level'] ?>" />
        <input type="hidden" id="default_lat" value="<?php echo (!isset($basic_info['lat']) || $basic_info['lat'] == 0 || empty($basic_info['lat']))?'10.0':$basic_info['lat'] ?>" />
        <input type="hidden" id="default_long" value="<?php echo (!isset($basic_info['long']) || $basic_info['long'] == 0 || empty($basic_info['long']))?'5.0':$basic_info['long'] ?>" />
<!--    </div>-->
@endsection