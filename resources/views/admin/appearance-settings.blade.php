@extends('layouts.app_inside')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card" id="user_content_add">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Terms</h4>
                <div class="table-responsive">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                <?php //dd($errors) ?>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <form action="/user/admin/setting/appearance" method="post" id="submit_content" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Default location</label>
{{--                                    <input type="text" class="form-control" aria-describedby="nameHelp" name="default_location" placeholder="New York, USA" value="{{$default_location}}">--}}
                                    <label for="leaflet_search_addr">Default Location</label>
                                    <input onkeyup="addr_search_new()" type="text" class="form-control" id="leaflet_search_addr" aria-describedby="nameHelp" name="default_location" placeholder="Where does the map start?" value="{{ old('default_location',Setting::get('site_settings.default_location')) }}">
                                    <input type="hidden" class="form-control" aria-describedby="nameHelp" id="lat_val" name="lat" placeholder="default_location_lat" value="{{ old('lat',$default_location_lat) }}">
                                    <input type="hidden" class="form-control" aria-describedby="nameHelp" id="long_val" name="long" placeholder="default_location_long" value="{{ old('long',$default_location_long) }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Default zoom(23 > zoom > 0 )</label>
                                    <input type="text" class="form-control" aria-describedby="nameHelp" name="default_zoom" placeholder="5" value="{{$default_zoom}}">
                                </div>

                                <label for="exampleInputEmail1">Frontend style</label>
                                <div style="clear: both" ></div>
                                <br/>
                                <textarea class="form-control" name="front_css" id="front_editor">{{$css}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('backend.submit')}}</button>
                        </form>
                </div>
            </div>
        </div>
    </div>


    @endsection
@section('styles')
<link rel="stylesheet" href="/assets/js/code_editor/lib/codemirror.css" />
@endsection
@section('scripts')
{{--<script src="https://unpkg.com/codeflask/build/codeflask.min.js" ></script>--}}
<script src="/assets/js/code_editor/lib/codemirror.js"></script>
{{--<script>--}}
{{--    const flask = new CodeFlask('#front_editor', {--}}
{{--        language: 'js',--}}
{{--        lineNumbers: true--}}
{{--    });--}}
{{--</script>--}}

<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("front_editor"), {
        lineNumbers: true,
        tabSize: 4,
        indentUnit: 4,
        indentWithTabs: true,
        mode: "text/x-csrc"
    });
</script>
@endsection
