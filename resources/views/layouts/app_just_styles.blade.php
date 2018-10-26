<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PRCPTIONS.LIVE: exploring the world's perception</title>
    <link rel="stylesheet" href="/assets/admin-temp/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/admin-temp/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets/admin-temp/css/style.css">
    <link rel="stylesheet" href="/assets/admin-temp/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="/js/dist/css/select2.min.css" />

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}

</head>

<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->

    <!-- partial -->
    <div class="container-fluid page-body-wrapperx">


    {{--@include('partials.admin-left-sidebar')--}}


        <!-- partial -->
        <div class="row">
            <div class="content-wrapper">

            @yield('content')
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">

            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>






<!-- container-scroller -->

<!-- plugins:js -->

    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>--}}

<script src="/assets/admin-temp/vendors/js/vendor.bundle.base.js"></script>
<script src="/assets/admin-temp/vendors/js/vendor.bundle.addons.js"></script>
<script src="/assets/admin-temp/js/off-canvas.js"></script>
<script src="/assets/admin-temp/js/misc.js"></script>
<script src="/assets/js/custom_common.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="/assets/admin-temp/js/dashboard.js"></script>

<script src="/js//dist/js/select2.full.min.js"></script>

<script>
    $(document).ready(function() {
        $('#users_llist').DataTable({"aaSorting": []});
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d',
            autoclose: true,
            keepOpen: false,
        });
//        $('.datepicker').on('changeDate', function(ev){
//            $(this).datepicker('hide');
//        });
    } );

    $(document).ready(function() {
        $('.multi-select2').select2();

        $('.multi-select2-with-tags').select2({tags: true});

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


    function addr_search() {
        var inp = document.getElementById("leaflet_search_addr");
        $.getJSON('http://nominatim.openstreetmap.org/search?format=json&limit=5&q=' + inp.value, function(data) {
            var items = [];

            $.each(data, function(key, val) {
                bb = val.boundingbox;
                console.log(bb[0]+'     '+bb[2]);
                $('#lat_val').val(bb[0]);
                $('#long_val').val(bb[2]);
            });
            $('#submit_content').submit();
            return true;
        });
    }

    function submit_content(){
        if(addr_search()){

        }
    }
</script>
<!-- End custom js for this page-->
</body>
<style>
    .datepicker > div {
        display: block !important;
    }

    .select2-container--default .select2-selection--single{
        border: 1px solid #f2f2f2;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        /*color: #ccc;*/
    }
</style>
</html>