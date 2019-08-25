@extends('layouts.app_inside')

@section('content')
<?php
$data['home_centered_title'] = isset($settings['home_centered_title'])?$settings['home_centered_title']:'';
?>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Site Settings</h4>
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
                <form action="/user/admin/post-site-settings" method="post" enctype='multipart/form-data'>
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                    <div class="form-group">
                        <label for="exampleInputEmail1">Home Centered Title</label>
                        <input type="text" class="form-control" aria-describedby="nameHelp" name="settings[home_centered_title]" placeholder="Home Centered Title" value="{{ old('home_centered_title',$data['home_centered_title']) }}">
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
<script>
    var el = document.getElementById('loading');
    el.remove(); // Removes the div with the 'div-02' id
</script>