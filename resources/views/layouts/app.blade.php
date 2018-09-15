<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="CreativeLayers">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="/assets/findgo/css/bootstrap-grid.css" />
    <link rel="stylesheet" href="/assets/findgo/css/icons.css">
    <link rel="stylesheet" href="/assets/findgo/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/findgo/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/assets/findgo/css/responsive.css" />



    <link rel="stylesheet" type="text/css" href="/assets/css/leaflet_0.7.css" />
    {{--<link rel="stylesheet" href="/assets/css/leaflet.css">--}}
    {{--<link rel="stylesheet" href="/assets/css/MarkerCluster.css">--}}
    <link rel="stylesheet" href="/assets/css/MarkerCluster.Default.css">
    <link rel="stylesheet" href="/assets/css/L.Control.Locate.css">
    <link rel="stylesheet" href="/assets/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.css">
    <link rel="stylesheet" href="/js/dist/css/select2.min.css" />
    {{--<link rel="stylesheet" href="/assets/css/app.css">--}}
</head>
<body class="full-height" id="scrollup">

<div class="page-loading">
    <img src="/assets/findgo/images/loader.gif" alt="" />
    <span>Skip Loader</span>
</div>

<div class="theme-layout">

    {{--<div class="responsiveheader">--}}
        {{--<div class="rheader">--}}
            {{--<span><img src="/assets/findgo/images/ricon.png" alt="" /></span>--}}
            {{--<div class="logo">--}}
                {{--<a href="#" title=""><img src="/assets/findgo/images/horizontal-white.png" height="40" width="175" alt="" /></a>--}}
            {{--</div>--}}
            {{--<div class="extras">--}}
                {{--<span class="accountbtn"><i class="flaticon-avatar"></i></span>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="rnaver">--}}
            {{--<span class="closeresmenu"><i>x</i>Close</span>--}}
            {{--<div class="logo"><a href="#" title=""><img src="/assets/findgo/images/horizontal-white.png" height="40" width="175" alt="" /></a></div>--}}
            {{--<div class="extras">--}}
                {{--<a href="add-listing.html" title=""><img src="/assets/findgo/images/icon1.png" alt="" /> Add Listing</a>--}}
            {{--</div>--}}
            {{--<ul>--}}
                {{--<li class="menu-item-has-children">--}}
                    {{--<a href="#" title="">Home</a>--}}
                    {{--<ul>--}}
                        {{--<li><a href="index.html" title="">Home 1</a></li>--}}
                        {{--<li><a href="index2.html" title="">Home 2</a></li>--}}
                        {{--<li><a href="index3.html" title="">Home 3</a></li>--}}
                        {{--<li><a href="index4.html" title="">Home 4</a></li>--}}
                        {{--<li><a href="index5.html" title="">Home 5</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="menu-item-has-children">--}}
                    {{--<a href="#" title="">Listings</a>--}}
                    {{--<ul>--}}
                        {{--<li><a href="add-listing.html" title="">Add Listing</a></li>--}}
                        {{--<li><a href="listing-category.html" title="">Listing Category</a></li>--}}
                        {{--<li><a href="listing-category2.html" title="">Listing Category 2</a></li>--}}
                        {{--<li><a href="listing-full.html" title="">Listing Full</a></li>--}}
                        {{--<li><a href="listing-map.html" title="">Listing Map</a></li>--}}
                        {{--<li><a href="listing-map2.html" title="">Listing Map 2</a></li>--}}
                        {{--<li><a href="listing-sidebar.html" title="">Listing Sidebar</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="menu-item-has-children">--}}
                    {{--<a href="#" title="">Listing Details</a>--}}
                    {{--<ul>--}}
                        {{--<li><a href="listing-single1.html" title="">Listing Details 1</a></li>--}}
                        {{--<li><a href="listing-single2.html" title="">Listing Details 2</a></li>--}}
                        {{--<li><a href="listing-single3.html" title="">Listing Details 3</a></li>--}}
                        {{--<li><a href="listing-single4.html" title="">Listing Details 4</a></li>--}}
                        {{--<li><a href="listing-single5.html" title="">Listing Details 5</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="menu-item-has-children">--}}
                    {{--<a href="#" title="">User</a>--}}
                    {{--<ul>--}}
                        {{--<li><a href="user-dashboard.html" title="">User Dashboard</a></li>--}}
                        {{--<li><a href="user-favourite.html" title="">User Favourites</a></li>--}}
                        {{--<li><a href="user-my-listings.html" title="">User Listing</a></li>--}}
                        {{--<li><a href="user-notification.html" title="">User Notifications</a></li>--}}
                        {{--<li><a href="user-profile.html" title="">User Profile</a></li>--}}
                        {{--<li><a href="user-review.html" title="">User Review</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="menu-item-has-children">--}}
                    {{--<a href="#" title="">Pages</a>--}}
                    {{--<ul>--}}
                        {{--<li><a href="blog1.html" title="">Blog 1</a></li>--}}
                        {{--<li><a href="blog2.html" title="">Blog 2</a></li>--}}
                        {{--<li><a href="blog-single.html" title="">Blog Details</a></li>--}}
                        {{--<li><a href="pricing.html" title="">Pricing</a></li>--}}
                        {{--<li><a href="404.html" title="">404 Error</a></li>--}}
                        {{--<li><a href="contact.html" title="">Contact Us</a></li>--}}
                        {{--<li><a href="services.html" title="">Our Services</a></li>--}}
                        {{--<li><a href="terms.html" title="">Our Terms</a></li>--}}
                        {{--<li><a href="testimonials.html" title="">Testimonials</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="menu-item-has-children">--}}
                    {{--<a href="#" title="">Shop</a>--}}
                    {{--<ul>--}}
                        {{--<li><a href="shop-list.html" title="">Shop Lists</a></li>--}}
                        {{--<li><a href="shop-detail.html" title="">Shop Details</a></li>--}}
                        {{--<li><a href="cart.html" title="">Shop Cart</a></li>--}}
                        {{--<li><a href="checkout.html" title="">Checkout</a></li>--}}
                        {{--<li><a href="shop-order.html" title="">Shop Order</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</div><!-- Responsive header -->--}}



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
                        @yield('content')


                    </div>
                </div>
            </div>
        </div>
    </section>

