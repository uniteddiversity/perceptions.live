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
    <link rel="stylesheet" href="/assets/css/custom.css" />
    <link rel="stylesheet" href="/assets/juery-confirm/jquery-confirm.css" />
    {{--<link rel="stylesheet" href="/assets/js/datatable/datatables.min.css" />--}}
    <script src="/assets/js/jquery-2.1.4.min.js"></script>
    {{--<link rel="stylesheet" href="/assets/css/app.css">--}}
</head>
<body class="full-height" id="scrollup">

<div class="page-loading">
    <img src="/assets/findgo/images/loader.gif" alt="" />
    <span>Skip Loading?</span>
</div>

<div class="theme-layout">
    @yield('content')
</div>




{{--<div class="popupsecs">--}}
    {{--<div class="popup">--}}
        {{--<div class="info_content">--}}
            {{--testtt--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
<div class="modal fade" id="featureModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="position: relative;">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>

                <button class="model-back" onclick="modalBack()" aria-hidden="true" style="position: absolute;top: 10px;left: 10px;padding: 4px 15px;">&lt;</button>
                <button class="model-foward" onclick="modalFoward()" aria-hidden="true" style="position: absolute;top: 10px;left: 60px;padding: 4px 15px;">&gt;</button>
            </div>
            <div class="modal-body" id="feature-info"></div>
        </div>
    </div>
</div>



<div class="popupsec">
    <div class="popup">
        <div class="accounttabs">
            <span class="closepopup"><i>+</i></span>
            <ul class="ctabs group">
                <li><a href="#/one" class="active">Sign In</a></li>
                <li><a href="#/two">Sign Up</a></li>
                <div id="content">
                <div class="accountform" id="one">
                <form class="loginform" id="login-form" action="/user/login" >
                <div id="messages"></div>
                <input type="hidden" name="_token" value="{{ Session::token() }}" />
                <div class="accountformfield">
                <label>Username or Email Address *</label>
                <input type="text" placeholder="Email" name="email" />
                </div>
                <div class="accountformfield">
                <label>Password</label>
                <input type="password" placeholder="Password" name="password" />
                </div>
                <button type="button" onclick="userLogin()" >Sign In</button>
                </form>
                </div>


                <div class="accountform" id="two" style="display: none;">

                <form id="register-form" action="/user/register" >
                <div id="messages"></div>
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <div class="accountformfield">
                <label>Email *</label>
                <input type="text" id="email" name="email" placeholder="Email" />
                </div>
                <div class="accountformfield">
                <label>Display Name *</label>
                <input type="text" id="display_name" name="display_name" placeholder="Display Name" />
                </div>
                <div class="accountformfield">
                <label>Location:</label>
                <input type="text" id="location" name="location" placeholder="Location">
                </div>
                <div class="accountformfield">
                <label>Password</label>
                <input type="password" id="password" name="password" placeholder="Password" />
                </div>
                <div class="accountformfield">
                <label>Retype Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Retype Password" />
                </div>

                <p class="terms-label">
                <input name="accept_tos" value="1" id="cb6" type="checkbox"><label for="cb6" style="color:black;">I’ve read and accept the terms &amp; conditions *</label>
                </p>

                <button type="button" onclick="userRegister()" >Sign Up</button>
                </form>
                </div>
                </div>
            </ul>
        </div>
    </div>
</div>


{{--<script src="/assets/findgo/js/jquery.min.js" type="text/javascript"></script>--}}

<script src="/assets/findgo/js/modernizr.js" type="text/javascript"></script>
<script src="/assets/findgo/js/script.js" type="text/javascript"></script>
<script src="/assets/findgo/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/findgo/js/wow.min.js" type="text/javascript"></script>
<script src="/assets/findgo/js/slick.min.js" type="text/javascript"></script>
<script src="/assets/findgo/js/sumoselect.js" type="text/javascript"></script>
<script src="/assets/findgo/js/isotop.js" type="text/javascript"></script>
<script src="/assets/findgo/js/jquery.nicescroll.min.js" type="text/javascript"></script>
<script src="/assets/findgo/js/date-time-picker.min.js" type="text/javascript"></script>
{{--<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCYc537bQom7ajFpWE5sQaVyz1SQa9_tuY&sensor=true&libraries=places"></script><!-- Maps -->--}}
{{--<script type="text/javascript" src="/assets/findgo/js/map1.js"></script>--}}
<script type="text/javascript" src="/assets/findgo/js/jq.aminoSlider.js"></script>
<script src="/assets/js/leaflet_0.7.js"></script>
<script src="/assets/js/leaflet.markercluster.js"></script>
<script src="/assets/js/L.Control.Locate.min.js"></script>
<script src="/assets/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js"></script>


<script src="/assets/js/bootstrap-tooltip.js"></script>
<script src="/assets/js/app.js"></script>

<script src="/assets/js/datatable/datatables.min.js"></script>
<script src="/assets/juery-confirm/jquery-confirm.js"></script>
<style>
    #featureModal {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 3;
        background: rgba(36,35,35,0.8);
        overflow-x: hidden;
        overflow-y: scroll;
        display: none;
    }

    .modal-dialog{
        background: white;
        width: 950px;
        height: 75%
        padding-top: 50px;
        margin: auto;
    }

    .modal-content{
        padding: 10px;
    }

    .avatar{
        width: 150px;
    }

    .inactive_link{
        cursor: pointer;
    }

    .inactive_link:hover{
        text-decoration: underline;
    }
</style>
<style>
    /* Tooltip */
    .tooltip{
        position: absolute;
        background: black;
        color: #fff;
        padding: 3px;
        z-index: 1000000000;
    }
    .leaflet-popup-content{
        margin: 0px;
        width: 200px;
    }
</style>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
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