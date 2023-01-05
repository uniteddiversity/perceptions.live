@extends('layouts.app_inside')

@section('content')
    <?php

    $data = array();
    $data['id'] = isset($edit_data['id'])?$edit_data['id']: '0';
    $data['name'] = isset($edit_data['name'])?$edit_data['name']: '';
    $data['description'] = isset($edit_data['description'])?$edit_data['description']: '';
    $data['free_storage'] = isset($edit_data['free_storage'])?$edit_data['free_storage']: '';
    $data['charge_per_minute'] = isset($edit_data['charge_per_minute'])?$edit_data['charge_per_minute']: '0';
    $data['discount'] = isset($edit_data['discount'])?$edit_data['discount']:'';
    ?>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{__('backend.video_package_manage', ['name' => __('video')])}}</h4>
                <div class="table-responsive">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
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

                        <?php if($data['id'] == 0){ ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th><th>Description</th><th>Free Storage</th><th>Charge per minute</th><th>Discount</th><th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($packages as $package){ ?>
                                <tr>
                                    <td>{{$package['name']}}</td><td>{{$package['description']}}</td><td>{{$package['free_storage']}}</td><td>{{$package['charge_per_minute']}}</td><td>{{$package['discount']}}</td><td><a href="/user/admin/package-manager/{{$package['id']}}">Edit</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } ?>


                        <?php if($data['id'] > 0){ ?>
                        <form action="/user/admin/update-package-manager" method="post" id="submit_content" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" name="id" id="csrf-token" value="<?php echo $data['id'] ?>" />

                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="name" placeholder="Title" value="{{ old('title',$data['name']) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea">Description</label>
                                <input type="text" class="form-control" id="description" aria-describedby="nameHelp" name="description" placeholder="Description" value="{{ old('description',$data['description']) }}">
                            </div>
                            {{--<div class="form-group">--}}
                            {{--<label for="video_id">Minimum Minutes</label>--}}
                            {{--<input type="text" class="form-control" id="leaflet_search_addr" aria-describedby="nameHelp" name="location" placeholder="Location" value="{{ old('location',$data['location']) }}">--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="video_id">Maximum Minutes</label>--}}
                            {{--<input type="text" class="form-control" id="leaflet_search_addr" aria-describedby="nameHelp" name="location" placeholder="Location" value="{{ old('location',$data['location']) }}">--}}
                            {{--</div>--}}
                            <div class="form-group">
                            <label for="video_id">Charge Per Minutes</label>
                            <input type="text" class="form-control" id="charge_per_minute" aria-describedby="nameHelp" name="charge_per_minute" placeholder="Charge Per Minute" value="{{ old('charge_per_minute',$data['charge_per_minute']) }}">
                            </div>

                            <div class="form-group">
                                <label for="video_id">Free Storage (MB)</label>
                                <input type="text" class="form-control" id="free_storage" aria-describedby="nameHelp" name="free_storage" placeholder="Free Storage" value="{{ old('free_storage',$data['free_storage']) }}">
                            </div>
                            <div class="form-group">
                                <label for="video_id">Discount(%)</label>
                                <input type="text" class="form-control" id="discount" aria-describedby="nameHelp" name="discount" placeholder="Discount" value="{{ old('discount',$data['discount']) }}">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </form>
                        <?php } ?>

                </div>
            </div>
        </div>
    </div>


    @endsection
