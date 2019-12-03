@extends('layouts.app_just_styles')

@section('content')
<?php
$data = array();
$data['proof_images'] = array();

?>

<div class="page-contact-us">
  <div class="page-top">
    <a href="/"><img src="/assets/findgo/images/live-perceptions-logo.png"></a>
  </div>
  <div class="page-content">
    <div class="claimprofile">
      <h2 class="card-title">Contact Us</h2>
      <p class="page-desc">Feel free to contact us here.</p>
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
                  <option @if(old('subject') == 'general message') selected='selected' @endif value="general message">General message</option>
                  <option @if(old('subject') == 'feature request') selected='selected' @endif  value="feature request">Feature request</option>
                  <option @if(old('subject') == 'feedback') selected='selected' @endif value="feedback">Feedback</option>
                  <option @if(old('subject') == 'questions') selected='selected' @endif value="questions">Questions</option>
                  <option @if(old('subject') == 'partnerships') selected='selected' @endif value="partnerships">Partnerships</option>
                  <option @if(old('subject') == 'troubleshooting') selected='selected' @endif value="troubleshooting">Troubleshooting</option>
                  <option @if(old('subject') == 'other') selected='selected' @endif value="other">Other</option>
                </select>
            </div>
  
            <div class="form-group">
                <label for="additional_comments">Message</label>
                <textarea class="form-control" placeholder="Message" rows="5" name="message">{{ old('message') }}</textarea>
            </div>
  
            <div class="form-group">
                @if(env('GOOGLE_RECAPTCHA_KEY'))
                <div class="g-recaptcha"
                      data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                </div>
                @endif
            </div>
  
  
            <button type="submit" class="btn btn-primary" style="background-color:#2B2B47; color: #ffffff;">Submit</button>
        </form>
      </div>
    </div>
  </div>
  <div class="page-bottom">
      <a href="/">&lt; Return to PRCPTIONS.LIVE</a>
      <span class="copyright">&copy; 2018 PRCPTION Travel, Inc.</span>
  </div>
</div>
<style>
.page-contact-us .page-top {
  background: white;
  text-align: center;
  border-radius: 5px;
}
.page-contact-us .page-top a img {
  max-height: 70px;
  margin: auto;
}
.page-contact-us .page-content {
  padding: 20px;
  background: #f8f8f8;
}
.page-contact-us .page-content .claimprofile {
  max-width: 500px;
  margin: auto;
} 
.page-contact-us .page-content .claimprofile .card-title {
  font-size: 2rem;
  text-align: center;
}
.page-contact-us .page-content .claimprofile .page-desc {
  font-size: 1rem;
  text-align: center;
}
.page-contact-us .page-content .select2-container {
  max-width: 100%;
}
.page-contact-us .page-bottom {
  background: white;
  padding: 10px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: #4214c7;
}
.page-contact-us .page-bottom a {
  color: #4214c7;
  text-decoration: none;
  transition: color .3s ease-in-out;
}
.page-contact-us .page-bottom a:hover {
  color: #333;
}
@media screen and (max-width: 767px) {
  .page-contact-us .page-content .claimprofile .card-title {
    font-size: 1.5rem;
  }
  .page-contact-us .page-content .claimprofile .page-desc {
    font-size: 14px;
  }
  .page-claim-profile .page-content {
    padding: 10px;
  }
  .page-contact-us .page-bottom {
    flex-direction: column;
    justify-content: center;
  }
  .page-contact-us .page-bottom a {
    margin-bottom: 10px;
  }
}
</style>

@endsection
