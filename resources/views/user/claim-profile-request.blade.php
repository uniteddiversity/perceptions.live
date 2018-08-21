@extends('layouts.app_just_styles')

@section('content')
<?php
$data = array();
$data['proof_images'] = array();

?>

<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profile Settings</h4>
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
                        <form action="/claim-profile-post" method="post" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="form-group">
                                <label for="display_name">Display Name</label>
                                <select class="form-control" id="display_name_for_claim" name="display_name">
                                    <option value="">Select Display Name</option>
                                    @foreach($user_list as $user)
                                        <option value="{{$user->id}}" >{{$user->display_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="video_profile">Select video profiles for selected username</label>
                                <select class="form-control multi-select2" multiple id="claim_video_profile" name="claim_video_profile[]">

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="confirm_selected_content">I confirm that this is my involvement in these videos:</label>
                                <input type="checkbox" name="confirm_selected_content" id="confirm_selected_content" value="1" />
                            </div>

                            <div class="form-group">
                                <label for="additional_comments">Additional comments, (lost videos, requests, etc)</label>
                                <textarea class="form-control" placeholder="Additional comments, (lost videos, requests, etc)" rows="5" name="additional_comments">{{ old('additional_comments') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                            </div>

                            <div class="form-group">
                                <label for="accept_tos">Proof of Identity in existing video</label>
                                <input class="form-control" type="file" multiple name="proof_of_work[]" />

                                <?php foreach($data['proof_images'] as $img){ ?>
                                <li><a target="_blank" href="/storage/<?php echo $img->url ?>"><?php echo $img->name ?></a> </li>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label for="password">Terms of Service:</label>
                                <input type="checkbox" name="accept_tos" id="accept_tos" value="1" />
                            </div>


                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
