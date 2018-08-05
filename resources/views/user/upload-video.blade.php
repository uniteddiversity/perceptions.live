@extends('layouts.app_inside')

@section('content')
    <div class="row">


        <div id="container-restx" class="col-md-8">
            <br/>
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
            <form action="/user/post-upload-video" method="post">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" aria-describedby="nameHelp" name="name" placeholder="Title" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Access Level</label>
                    <select class="form-control" id="exampleSelect1" name="access_level_id">
                        <option value="1">Public</option>
                        <option value="2">Only Registered</option>
                        <option value="3">Private</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Type</label>
                    <select class="form-control" id="exampleSelect1" name="type">
                        <option value="1">Uploaded Video</option>
                        <option value="2">Youtube Video</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleTextarea">Youtube Video</label>
                    <textarea name="content" class="form-control" id="exampleTextarea" rows="3">{{ old('content') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Youtube URL</label>
                    <input type="text" class="form-control" aria-describedby="nameHelp" name="url" placeholder="URL" value="{{ old('url') }}">
                    <small id="nameHelp" class="form-text text-muted">Youtube URL</small>
                </div>
                <fieldset class="form-group">
                    <legend>Location</legend>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="text" class="form-check-input" name="lat" placeholder="Lat" value="{{ old('lat') }}">
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="text" class="form-check-input" name="long" placeholder="Long" value="{{ old('long') }}">
                        </label>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>


@endsection
<script>
    var el = document.getElementById('loading');
    el.remove(); // Removes the div with the 'div-02' id
</script>