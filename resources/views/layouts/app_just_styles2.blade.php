<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" type="text/css" href="/assets/frontend/css/bootstrap-grid.css" />
    <link rel="stylesheet" href="/assets/frontend/css/icons.css">
    <link rel="stylesheet" href="/assets/frontend/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/frontend/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/assets/frontend/css/responsive.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/frontend/css/leaflet_0.7.css" />
    <link rel="stylesheet" href="/assets/css/MarkerCluster.Default.css">
    <link rel="stylesheet" href="/assets/css/L.Control.Locate.css">
    <link rel="stylesheet" href="/assets/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.css">
    <link rel="stylesheet" href="/js/dist/css/select2.min.css" />
    <link rel="stylesheet" href="/assets/css/custom.css?version=1" />
    <link rel="stylesheet" href="/assets/juery-confirm/jquery-confirm.css" />
    <script src="/assets/js/jquery-2.1.4.min.js"></script>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapperx">
            <div class="row">
                <div class="content-wrapper">
                    @yield('content')
                    <footer class="footer">

                    </footer>
                </div>
            </div>
        </div>

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
        <script src="/assets/js/leaflet_0.7.js"></script>
        <script src="/assets/js/leaflet.markercluster.js"></script>
        <script src="/assets/js/L.Control.Locate.min.js"></script>
        <script src="/assets/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js"></script>
        <script src="/assets/js/bootstrap-tooltip.js"></script>
        <script src="/assets/js/app.js"></script>

        <script src="/assets/js/datatable/datatables.min.js"></script>
        <script src="/assets/juery-confirm/jquery-confirm.js"></script>
        <script>
            $(document).ready(function() {
                $('#users_llist').DataTable({
                    "aaSorting": []
                });
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: '-3d',
                    autoclose: true,
                    keepOpen: false,
                });
                //        $('.datepicker').on('changeDate', function(ev){
                //            $(this).datepicker('hide');
                //        });
            });

            $(document).ready(function() {
                $('.multi-select2').select2();

                $('.multi-select2-with-tags').select2({
                    tags: true
                });

                $('#user-assign-group').change(function() {
                    console.log('vl ' + $(this).val());
                    document.location.href = '/user/admin/user-to-group-add/' + $(this).val();
                })

                $("#is_exchange").change(function() {
                    console.log('changing..');
                    if ($(this).is(':checked')) {
                        console.log('checked..');
                        $('#exchange_enabled').css('visibility', 'visible');
                    } else {
                        $('#exchange_enabled').css('visibility', 'hidden');
                    }
                })
            });


            function addr_search() {
                var inp = document.getElementById("leaflet_search_addr");
                $.getJSON('http://nominatim.openstreetmap.org/search?format=json&limit=5&q=' + inp.value, function(data) {
                    var items = [];

                    $.each(data, function(key, val) {
                        bb = val.boundingbox;
                        console.log(bb[0] + '     ' + bb[2]);
                        $('#lat_val').val(bb[0]);
                        $('#long_val').val(bb[2]);
                    });
                    $('#submit_content').submit();
                    return true;
                });
            }

            function submit_content() {
                if (addr_search()) {

                }
            }
        </script>
</body>
<style>
    .datepicker>div {
        display: block !important;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #f2f2f2;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        /*color: #ccc;*/
    }

</style>

</html>
