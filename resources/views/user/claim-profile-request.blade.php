@extends('layouts.app_just_styles')

@section('content')
<?php
$data = array();
$data['proof_images'] = array();

?>

<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div style="width:100%; background:#2B2B47; text-align: center; padding-bottom:25px;">
                 <a href="/"><img src="/assets/findgo/images/live-perceptions-logo.png" width="600" height="122"></a>
                </div>
                <div class="claimprofile">
                <h3 align=center class="card-title">Claim A Username</h3>
                <div class="pagedesc" align="center">
                <em>The PRCPTIONS.live platform creates 'shadow profiles' of users featured in a piece of but not actually registered for the site. If you happen to stumble upon a shadow profile that is you, please fill out this form to claim it as your own.</em>
                </div>
                    <hr>
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
                                <select class="form-control" id="display_name_for_claim" name="display_name">
                                    <option value="">select display name</option>
                                    @foreach($user_list as $user)
                                        <option value="{{$user->id}}" >{{$user->display_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="video_profile">Confirm the videos you've seen yourself in: </label>
                                <select class="form-control multi-select2" multiple id="claim_video_profile" name="claim_video_profile[]">

                                </select>
                            </div>
<hr>
                            <div class="form-group">
                                <input type="checkbox" name="confirm_selected_content" id="confirm_selected_content" value="1" />
                                <label for="confirm_selected_content"> I confirm that this is my involvement, appearance, and/or content in these videos.</label>

                            </div>

                            <div class="form-group">
                                <label for="accept_tos">Relevant Proof of Identity</label>
                                <div class="formdesctext">
                                    <em>Please upload some evidence that you are who you claim to be (i.e. selfie or personal document) </em>
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
                                <input type="text" name="email" id="email">
                            </div>

                            <div class="form-group">
                                <input type="checkbox" name="accept_tos" id="accept_tos" value="1" />
                                <label for="password"> I have read and understand PRCPTION Travel's <a href="https://perceptiontravel.tv/terms-of-service/">Terms of Service</a>.</label>
                            </div>


                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <div class"formtextbottom">
                            <a href="/"><- Return to PRCPTIONS.LIVE</a>
                        </div>
                    <div class="footer">&copy; 2018 PRCPTION Travel, Inc.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<style>
    .pagedesc {
        font-size: 18px;
        font-style: italic;
        font-family: questrial;
        line-height: 1.6em;
        padding-bottom: 40px;
    }

    .formdesctext {
         font-size: 14px;
         font-style: italic;
         font-family: questrial;
         line-height: 1.2em;
         padding-bottom: 10px;
     }

    .footer { width: 100%; margin: auto; text-align: center; font-size: 12px; color: slategray; }

.formtextbottom a {
    padding-top: 20px;
}

.claimprofile { width: 50%; margin: auto; padding-top: 40px; }
</style>

@endsection
