@extends('layouts.app')

@section('content')
    <div id="loading">
        <div class="loading-indicator">
            <div class="progress progress-striped active">
                <div class="progress-bar progress-bar-info progress-bar-full"></div>
            </div>
        </div>
    </div>
    <div class="<?php if($user = Auth::user()){ ?>col-md-6<?php }else{ ?> col-md-9 <?php } ?> no-float col-sm-8half" id="map">Loading..</div>
@endsection