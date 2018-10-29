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
			<div class="footer">text footer text &copy; 2018 PRCPTION Travel, Inc.</div>
        </div>
		
    </section>


@endsection