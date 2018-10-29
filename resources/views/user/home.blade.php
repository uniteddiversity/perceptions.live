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
                            <div id="map" class="map" style="height: 100%;">&nbsp;</div>
                        </div>


                    </div>
                </div>
            </div>
			
        </div>
		
    </section>

<div class="footer">
	<span style="display: block; padding-bottom: 7px; margin: auto;">
	<a href="https://perceptiontravel.tv/privacy-policy" target="_blank">Privacy Policy</a> | <a href="https://perceptiontravel.tv/terms-of-service" target="_blank">Terms of Service</a> | <a href="https://perceptiontravel.tv/community-feedback/" target="_blank">Submit Your Feedback</a></span>
	<span>
	<strong>&copy; 2018 <a href="https://perceptiontravel.tv/" target="_blank"></a>PRCPTION Travel, Inc.</a> - A non-profit, 501(c)3 organization.</strong></span>
		
		</div>

@endsection