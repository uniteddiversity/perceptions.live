@extends('layouts.app_inside')

@section('content')
<?php
//$data['greeting_message_to_community'] = isset($group['greeting_message_to_community'])?$group['greeting_message_to_community']:'';
//$data['name'] = isset($group['name'])?$group['name']:'';
//$data['description'] = isset($group['description'])?$group['description']:'';
//$data['current_mission'] = isset($group['current_mission'])?$group['current_mission']:'';
//$data['experience_knowledge_interests'] = isset($group['experience_knowledge_interests'])?$group['experience_knowledge_interests']:'';
//$data['default_location'] = isset($group['default_location'])?$group['default_location']:'';
//$data['category_id'] = isset($group['category_id'])?$group['category_id']:'';
//$data['learn_more_url'] = isset($group['learn_more_url'])?$group['learn_more_url']:'';

//    dd($data);
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
                    <?php if(!empty($data['id'])){ ?>
                        <input type="hidden" name="id" id="id" value="{{ uid($data['id']) }}" />
                    <?php } ?>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Side</label>
                        <select class="form-control multi-select2" id="group_roles" name="side" >
                            @foreach(array('left','right') as $side)
                            <option value="<?php echo $side ?>" <?php if($side == old('side')){ echo 'selected'; } ?> >{{$side}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" aria-describedby="nameHelp" name="title" placeholder="Title" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Type</label>
                        <select class="form-control multi-select2" id="slider_type" name="type" >
                            @foreach(array('category','group','GCI') as $type)
                            <option value="<?php echo $type ?>" <?php if($type == old('type')){ echo 'selected'; } ?> >{{$type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category/GCI/Group</label>
                        <select class="content-type-select-ajax form-control">
                            <option>Search Here</option>
                        </select>
                        <input type="hidden" id="type" name="type" />
                        <input type="hidden" id="fk_id" name="fk_id" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Icon</label>
                        <input class="form-control" type="file" name="icon" />
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
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