@extends('layouts.app_inside')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Tag</h4>
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
                    <form action="/user/moderator/post-sorting-tag-add" method="post" enctype='multipart/form-data'>
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tag</label>
                            <input type="text" class="form-control" aria-describedby="nameHelp" name="tag" placeholder="Tag" value="{{ old('tag') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Short des</label>
                            <input type="text" class="form-control" aria-describedby="nameHelp" name="description" placeholder="Description" value="{{ old('description') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                        <br/><br/>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Public Tags</label>
                            <hr/>
                            @foreach($existing_tags as $tag)
                                <?php if($tag->group_id == 0){?>
                                    <span class="label label-info">@ {{$tag->tag}}</span> ,
                                <?php }?>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Private Tags</label>
                            <hr/>
                            @foreach($existing_tags as $tag)
                                <?php if($tag->group_id <> 0){?>
                                <span class="label label-warning">@ {{$tag->tag}}</span> ,
                                <?php }?>
                            @endforeach
                        </div>
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