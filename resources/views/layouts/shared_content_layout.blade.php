<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

<body style="padding-top:0px;">
<div class="container" style="width: 100%;max-width: 100%;max-height: 400px;">
    <div class="row">
        @yield('content')
    </div>
</div>
<div class="modal fade" id="featureModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
                {{--<h4 class="modal-title text-primary" id="feature-title"></h4>--}}
            </div>
            <div class="modal-body" id="feature-info"></div>
            {{--<div class="modal-footer">--}}
            {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
<!-- container-scroller -->

<!-- plugins:js -->

    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>--}}

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
{{--<script src="/assets/js/app.js"></script>--}}
<script src="/assets/js/app_share.js"></script>

<!-- End custom js for this page-->
</body>
</html>