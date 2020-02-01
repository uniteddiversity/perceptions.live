@extends('layouts.app_layout')

@section('content')
<?php
$data = array();
$data['proof_images'] = array();
?>
<div class="card form-card">
  <div class="card-body" style="min-width: 400px; max-width: 800px; margin-left: auto; margin-right: auto; padding-bottom: 60px;">
    <div class="table-responsive">
      <div class="form-header">
        <h2 class="card-title">Contact Us</h2>
        <p class="page-desc">Feel free to contact us here.</p>
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


      <form action="/contact-us-post" method="post" enctype='multipart/form-data'>
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <div class="form-group">
          <label for="display_name">Name </label>
          <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}" />
        </div>

        <div class="form-group">
          <label for="display_name">Email </label>
          <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" />
        </div>
        <div class="form-group">
          <label for="Subject">Subject </label>
          <div class="custom_select">
            <select class="form-control" name="subject">
              <option @if(old('subject')=='general message' ) selected='selected' @endif value="general message">General Message</option>
              <option @if(old('subject')=='feature request' ) selected='selected' @endif value="feature request">Feature Request</option>
              <option @if(old('subject')=='feedback' ) selected='selected' @endif value="feedback">Feedback</option>
              <option @if(old('subject')=='questions' ) selected='selected' @endif value="questions">Questions</option>
              <option @if(old('subject')=='partnerships' ) selected='selected' @endif value="partnerships">Partnerships</option>
              <option @if(old('subject')=='troubleshooting' ) selected='selected' @endif value="troubleshooting">Troubleshooting</option>
              <option @if(old('subject')=='other' ) selected='selected' @endif value="other">Other</option>
            </select>
          </div>  
        </div>

        <div class="form-group">
          <label for="additional_comments">Message</label>
          <textarea class="form-control" placeholder="Message" rows="5" name="message">{{ old('message') }}</textarea>
        </div>

        <div class="form-group">
          @if(env('GOOGLE_RECAPTCHA_KEY'))
          <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
          </div>
          @endif
        </div>

        <div class="form-footer">
          <button type="submit" class="btn btn-submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<style>
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
  .form-footer {
    padding: 20px 40px;
    background: #e6defc;
    text-align: left;
  }

  .form-footer button {
    margin: 0 !important;
    float: none
  }

  @media only screen and (max-width: 576px) {
    .main-body .card {
      width: 100%;
    }
  }
</style>
@endsection