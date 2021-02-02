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
                        <form action="/user/admin/setting/terms" method="post" id="submit_content" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            @foreach($data['terms'] as $key => $term)
                            <div class="form-group">
                                <label for="exampleInputEmail1">Term - {{ucfirst($key)}}</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="term[{{$key}}]" placeholder="Title" value="{{$term}}">
                            </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary">{{__('backend.submit')}}</button>
                        </form>
                </div>
            </div>
        </div>
    </div>


    @endsection
    <script>
//        var el = document.getElementById('loading');
//        el.remove(); // Removes the div with the 'div-02' id
    </script>