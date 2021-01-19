@extends('layouts.app_inside')

@section('content')
<?php
$saved_types = !isset($saved_types)? [] : $saved_types;
$saved_contents = !isset($saved_contents)? [] : $saved_contents;
$data = !isset($data)? [] : $data;
$data['title'] = isset($data['title'])? $data['title'] : '';
$data['image_url'] = isset($data->image) && isset($data->image[0])? $data->image[0]->url : '';
?>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Home Slide Feed Settings</h4>
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
                <form action="/user/admin/post-home-slider-feed" method="post" enctype='multipart/form-data'>
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <input type="hidden" name="id" value="<? echo $data['id'] ?>" />
                    <?php if(!empty($data['id'])){ ?>
                        <input type="hidden" name="id" id="id" value="{{ uid($data['id']) }}" />
                    <?php } ?>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Side</label>
                        <select class="form-control multi-select2" id="group_roles" name="side" >
                            @foreach(array('left','right') as $side)
                            <option <?php if(isset($data['side']) && $data['side'] == $side ){ echo 'selected="selected"'; } ?> value="<?php echo $side ?>" <?php if($side == old('side')){ echo 'selected'; } ?> >{{$side}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" aria-describedby="nameHelp" name="title" placeholder="Title" value="{{ old('title', $data['title']) }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Type</label>
                        <select multiple class="form-control multi-select2" id="slider_type" name="type[]" >
                            @foreach(array('category','group','GCI') as $type)
                            <option <?php if(isset($saved_types[$type]) && $saved_types[$type] == $type ){ echo 'selected="selected"'; } ?> value="<?php echo $type ?>" <?php if($type == old('type')){ echo 'selected'; } ?> >{{$type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Content</label>
                        <select data-name="selection val" multiple class="content-type-select-ajax form-control" name="fk_id[]">
                            <option>Search Here</option>
                            @foreach($saved_contents as $key => $text)
                                <option <?php echo 'selected="selected"'; ?> value="<?php echo $key ?>" >{{$text}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Icon</label>
                        <input class="form-control" type="file" name="icon" />
                    </div>
                    <?php if(!empty($data['image_url'])){ ?>
                    <div class="form-group">
                        <img src="<?php echo '/storage/'.$data['image_url'] ?>" width="100" />
                    </div>
                    <?php } ?>
                    <button type="submit" class="btn btn-primary">{{__('backend.submit')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
<script>
    // var el = document.getElementById('loading');
    // el.remove(); // Removes the div with the 'div-02' id
</script>
<style>
    .select2-container .select2-selection--single {
        height: 46px !important;
    }
</style>