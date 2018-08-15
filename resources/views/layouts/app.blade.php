<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
    <title>OSM</title>

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
</head>

<body>
@include('partials.nav-bar')


{{--<div id="container">--}}
{{--    @include('partials.left-side-bar')--}}
    {{--@yield('content')--}}
{{--</div>--}}


{{--<div class="container">--}}
    {{--<div class="col-lg-3  no-floa" style="padding: 0px;margin: 0px;">--}}
        {{--<h4><br><br><br>Uferstrasse 90, 4057 Basel</h4>--}}
    {{--</div>--}}
    {{--<div class="col-lg-6  no-floa"  id="map" style="padding: 0px;margin: 0px;">--}}
        {{--@yield('content')--}}
    {{--</div>--}}
    {{--<div class="col-lg-3 no-float destra" style="padding: 0px;margin: 0px;">--}}
        {{--ddddddddddd--}}
    {{--</div>--}}
    {{--<!-- /.row -->--}}
{{--</div>--}}
<!-- /.container -->

<div class="container">
    <div class="row">
        @include('partials.home-left-side-bar')
        @yield('content')
        @if($user = Auth::user())
            @include('partials.home-right-side-bar')
        @endif
    </div>
</div>


{{--<div class="modal fade" id="legendModal" tabindex="-1" role="dialog">--}}
    {{--<div class="modal-dialog">--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header">--}}
                {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
                {{--<h4 class="modal-title">Map Legend</h4>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{--<p>Map Legend goes here...</p>--}}
            {{--</div>--}}
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

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
                            <label for="video_producer">User Roles</label>
                            {{--<input type="text" class="form-control" aria-describedby="nameHelp" name="video_producer" placeholder="Video Producer" value="{{ old('video_producer') }}">--}}
                            <select class="form-control multi-select2" id="video_producer" multiple searchable="Search here.." name="user_acting_roles[]" style="width: 100%;" >
                                @foreach($user_acting_role as $role)
                                    <option value="{{$role->id}}" >{{$role->name}}</option>
                                @endforeach
                            </select>
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
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-primary" id="feature-title"></h4>
            </div>
            <div class="modal-body" id="feature-info"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{--<div class="modal fade" id="attributionModal" tabindex="-1" role="dialog">--}}
    {{--<div class="modal-dialog">--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header">--}}
                {{--<button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
                {{--<h4 class="modal-title">--}}
                {{--</h4>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{--<div id="attribution"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
<style>
    html,body,.container {
        height:100%;
    }
    .container {
        display:table;
        width: 100%;
        /*margin-top: -50px;*/
        padding: 0 0 0 0; /*set left/right padding according to needs*/
        /*box-sizing: border-box;*/
    }

    .row {
        height: 100%;
        display: table-row;
    }

    .col-md-2 {
        background: pink;
        /*padding-left: -10px;*/
        padding: 0px;
    }
    .col-md-9 {
        /*background: yellow;*/
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
        /*z-index: 10000;*/
        height: 100%;
    }
    .info-box-right {
        background-color: white;
        margin-left: 0px;
        position: relative;
        /*z-index: 10000;*/
        height: 100%;
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
