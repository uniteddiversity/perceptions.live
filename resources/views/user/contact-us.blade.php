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
          <select class="form-control" name="subject">
            <option @if(old('subject')=='general message' ) selected='selected' @endif value="general message">General message</option>
            <option @if(old('subject')=='feature request' ) selected='selected' @endif value="feature request">Feature request</option>
            <option @if(old('subject')=='feedback' ) selected='selected' @endif value="feedback">Feedback</option>
            <option @if(old('subject')=='questions' ) selected='selected' @endif value="questions">Questions</option>
            <option @if(old('subject')=='partnerships' ) selected='selected' @endif value="partnerships">Partnerships</option>
            <option @if(old('subject')=='troubleshooting' ) selected='selected' @endif value="troubleshooting">Troubleshooting</option>
            <option @if(old('subject')=='other' ) selected='selected' @endif value="other">Other</option>
          </select>
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
          <button type="submit" class="btn btn-primary" style="background-color:#2B2B47; color: #ffffff;">Submit</button>
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
</style>
@endsection