</div>








<div class="popupsec">
    <div class="popup">
        <div class="accounttabs">
            <span class="closepopup"><i>+</i></span>
            <ul class="ctabs group">
                <li><a href="#/one" class="active">Sign In</a></li>
                <li><a href="#/two">Sign Up</a></li>
            </ul>
            {{--<div id="content">--}}
                {{--<div class="accountform" id="one">--}}
                    {{--<form class="loginform" id="login-form" action="/user/login" >--}}
                        {{--<div id="messages"></div>--}}
                        {{--<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />--}}
                        {{--<div class="accountformfield">--}}
                            {{--<label>Username or Email Address *</label>--}}
                            {{--<input type="text" placeholder="Email" id="email" name="email" />--}}
                        {{--</div>--}}
                        {{--<div class="accountformfield">--}}
                            {{--<label>Password</label>--}}
                            {{--<input type="password" placeholder="Password" id="password" name="password" />--}}
                        {{--</div>--}}
                        {{--<button type="button" onclick="userLogin()" >Sign In</button>--}}
                    {{--</form>--}}
                {{--</div>--}}


                {{--<div class="accountform" id="two" style="display: none;">--}}

                    {{--<form id="register-form" action="/user/register" >--}}
                        {{--<div id="messages"></div>--}}
                        {{--<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />--}}
                        {{--<div class="accountformfield">--}}
                            {{--<label>Email *</label>--}}
                            {{--<input type="text" id="email" name="email" placeholder="Email" />--}}
                        {{--</div>--}}
                        {{--<div class="accountformfield">--}}
                            {{--<label>Display Name *</label>--}}
                            {{--<input type="text" id="display_name" name="display_name" placeholder="Display Name" />--}}
                        {{--</div>--}}
                        {{--<div class="accountformfield">--}}
                            {{--<label>Location:</label>--}}
                            {{--<input type="text" id="location" name="location" placeholder="Location">--}}
                        {{--</div>--}}
                        {{--<div class="accountformfield">--}}
                            {{--<label>Password</label>--}}
                            {{--<input type="password" id="password" name="password" placeholder="Password" />--}}
                        {{--</div>--}}
                        {{--<div class="accountformfield">--}}
                            {{--<label>Retype Password</label>--}}
                            {{--<input type="password" id="password_confirmation" name="password_confirmation" placeholder="Retype Password" />--}}
                        {{--</div>--}}

                        {{--<p class="terms-label">--}}
                            {{--<input name="accept_tos" value="1" id="cb6" type="checkbox"><label for="cb6" style="color:black;">I’ve read and accept the terms &amp; conditions *</label>--}}
                        {{--</p>--}}

                        {{--<button type="button" onclick="userRegister()" >Sign Up</button>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
</div>


{{--<script src="/assets/findgo/js/jquery.min.js" type="text/javascript"></script>--}}
<script src="/assets/js/jquery-2.1.4.min.js"></script>
<script src="/assets/findgo/js/modernizr.js" type="text/javascript"></script>
<script src="/assets/findgo/js/script.js" type="text/javascript"></script>
<script src="/assets/findgo/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/findgo/js/wow.min.js" type="text/javascript"></script>
<script src="/assets/findgo/js/slick.min.js" type="text/javascript"></script>
<script src="/assets/findgo/js/sumoselect.js" type="text/javascript"></script>
<script src="/assets/findgo/js/isotop.js" type="text/javascript"></script>
<script src="/assets/findgo/js/jquery.nicescroll.min.js" type="text/javascript"></script>
{{--<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCYc537bQom7ajFpWE5sQaVyz1SQa9_tuY&sensor=true&libraries=places"></script><!-- Maps -->--}}
{{--<script type="text/javascript" src="/assets/findgo/js/map1.js"></script>--}}
<script type="text/javascript" src="/assets/findgo/js/jq.aminoSlider.js"></script>
<script src="/assets/js/leaflet_0.7.js"></script>
<script src="/assets/js/leaflet.markercluster.js"></script>
<script src="/assets/js/L.Control.Locate.min.js"></script>
<script src="/assets/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js"></script>
<script src="/assets/js/app.js"></script>
{{--<script>--}}
    {{--$(document).ready(function() {--}}
        {{--$('.multi-select2').select2();--}}

        {{--$('.multi-select2-with-tags').select2({tags: true});--}}

        {{--$('.multi-select2-max3').select2({maximumSelectionLength: 3});--}}

        {{--$('.multi-select2-with-tags-max3').select2({tags: true, maximumSelectionLength: 3});--}}

        {{--$('#user-assign-group').change(function(){console.log('vl '+$(this).val());--}}
            {{--document.location.href = '/user/admin/user-to-group-add/'+$(this).val();--}}
        {{--})--}}

        {{--$("#is_exchange").change(function(){ console.log('changing..');--}}
            {{--if($(this).is(':checked')){console.log('checked..');--}}
                {{--$('#exchange_enabled').css('visibility','visible');--}}
            {{--}else{--}}
                {{--$('#exchange_enabled').css('visibility','hidden');--}}
            {{--}--}}
        {{--})--}}
    {{--});--}}
{{--</script>--}}


</body>
</html>
<?php /*























<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/leaflet_0.7.css" />
    {{--<link rel="stylesheet" href="/assets/css/leaflet.css">--}}
    {{--<link rel="stylesheet" href="/assets/css/MarkerCluster.css">--}}
    <link rel="stylesheet" href="/assets/css/MarkerCluster.Default.css">
    <link rel="stylesheet" href="/assets/css/L.Control.Locate.css">
    <link rel="stylesheet" href="/assets/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.css">
    <link rel="stylesheet" href="/js/dist/css/select2.min.css" />
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/custom_common_styles.css">
</head>

<body>
@include('partials.nav-bar')


<div class="container">
    <div class="row">
        @include('partials.home-left-side-bar')
        @yield('content')
        @if($user = Auth::user())
            @include('partials.home-right-side-bar')
        @endif
    </div>
</div>


<div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="login-form" action="/user/login" method="post">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body">
                    <div id="messages"></div>
                    <fieldset>
                        <div class="form-group">
                            <label for="username">Email:</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="button"  onclick="userLogin()" class="btn btn-primary" value="Login" />
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="registerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="register-form" action="/user/register" method="post">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Register</h4>
                </div>
                <div class="modal-body">
                    <div id="messages"></div>
                    <fieldset>
                        <div class="form-group">
                            <label for="username">Display Name:</label>
                            <input type="text" class="form-control" id="display_name" name="display_name">
                        </div>
                        <div class="form-group">
                            <label for="username">Email:</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="username">Location:</label>
                            <input type="text" class="form-control" id="email" name="location">
                        </div>



                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="password">Retype Password:</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <label for="password">Terms of Service:</label>
                            <input type="checkbox" name="accept_tos" id="accept_tos" value="1" />
                        </div>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="button" onclick="userRegister()" class="btn btn-primary" value="Register" />
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="featureModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" id="feature-info"></div>
        </div>
    </div>
</div>

<style>
    html,body,.container {
        height:100%;
    }
    .container {
        display:table;
        width: 100%;
        padding: 0 0 0 0;

    }

    .row {
        height: 100%;
        display: table-row;
    }

    .col-md-2 {
        padding: 0px;
    }
    .col-md-9 {

    }

    .row .no-float {
        display: table-cell;
        float: none;
    }
</style>
<style>
    .info-box-left {
        background-color: white;
        margin-left: 0px !important;
        margin-right: 0px !important;
        position: relative;
        height: 100%;
    }
    .info-box-right {
        background-color: white;
        margin-left: 0px;
        position: relative;
        height: 100%;
    }

    #featureModal .modal-dialog{
        width: 950px;
    }
</style>
<script src="/assets/js/jquery-2.1.4.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/typeahead.bundle.min.js"></script>
<script src="/assets/js/handlebars.min.js"></script>
<script src="/assets/js/list.min.js"></script>
<script src="/assets/js/leaflet_0.7.js"></script>
<script src="/assets/js/leaflet.markercluster.js"></script>
<script src="/assets/js/L.Control.Locate.min.js"></script>
<script src="/assets/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js"></script>
<script src="/js//dist/js/select2.full.min.js"></script>
<script src="/assets/js/app.js"></script>

<script>
    $(document).ready(function() {
        $('.multi-select2').select2();

        $('.multi-select2-with-tags').select2({tags: true});

        $('.multi-select2-max3').select2({maximumSelectionLength: 3});

        $('.multi-select2-with-tags-max3').select2({tags: true, maximumSelectionLength: 3});

        $('#user-assign-group').change(function(){console.log('vl '+$(this).val());
            document.location.href = '/user/admin/user-to-group-add/'+$(this).val();
        })

        $("#is_exchange").change(function(){ console.log('changing..');
            if($(this).is(':checked')){console.log('checked..');
                $('#exchange_enabled').css('visibility','visible');
            }else{
                $('#exchange_enabled').css('visibility','hidden');
            }
        })
    });
</script>
</body>
</html>
*/ ?>