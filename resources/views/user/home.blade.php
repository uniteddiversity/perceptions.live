@extends('layouts.app')

@section('content')
<?php //dd($gci_tags); ?>
    @include('partials.nav-bar')
    <section>
        <div class="block no-padding">
            <div class="container fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ml-filterslide">
                            @include('partials.home-left-advance-search-bar')

                            <div class="ml-listings fakeScroll fakeScrolls">
                                @include('partials.home-left-side-bar')
                            </div>
                        </div>

                        <div class="half-map" style="height: 100%;">
                            <div id="map" class="map" style="height: 100%;margin-left:30px;">&nbsp;</div>
                            <div class="participate" style="height: 100%;">
                               <i class="fas fa-cloud-upload-alt pointer" style="cursor:pointer" onclick="window.location='/user/content-add'"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
        </div>
		
    </section>

<div class="footer">
	<span style="display: block; padding-bottom: 7px; margin: auto;">
	<a href="https://perceptiontravel.tv/privacy-policy" target="_blank">Privacy Policy</a> | <a href="https://perceptiontravel.tv/terms-of-service" target="_blank">Terms of Service</a> | <a href="https://perceptiontravel.tv/community/donations/" target="_blank">Make a Donation</a> | <a href="https://perceptiontravel.tv/community-feedback/" target="_blank">Submit Feedback</a> | <a href="/contact-us" target="_blank">Contact Us</a></span>
	<span>
	<strong>&copy; 2018 <a href="https://perceptiontravel.tv/" target="_blank">PRCPTION Travel, Inc.</a> - a non-profit, 501(c)3 organization.</strong></span>
		
		</div>

@endsection