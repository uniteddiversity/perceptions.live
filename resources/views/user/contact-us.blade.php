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
                <h2 align=center class="card-title">Contact Us</h2>
                <div class="pagedesc" align="center">
                    <p>Feel free to contact us here.</p>
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
                    <div class="footer">
                        <div style="padding-bottom: 20px;"><a href="/"><- Return to PRCPTIONS.LIVE</a>
                    </div>
                        &copy; 2018 PRCPTION Travel, Inc.</div>

                </div>
            </div>
        </div>
    </div>
<style>
    .pagedesc {
        font-size: 20px;
        font-family: questrial;
        line-height: 1em;
        padding-bottom: 20px;
    }

    .formdesctext {
        color: slategray;
         font-size: 12px;
         font-style: italic;
         font-family: questrial;
         line-height: 1em;
         padding-bottom: 10px;
     }

    .footer { margin-top: 60px; width: 100%; margin: auto; text-align: center; font-size: 12px; color: slategray; }

.footer a {
    color: #2B2B47;
    font-size: 20px;
}

hr { padding-top: 20px; padding-bottom: 20px; }

.claimprofile { width: 50%; margin: auto; padding-top: 40px; }

</style>

@endsection
