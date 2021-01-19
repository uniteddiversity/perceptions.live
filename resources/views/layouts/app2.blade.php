<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{env('APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="/assets/front-theme/css/bootstrap-grid.css" />
    <link rel="stylesheet" href="/assets/front-theme/css/icons.css">
    <link rel="stylesheet" href="/assets/front-theme/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/front-theme/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/assets/front-theme/css/responsive.css" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/assets/css/leaflet_0.7.css" />
    <link rel="stylesheet" href="/assets/css/MarkerCluster.Default.css">
    <link rel="stylesheet" href="/assets/css/L.Control.Locate.css">
    <link rel="stylesheet" href="/assets/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.css">
    <link rel="stylesheet" href="/js/dist/css/select2.min.css" />
    <link rel="stylesheet" href="/assets/css/custom.css?version=1" />
    <link rel="stylesheet" href="/assets/juery-confirm/jquery-confirm.css" />
    <script src="/assets/js/jquery-2.1.4.min.js"></script>

    <link rel="stylesheet" href="/assets/admin-temp/css/style.css">





</head>

<body class="full-height" id="scrollup">

    <div class="page-loading">
        <img src="/assets/front-theme/images/loader.gif" alt="" />
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
                                    <input name="accept_tos" value="1" id="cb6" type="checkbox"><label for="cb6" style="color:black;">I’ve read and accept the terms &amp; conditions *</label>
                                </p>
                                <div class="btn_outer">
                                    <button type="button" onclick="userRegister()">Sign Up</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>


    <script src="/assets/front-theme/js/jquery.min.js" type="text/javascript"></script>

    <script src="/assets/front-theme/js/modernizr.js" type="text/javascript"></script>
    <script src="/assets/front-theme/js/script.js" type="text/javascript"></script>
    <script src="/assets/front-theme/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/front-theme/js/wow.min.js" type="text/javascript"></script>
    <script src="/assets/front-theme/js/slick.min.js" type="text/javascript"></script>
    <script src="/assets/front-theme/js/sumoselect.js" type="text/javascript"></script>
    <script src="/assets/front-theme/js/jquery.nicescroll.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/assets/mashable/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="/assets/front-theme/js/jq.aminoSlider.js"></script>


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

    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
    <script>
        $(document).ready(function() {
            // $('#users_llist').DataTable({"aaSorting": []});
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                // startDate: '-3d',
                autoclose: true,
                keepOpen: false,
            });
        });
    </script>
</body>

</html>
