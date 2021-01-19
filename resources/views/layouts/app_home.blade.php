<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{env('APP_NAME')}}</title>
    <link rel="stylesheet" href="/assets/admin-temp/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/admin-temp/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets/admin-temp/css/style.css">
    <link rel="stylesheet" href="/assets/admin-temp/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="/js/dist/css/select2.min.css" />
    <link rel="shortcut icon" href="/assets/admin-temp/images/favicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">

    {{---map related--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/assets/css/leaflet_0.7.css" />
    <link rel="stylesheet" href="/assets/css/MarkerCluster.Default.css">
    <link rel="stylesheet" href="/assets/css/L.Control.Locate.css">
    <link rel="stylesheet" href="/assets/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.css">
    <link rel="stylesheet" href="/assets/css/custom.css?version=1">
</head>

<body>
    <div class="container-scroller">
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                <a class="navbar-brand brand-logo" href="index.html">

                </a>
                <a class="navbar-brand brand-logo-mini" href="index.html">

                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                @include('partials.admin-nav-bar')
                <li class="nav-item dropdown d-none d-xl-inline-block">
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <a class="dropdown-item p-0">
                            <div class="d-flex border-bottom">
                                <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                                </div>
                                <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                                </div>
                                <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item mt-2">
                            Manage Accounts
                        </a>
                        <a class="dropdown-item">
                            Change Password
                        </a>
                        <a class="dropdown-item">
                            Check Inbox
                        </a>
                        <a class="dropdown-item">
                            Sign Out
                        </a>
                    </div>
                </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>

        <div class="container-fluid page-body-wrapper">
            @include('partials.admin-left-sidebar')
            
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                    <footer class="footer">
                    </footer>
                </div>
            </div>
        </div>

        <script src="/assets/admin-temp/vendors/js/vendor.bundle.base.js"></script>
        <script src="/assets/admin-temp/vendors/js/vendor.bundle.addons.js"></script>
        <script src="/assets/admin-temp/js/off-canvas.js"></script>
        <script src="/assets/admin-temp/js/misc.js"></script>
        <script src="/assets/admin-temp/js/dashboard.js"></script>
        <script src="/js//dist/js/select2.full.min.js"></script>
        <script src="/assets/js/leaflet_0.7.js"></script>
        <script src="/assets/js/leaflet.markercluster.js"></script>
        <script src="/assets/js/L.Control.Locate.min.js"></script>
        <script src="/assets/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js"></script>
        <script src="/assets/js/app.js"></script>
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
