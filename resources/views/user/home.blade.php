@extends('layouts.app')

@section('content')
<?php //dd($gci_tags); ?>
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
                        @include('partials.nav-bar')
                    <div id="custom-popup-upload-close">
                        <a href="#" class="participate" style="height:100%;">
                            <i class="fas fa-cloud-upload-alt pointer" style="cursor:pointer"></i>
                        </a>
                    </div>
                   {{--
                        <a href="/user/content-add" class="participate" style="height: 100%;">
                            <i class="fas fa-cloud-upload-alt pointer" style="cursor:pointer" onclick="window.location='/user/content-add'"></i>
                        </a>
                    </div>
                        --}}
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

<div class="footer">
    <span style="display: block; padding-bottom: 7px; margin: auto;">
     <strong>   <a href="https://docs.perceptiontravel.tv/legal-docs/privacy-policy" target="_blank">Privacy Policy</a> | <a href="https://docs.perceptiontravel.tv/legal-docs/terms-of-service" target="_blank">Terms of Service</a> | <a href="https://perceptiontravel.tv/community/donations/" target="_blank">Make a Donation</a> | <a href="/contact-us" target="_blank">Submit Feedback</a> | <a href="https://docs.perceptiontravel.tv/" target="_blank">About Us</a> | <a href="/contact-us" target="_blank">Contact Us</a></strong></span>
    <span style="color: #808080;">
        <strong>&copy; 2017-2020 <a href="https://perceptiontravel.tv/" target="_blank">PRCPTION Travel, Inc.</a> - a non-profit, 501(c)3 organization.</strong></span>

</div>

@include('partials.group-info-popup_right');
@include('partials.home-upload-popup');

<script>
    $(window).load(function() {
        $('body').addClass('mapPageBody');
    })

</script>

@endsection
