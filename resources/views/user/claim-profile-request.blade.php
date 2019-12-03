@extends('layouts.app_just_styles')

@section('content')
<?php
$data = array();
$data['proof_images'] = array();

?>

<div class="page-claim-profile">
  <div class="page-top">
    <a href="/"><img src="/assets/findgo/images/live-perceptions-logo.png"></a>
  </div>
  <div class="page-content">
    <div class="claimprofile">
      <h2 class="card-title">Claim A Group or User Profile</h2>
      <div class="page-desc">
        <p>In order to effectively network the communities of the world, the PRCPTIONS.LIVE platform automatically creates 'shadow profiles' of users and groups who are featured in media yet not yet registered in the system.</p>
        <p>If you happen upon a shadow profile that is you, please fill out this form to claim it and activate your account.</p>
      </div>
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
  
                <?php foreach($data['proof_images'] as $img){ ?>
                <li><a target="_blank" href="/storage/<?php echo $img->url ?>"><?php echo $img->name ?></a> </li>
                <?php } ?>
            </div>
  
            <div class="form-group">
                <label for="additional_comments">Additional Information, Comments or Requests</label>
                <textarea class="form-control" placeholder="(your name, location, organization, participation)" rows="5" name="additional_comments">{{ old('additional_comments') }}</textarea>
            </div>
                <hr style="padding: 10px;">
            <div class="form-group">
                <label for="email">Your E-mail Address</label>
                <input type="text" class="form-control" name="email" id="email">
            </div>
  
            <div class="form-group">
                @if(env('GOOGLE_RECAPTCHA_KEY'))
                <div class="g-recaptcha"
                      data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                </div>
                @endif
            </div>
  
            <div class="form-group">
                <input type="checkbox" name="accept_tos" id="accept_tos" value="1" />
                <label for="password"> I have read and understand PRCPTION Travel's <a target="_blank" href="https://perceptiontravel.tv/terms-of-service/">Terms of Service</a>.</label>
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
.page-claim-profile .page-top {
  background: white;
  text-align: center;
  border-radius: 5px;
}
.page-claim-profile .page-top a img {
  max-height: 70px;
  margin: auto;
}
.page-claim-profile .page-content {
  padding: 20px;
  background: #f8f8f8;
}
.page-claim-profile .page-content .claimprofile {
  max-width: 600px;
  margin: auto;
} 
.page-claim-profile .page-content .claimprofile .card-title {
  font-size: 2rem;
  text-align: center;
}
.page-claim-profile .page-content .claimprofile .page-desc p {
  font-size: 1rem;
  text-align: center;
}
.page-claim-profile .page-bottom {
  background: white;
  padding: 10px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: #4214c7;
}
.page-claim-profile .page-bottom a {
  color: #4214c7;
  text-decoration: none;
  transition: color .3s ease-in-out;
}
.page-claim-profile .page-bottom a:hover {
  color: #333;
}
@media screen and (max-width: 767px) {
  .page-claim-profile .page-content .claimprofile .card-title {
    font-size: 1.5rem;
  }
  .page-claim-profile .page-content .claimprofile .page-desc p {
    font-size: 14px;
  }
  .page-claim-profile .page-content {
    padding: 10px;
  }
  .page-claim-profile .page-bottom {
    flex-direction: column;
    justify-content: center;
  }
  .page-claim-profile .page-bottom a {
    margin-bottom: 10px;
  }
}
</style>

@endsection
