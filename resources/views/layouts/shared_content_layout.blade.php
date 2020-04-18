<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PRCPTIONS.LIVE: exploring the world's perception</title>
    <link rel="stylesheet" type="text/css" href="/assets/findgo/css/bootstrap-grid.css" />
<!--    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="/assets/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/leaflet_0.7.css" />
    {{--<link rel="stylesheet" href="/assets/css/leaflet.css">--}}
    {{--<link rel="stylesheet" href="/assets/css/MarkerCluster.css">--}}
    <link rel="stylesheet" href="/assets/css/MarkerCluster.Default.css">
    <link rel="stylesheet" href="/assets/css/L.Control.Locate.css">
    <link rel="stylesheet" href="/assets/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.css">
    <link rel="stylesheet" href="/js/dist/css/select2.min.css" />
    <link rel="stylesheet" href="/assets/css/app.css">
<!--    <link rel="stylesheet" href="/assets/css/custom_common_styles.css">-->



    <link rel="stylesheet" type="text/css" href="/assets/findgo/css/style.css" />
    <link rel="stylesheet" href="/assets/css/custom.css?version=1" />
    <link rel="stylesheet" href="/assets/css/custom_shared.css" />

{{--    <link rel="stylesheet" href="/assets/js/slick_slider/slick.css">--}}
<!--    <link rel="stylesheet" href="/assets/css/leaflet.css" />-->
    <style>
        #featureModal {
            display: block;
            padding-top: 0 !important;
        }

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

        .search-form-element{
            width: auto !important;
        }

        /*.btn{*/
        /*    height: 20px;*/
        /*    line-height: 0px !important;*/
        /*}*/
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
            top: 88%;
        }

        .leaflet-right {
            right: 11px !important;
        }

        .leaflet-control-attribution.leaflet-control {
            margin-bottom: 0px; !important
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
</head>

<body style="padding-top:0px;">
    <div class="container" style="width: 100%;max-width: 100%;max-height: 400px;">
        <div class="row">
            @yield('content')
        </div>
    </div>
    <div class="modal fade" id="featureModal" tabindex="-1" role="dialog" style="display: none;">
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
    <!-- container-scroller -->

    <!-- plugins:js -->

    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>--}}
    <style>
        #featureModal .modal-dialog {
            width: 950px;
        }

        .search-form-element {
            padding-right: 0px;
            padding-left: 10px;
            width: 120px;
            float: left;
        }

        .search-form-element-buttons {
            padding-right: 0px;
            padding-left: 10px;
            /*width: 150px;*/
            float: left;
        }

        .search-form-element-buttons .btn{
            height: 20px;
            line-height: 0px !important;
        }

        .search-form-element .select2-selection--single {
            height: 34px;
        }

        .btn_outer{
            /*display: none;*/
        }

        .sh_watermark{
            position: absolute;
            background-color: transparent;
            height: 50px;
            width: 100px;
            background-image: url('/assets/findgo/images/live-perceptions-shared-logo.png');
            /*background: no-repeat;*/
            right: 20px;
            top: 10px;
            -webkit-background-size: 100px;
            background-size: 100px;
            background-repeat: no-repeat;
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
    <script src="/assets/js/slick_slider/slick.js"></script>
    <script src="/assets/js/app_share.js"></script>
    <script src="/js/jquery.timeago.js"></script>

    <script>
        function addSlider(){
            console.log('adding slider')
            $('.single-item').not('.slick-initialized').slick();
            // $('.single-item').slick('refresh')
            // $(".single-item").not('.slick-initialized').slick({
            //     dots: false,
            //     infinite: false,
            //     speed: 300,
            //     slidesToShow: 1,
            //     slidesToScroll: 1,
            //     responsive: [
            //         {
            //             breakpoint: 1024,
            //             settings: {
            //                 slidesToShow: 3,
            //                 slidesToScroll: 3,
            //                 infinite: true,
            //                 dots: true
            //             }
            //         },
            //         {
            //             breakpoint: 600,
            //             settings: {
            //                 slidesToShow: 2,
            //                 slidesToScroll: 2
            //             }
            //         },
            //         {
            //             breakpoint: 480,
            //             settings: {
            //                 slidesToShow: 1,
            //                 slidesToScroll: 1
            //             }
            //         }
            //         // You can unslick at a given breakpoint now by adding:
            //         // settings: "unslick"
            //         // instead of a settings object
            //     ]
            // });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.select2-ajax-primary_sub_tag').select2({
                ajax: {
                    url: '/home/ajax/primary_subject_tag',
                    dataType: 'json'
                }
            });

            $('.select2-ajax-users').select2({
                ajax: {
                    url: '/home/ajax/user-search-list',
                    dataType: 'json'
                }
            });
        })

    </script>

    <script>
        var two_row_width = 700
        var s_height = screen.height
        function twoRowSetup(){
            if(window.screen.availWidth < two_row_width){
                $('.right').css('width', 'auto')
                // $('.right').css('height', (s_height/2)+'px')

                $('.right').css('float', 'none')
                $('.right div').css('width', '100%')
                $('.right').addClass('shared_vertical_row')
                $('#video_search_res').addClass('single-item')


                $('.left').css('width', '100%')
                // $('.left').css('height', (s_height/2)+'px')
                $('.left').addClass('shared_vertical_row')

                // addSlider();
                console.log('changing val')
            }
        }

        function oneRowSetup(){
            if(window.screen.availWidth >= two_row_width){
                $('.right').css('width', '370px')
                // $('.right').css('height', '600px')
                // $('.ml-placessec').css('height', s_height+'px')
                $('.ml-placessec').css('height', '600px')

                $('.right').css('float', 'left')
                $('.right').removeClass('shared_vertical_row')
                $('#video_search_res').removeClass('single-item')

                $('.left').css('width', 'auto')
                $('.left').css('height', (s_height)+'px')
                $('.left').removeClass('shared_vertical_row')
                console.log('changing val')
            }
        }

        $(window).resize(function() {
            console.log('changing width', window.screen.availWidth )
            twoRowSetup()
            oneRowSetup()
        })


        $(document).ready(function(){
            $('.left_side_container').bind('resize', function(){
                alert('xxx');
            });
            console.log('event bound')
        })

        twoRowSetup()
        oneRowSetup()
    </script>
</body>

</html>
