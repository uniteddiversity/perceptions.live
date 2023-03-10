<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Perceptions.live is a place for media communities to collaborate and connect worldwide">
    <meta name="keywords" content="Community building, community, media, video editing, frontline communities, grassroots, grassroots organizations">

    <link rel="stylesheet" type="text/css" href="/assets/css/introjs.css">
    <link href="/assets/css/introjs-modern.css" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="/assets/frontend/css/bootstrap-grid.css" />
    <link rel="stylesheet" href="/assets/frontend/css/icons.css">
    <link rel="stylesheet" href="/assets/frontend/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/frontend/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/assets/frontend/css/responsive.css" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="/uploaded_settings/fav_apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/uploaded_settings/fav_apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/uploaded_settings/fav_apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/uploaded_settings/fav_apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/uploaded_settings/fav_apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/uploaded_settings/fav_apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/uploaded_settings/fav_apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/uploaded_settings/fav_apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/uploaded_settings/fav_apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/uploaded_settings/fav_android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/uploaded_settings/fav_favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/uploaded_settings/fav_favicon-96x96.png">

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <link rel="manifest" href="/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/leaflet.css" />
    <link rel="stylesheet" href="/assets/css/MarkerCluster.css">
    <link rel="stylesheet" href="/assets/css/MarkerCluster.Default.css">
    <link rel="stylesheet" href="/assets/css/L.Control.Locate.css">
    <link rel="stylesheet" href="/assets/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.css">
    <link rel="stylesheet" href="/js/dist/css/select2.min.css" />
    <link rel="stylesheet" href="/assets/css/custom.css?version=1" />
    <link rel="stylesheet" href="/assets/juery-confirm/jquery-confirm.css" />
    <script src="/assets/js/jquery-2.1.4.min.js"></script>
    <link rel="stylesheet" href="/assets/js/slick_slider/slick.css">
    <link rel="stylesheet" href="/assets/css/thumbnail_slider.css">
    <link rel="stylesheet" href="/assets/css/frontend-override.css">
</head>

