@extends('layouts.app_home')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" id="map" style="min-height: 500px;">

                </div>
            </div>
        </div>
    </div>
<input type="hidden" id="_location_id" value="{{$location_id}}" />
@endsection