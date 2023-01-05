<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="/assets/admin-temp/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/admin-temp/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets/admin-temp/css/style.css">
    <link rel="stylesheet" href="/assets/admin-temp/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="/js/dist/css/select2.min.css" />
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

        <script src="/assets/admin-temp/vendors/js/vendor.bundle.base.js"></script>
        <script src="/assets/admin-temp/vendors/js/vendor.bundle.addons.js"></script>
        <script src="/assets/admin-temp/js/off-canvas.js"></script>
        <script src="/assets/admin-temp/js/misc.js"></script>
        <script src="/assets/js/custom_common.js"></script>
        <script src="/assets/admin-temp/js/dashboard.js"></script>
        <script src="/js//dist/js/select2.full.min.js"></script>
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
        <script src='https://www.google.com/recaptcha/api.js'></script>
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