<body class="full-height" id="scrollup">

    <div class="page-loading">
        <img src="/assets/frontend/images/loader.gif" alt="" />
    </div>

    <div class="theme-layout">
        @yield('content')
    </div>


    <div class="modal fade" id="featureModal" tabindex="-1" role="dialog">
        <div class="modal-dialog big" style="position: relative;">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;">
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true" style="display:none;">&times;</button>

                    <button class="model-back" onclick="modalBack()" aria-hidden="true" style="position: absolute;top: 10px;left: 10px;padding: 4px 15px; display:none;">&lt;</button>
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
                            <form class="loginform" id="login-form" action="/user/login">
                                <div id="messages"></div>
                                <input type="hidden" name="_token" value="{{ Session::token() }}" />
                                <div class="accountformfield">
                                    <label>Username or Email Address *</label>
                                    <input type="text" placeholder="Email" name="email" />
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="accountformfield">
                                    <label>Password</label>
                                    <input type="password" placeholder="Password" name="password" />
                                    <i class="fas fa-unlock-alt"></i>
                                </div>
                                <div class="btn_outer">
                                    <button type="button" onclick="userLogin()">Sign In</button>
                                </div>
                            </form>
                        </div>


                        <div class="accountform" id="two" style="display: none;">

                            <form id="register-form" action="/user/register">
                                <div id="messages"></div>
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                <div class="accountformfield">
                                    <label>Email *</label>
                                    <input type="text" id="email" name="email" placeholder="Email" />
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="accountformfield">
                                    <label>Display Name *</label>
                                    <input type="text" id="display_name" name="display_name" placeholder="Display Name" />
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="accountformfield">
                                    <label>Location</label>
                                    <input type="text" id="location" name="location" placeholder="Location">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="accountformfield">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" placeholder="Password" />
                                    <i class="fas fa-unlock-alt"></i>
                                </div>
                                <div class="accountformfield">
                                    <label>Retype Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Retype Password" />
                                    <i class="fas fa-unlock-alt"></i>
                                </div>

                                <p class="terms-label">
                                    <input name="accept_tos" value="1" id="cb6" type="checkbox"><label for="cb6" style="color:black;">I???ve read and accept the <a href="https://perceptiontravel.tv/terms-of-service/" target="_blank">terms &amp; conditions *</a></label>
                                </p>

                                @foreach(Consent::treatments() as $treatment)
                                    <p class="terms-label">
                                        <input name="consent_{{ $treatment->id }}" id="cb6{{ $treatment->id }}" type="checkbox"><label for="cb6{{ $treatment->id }}" style="color:black;">{{ trans($treatment->description) }}</label>
                                    </p>
{{--                                    <div class="checkbox">--}}
{{--                                        <label>--}}
{{--                                            <input id="checkbox123123" name="consent_{{ $treatment->id }}" type="checkbox" value="1">--}}
{{--                                            {{ trans($treatment->description) }}--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
                                @endforeach


                                <div class="btn_outer">
                                    <button type="button" class="register_button" onclick="userRegister()"><i class="disable_loading"></i>Sign Up</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>

    <script src="/assets/frontend/js/popper.min.js" type="text/javascript"></script>

    <script src="/assets/frontend/js/modernizr.js" type="text/javascript"></script>
    <script src="/assets/frontend/js/script.js" type="text/javascript"></script>
    <script src="/assets/frontend/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/frontend/js/wow.min.js" type="text/javascript"></script>
    <script src="/assets/frontend/js/slick.min.js" type="text/javascript"></script>
    <script src="/assets/frontend/js/sumoselect.js" type="text/javascript"></script>
    <script src="/assets/frontend/js/isotop.js" type="text/javascript"></script>
    <script src="/assets/frontend/js/jquery.nicescroll.min.js" type="text/javascript"></script>
    <script src="/assets/frontend/js/date-time-picker.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/assets/frontend/js/jq.aminoSlider.js"></script>
    <script src="/assets/js/leaflet.js"></script>
    <script src="/assets/js/leaflet.markercluster.new.js"></script>
    <script src="/assets/js/leaflet.freeze.js"></script>
    <script src="/assets/js//L.control.locate.new.js"></script>
    <script src="/assets/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js"></script>
    <script src="/assets/js/notify.js"></script>

    <script src="/js/jquery.timeago.js"></script>
    <script src="/assets/js/bootstrap-tooltip.js"></script>
    <script src="/js//dist/js/select2.full.min.js"></script>
    <script src="/assets/js/app.js"></script>

    <script src="/assets/js/datatable/datatables.min.js"></script>
    <script src="/assets/juery-confirm/jquery-confirm.js"></script>
    <script src="/assets/js/slick_slider/slick.js"></script>
    <script src="/assets/js/thumbnail_slider.js"></script>
    <script src="/assets/js/home-common.js"></script>
    @yield('scripts')

    @include('partials.notify-messages')
    <style>
        #featureModal {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 30;
            background: rgba(36, 35, 35, 0.8);
            overflow-x: hidden;
            overflow-y: scroll;
            display: none;
        }

        .modal-dialog {
            background: white;
            width: 950px;
            height: 75% padding-top: 50px;
            margin: auto;
        }

        .modal-content {
            padding: 10px;
        }

        .avatar {
            width: 150px;
        }

        .inactive_link {
            cursor: pointer;
        }

        .inactive_link:hover {
            text-decoration: underline;
        }

    </style>
    <style>
        /* Tooltip */
        .tooltip {
            position: absolute;
            background: black;
            color: #fff;
            padding: 3px;
            z-index: 1000000000;
        }

        .leaflet-popup-content {
            margin: 0px;
            width: 200px;
        }

        /* Geolocation Icon */
        .fa-map-marker:before {
            content: "\f0ac";
        }

        /*  Clustering color   */
        .marker-cluster-small {
            background-color: #8a88ff;
        }

        .marker-cluster-medium {
            background-color: #8a88ff;
        }

        .marker-cluster-large {
            background-color: #8a88ff;
        }

        .marker-cluster-small div {
            background-color: #47489E;
            color: white;
        }

        .marker-cluster-medium div {
            background-color: #47489E;
            color: white;
        }

        .marker-cluster-large div {
            background-color: #47489E;
            color: white;
        }

        /* Adding margins on zoom controls */
        .leaflet-top {
            top: 80%;
        }

        /* Adding Target icon */
        .custom {
            width: 25px;
            height: 31px;
            content: url(/assets/img/target.svg);
        }

        /* changin zoom in and out colors */
        .leaflet-control-zoom-in {
            color: #47489E !important;
        }

        .leaflet-control-zoom-out {
            color: #47489E !important;
        }

        /* Participate Icon */
        .participate {
            top: 70%;
            /* z-index: 10001; */
            color: #1C1C8C;
            position: absolute;
            left: 50%;
            font-size: 80px;

        }

        /* Left Magnifying Glass */
        .maginify-glass {
            font-size: 40px;
            transform: rotate(180deg);
        }

    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
</body>
