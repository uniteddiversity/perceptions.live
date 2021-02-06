@extends('layouts.app')

@section('content')
<?php //dd($gci_tags); ?>
<input type="hidden" id="default_location" value="<?php echo Setting::get('site_settings.default_location') ?>" />
<input type="hidden" id="default_location_lat" value="<?php echo Setting::get('site_settings.default_location_lat') ?>" />
<input type="hidden" id="default_location_long" value="<?php echo Setting::get('site_settings.default_location_long') ?>" />
<input type="hidden" id="default_zoom" value="<?php echo Setting::get('site_settings.default_zoom') ?>" />
@include('partials.nav-bar')
<section class="customContainer">
    <div class="block no-padding">
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ml-filterslide">
                        <span class="overlay" onclick="closeSideBarMenu(this)"></span>
                        @include('partials.home-left-advance-search-bar')

                        <div class="ml-listings fakeScroll fakeScrolls">
                            @include('partials.home-left-side-bar')
                        </div>

                        <div id="custom-popup-upload-close">
                            <a href="#" class="participate" id="step2">
                                <i class="fas fa-cloud-upload-alt pointer" style="cursor:pointer"></i>
                            </a>
                        </div>


                        @include('partials.nav-bar')

                    </div>

                    <div class="half-map" style="height: 100%;">
                        <div id="map" class="map" style="height: 100%;margin-left:30px;">&nbsp;</div>
                    </div>



                </div>
            </div>
        </div>

    </div>

</section>
<div class="arrowWrapper" id="arrowMapWrapper">
    <span class="arrow arrowleft" onclick="openSideBarMenu(this)"><i class="icon"></i></span>
    <span class="arrow arrowright" onclick="closeSideBarMenu(this)"><i class="icon"></i></span>
</div>


<div class="footer cookie_footer cookiebanner" id="cookiebanner">
    <span class="footer1">
     <strong>&nbsp;</strong>
    </span>
    <span class="footer2">
        <strong>{{ trans('cookieConsent::texts.title_cookiebanner') }}

{{--            <a href="#" class="inline__item cookiemonster__settings js-cookie-settings">{{ trans('cookieConsent::texts.settings_notice_gdpr') }}</a>--}}
        </strong>
        <a href="#" class="btn btn--brand cookiemonster__accept js-cookie-accept cookie-button">{{ trans('cookieConsent::texts.accept_notice_gdpr') }}</a>
    </span>
</div>

<div class="footer">
    <span class="footer1">
     <strong>   <a href="https://docs.perceptiontravel.tv/legal-docs/privacy-policy" target="_blank">Privacy Policy</a> | <a href="https://docs.perceptiontravel.tv/legal-docs/terms-of-service" target="_blank">Terms of Service</a> | <a href="https://perceptiontravel.tv/community/donations/" target="_blank">Make a Donation</a> | <a href="/contact-us" target="_blank">Submit Feedback</a> | <a href="https://docs.perceptiontravel.tv/" target="_blank">About Us</a> | <a href="/contact-us" target="_blank">Contact Us</a></strong></span>
    <span class="footer2">
        <a href="https://perceptiontravel.tv/" target="_blank">{{env('APP_CREDIT')}}</a> Powered by Perceptions.Live &copy; 2017-2021 PRCPTION Travel, Inc.</span>

</div>

@include('partials.group-info-popup_right');
@include('partials.home-upload-popup');

@if(isset($video_profile_id) && $video_profile_id)
<script>
    $(document).ready(function(){
        openVideo('{{$video_profile_id}}')
    })
</script>
@endif
@if(isset($user_profile_id) && $user_profile_id)
    <script>
        $(document).ready(function(){
            openProfile('{{$user_profile_id}}')
        })
    </script>
@endif
@if(isset($group_profile_id) && $group_profile_id)
    <script>
        $(document).ready(function(){
            openGroupProfile('{{$group_profile_id}}')
        })
    </script>
@endif
<script>
    $(window).load(function() {
        $('body').addClass('mapPageBody');
    })

</script>

@endsection
