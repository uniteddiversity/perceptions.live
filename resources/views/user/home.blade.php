@extends('layouts.app')

@section('content')
    <div id="loading">
        <div class="loading-indicator">
            <div class="progress progress-striped active">
                <div class="progress-bar progress-bar-info progress-bar-full"></div>
            </div>
        </div>
    </div>
    <div class="col-md-8 no-float col-sm-8half" id="map">Loading..</div>
@endsection