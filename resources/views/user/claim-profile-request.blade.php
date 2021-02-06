@extends('layouts.app_layout')

@section('content')
<?php
$data = array();
$data['proof_images'] = array();
?>
<div class="card form-card">
  <div class="card-body">
    <div class="table-responsive">
      <div class="form-header">
        <h2 class="card-title">{{__('backend.claim_group_or_user_profile', ['name1' => __('group'), 'name2' => __('user')])}}</h2>
        <p class="page-desc">
          In order to effectively network the communities of the world, the {{config('app.name')}} platform automatically creates 'shadow profiles' of users and groups who are featured in media yet not yet registered in the system.<br>
          If you happen upon a shadow profile that is you, please fill out this form to claim it and activate your account.
        </p>
      </div>
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
          <label for="display_name">Select the display name you wish to claim: </label>
          <?php /* <select class="form-control" id="display_name_for_claim" name="display_name">
                  <option value="">select display name</option>
                  @foreach($user_list as $user)
                      <option value="{{$user->id}}" >{{$user->display_name}}</option>
                  @endforeach
              </select> */ ?>
          <select class="display-name-select-ajax form-control" name="display_name">
            <option>Search Here</option>
          </select>
        </div>

        <div class="form-group">
          <label for="video_profile">Confirm the videos you've seen yourself in: </label>
          <select class="form-control multi-select2" multiple id="claim_video_profile" name="claim_video_profile[]">

          </select>
        </div>

        <div class="form-group">
          <input type="checkbox" name="confirm_selected_content" id="confirm_selected_content" value="1" />
          <label for="confirm_selected_content"> I confirm that this is my involvement, appearance, and/or content in these videos.</label>
        </div>
        <hr>
        <div class="form-group">
          <label for="accept_tos">Relevant Proof of Identity </label>
          <div class="formdesctext">
            <em>Please upload some evidence that you are who you claim to be, like a selfie or personal document. If you have nothing else, please upload a selfie. </em>
          </div>
          <input class="form-control" type="file" multiple name="proof_of_work[]" />

          <?php foreach ($data['proof_images'] as $img) { ?>
            <li><a target="_blank" href="/storage/<?php echo $img->url ?>"><?php echo $img->name ?></a> </li>
          <?php } ?>
        </div>

        <div class="form-group">
          <label for="additional_comments">Additional Information, Comments or Requests</label>
          <textarea class="form-control" placeholder="(your name, location, organization, participation)" rows="5" name="additional_comments">{{ old('additional_comments') }}</textarea>
        </div>
        <hr>
        <div class="form-group">
          <label for="email">Your E-mail Address</label>
          <input type="text" class="form-control" name="email" id="email">
        </div>

        <div class="form-group">
          @if(config('app.g_recaptcha_key'))
          <div class="g-recaptcha" data-sitekey="{{config('app.g_recaptcha_key')}}">
          </div>
          @endif
        </div>

        <div class="form-group">
          <input type="checkbox" name="accept_tos" id="accept_tos" value="1" />
          <label for="password" style="float: none"> I have read and understand {{config('app.name')}} <a target="_blank" href="https://perceptiontravel.tv/terms-of-service/">Terms of Service</a>.</label>
        </div>
        <div class="form-footer">
          <button type="submit" class="btn btn-submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<style>
  .main-body {
    margin-bottom: 60px
  }
  .card {
    float: none;
    margin: auto;
  }

  .form-header {
    margin-bottom: 20px;
    padding: 20px 40px;
    border-bottom: 2px solid #e6defc;
    font-family: 'Open Sans', sans-serif;
  }

  .form-header .card-title {
    font-size: 32px;
    font-weight: 600;
    line-height: 1.1;
    color: #4214c7;
    margin-bottom: 10px;
  }

  .form-header .page-desc {
    font-size: 14.4px;
    line-height: 20px;
    font-style: normal;
    text-align: left;
    color: #797979;
    margin-bottom: 0
  }

  .table-responsive form .form-group {
    float: none
  }
  .table-responsive form .form-group label {
    float: none;
  }

  .form-footer {
    padding: 20px 40px;
    background: #e6defc;
    text-align: left;
  }

  .form-footer button {
    margin: 0 !important;
    float: none
  }

  .table-responsive form hr {
    padding: 10px;
    border-top: 2px solid #e6defc;
  }

  @media only screen and (max-width: 576px) {
    .main-body .card {
      width: 100%;
    }
  }
</style>
@endsection