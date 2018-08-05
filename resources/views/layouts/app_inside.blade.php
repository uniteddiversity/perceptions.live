<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin Free Bootstrap Admin Dashboard Template</title>
    <link rel="stylesheet" href="/assets/admin-temp/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/admin-temp/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets/admin-temp/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="/assets/admin-temp/css/style.css">
    <link rel="shortcut icon" href="/assets/admin-temp/images/favicon.png" />
</head>

<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
            <a class="navbar-brand brand-logo" href="index.html">
                {{--<img src="images/logo.svg" alt="logo" />--}}
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.html">
                <img src="images/logo-mini.svg" alt="logo" />
            </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
            @include('partials.admin-nav-bar')
            {{--<ul class="navbar-nav navbar-nav-right">--}}
                {{--<li class="nav-item dropdown">--}}
                    {{--<a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">--}}
                        {{--<i class="mdi mdi-file-document-box"></i>--}}
                        {{--<span class="count">7</span>--}}
                    {{--</a>--}}
                    {{--<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">--}}
                        {{--<div class="dropdown-item">--}}
                            {{--<p class="mb-0 font-weight-normal float-left">You have 7 unread mails--}}
                            {{--</p>--}}
                            {{--<span class="badge badge-info badge-pill float-right">View all</span>--}}
                        {{--</div>--}}
                        {{--<div class="dropdown-divider"></div>--}}
                        {{--<a class="dropdown-item preview-item">--}}
                            {{--<div class="preview-thumbnail">--}}
                                {{--<img src="images/faces/face4.jpg" alt="image" class="profile-pic">--}}
                            {{--</div>--}}
                            {{--<div class="preview-item-content flex-grow">--}}
                                {{--<h6 class="preview-subject ellipsis font-weight-medium text-dark">David Grey--}}
                                    {{--<span class="float-right font-weight-light small-text">1 Minutes ago</span>--}}
                                {{--</h6>--}}
                                {{--<p class="font-weight-light small-text">--}}
                                    {{--The meeting is cancelled--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                        {{--<div class="dropdown-divider"></div>--}}
                        {{--<a class="dropdown-item preview-item">--}}
                            {{--<div class="preview-thumbnail">--}}
                                {{--<img src="images/faces/face2.jpg" alt="image" class="profile-pic">--}}
                            {{--</div>--}}
                            {{--<div class="preview-item-content flex-grow">--}}
                                {{--<h6 class="preview-subject ellipsis font-weight-medium text-dark">Tim Cook--}}
                                    {{--<span class="float-right font-weight-light small-text">15 Minutes ago</span>--}}
                                {{--</h6>--}}
                                {{--<p class="font-weight-light small-text">--}}
                                    {{--New product launch--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                        {{--<div class="dropdown-divider"></div>--}}
                        {{--<a class="dropdown-item preview-item">--}}
                            {{--<div class="preview-thumbnail">--}}
                                {{--<img src="images/faces/face3.jpg" alt="image" class="profile-pic">--}}
                            {{--</div>--}}
                            {{--<div class="preview-item-content flex-grow">--}}
                                {{--<h6 class="preview-subject ellipsis font-weight-medium text-dark"> Johnson--}}
                                    {{--<span class="float-right font-weight-light small-text">18 Minutes ago</span>--}}
                                {{--</h6>--}}
                                {{--<p class="font-weight-light small-text">--}}
                                    {{--Upcoming board meeting--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li class="nav-item dropdown">--}}
                    {{--<a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">--}}
                        {{--<i class="mdi mdi-bell"></i>--}}
                        {{--<span class="count">4</span>--}}
                    {{--</a>--}}
                    {{--<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">--}}
                        {{--<a class="dropdown-item">--}}
                            {{--<p class="mb-0 font-weight-normal float-left">You have 4 new notifications--}}
                            {{--</p>--}}
                            {{--<span class="badge badge-pill badge-warning float-right">View all</span>--}}
                        {{--</a>--}}
                        {{--<div class="dropdown-divider"></div>--}}
                        {{--<a class="dropdown-item preview-item">--}}
                            {{--<div class="preview-thumbnail">--}}
                                {{--<div class="preview-icon bg-success">--}}
                                    {{--<i class="mdi mdi-alert-circle-outline mx-0"></i>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="preview-item-content">--}}
                                {{--<h6 class="preview-subject font-weight-medium text-dark">Application Error</h6>--}}
                                {{--<p class="font-weight-light small-text">--}}
                                    {{--Just now--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                        {{--<div class="dropdown-divider"></div>--}}
                        {{--<a class="dropdown-item preview-item">--}}
                            {{--<div class="preview-thumbnail">--}}
                                {{--<div class="preview-icon bg-warning">--}}
                                    {{--<i class="mdi mdi-comment-text-outline mx-0"></i>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="preview-item-content">--}}
                                {{--<h6 class="preview-subject font-weight-medium text-dark">Settings</h6>--}}
                                {{--<p class="font-weight-light small-text">--}}
                                    {{--Private message--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                        {{--<div class="dropdown-divider"></div>--}}
                        {{--<a class="dropdown-item preview-item">--}}
                            {{--<div class="preview-thumbnail">--}}
                                {{--<div class="preview-icon bg-info">--}}
                                    {{--<i class="mdi mdi-email-outline mx-0"></i>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="preview-item-content">--}}
                                {{--<h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>--}}
                                {{--<p class="font-weight-light small-text">--}}
                                    {{--2 days ago--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                <li class="nav-item dropdown d-none d-xl-inline-block">
                    {{--<a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">--}}
                        {{--<span class="profile-text">Hello, Richard V.Welsh !</span>--}}
                        {{--<img class="img-xs rounded-circle" src="/assets/admin-temp/images/faces/face1.jpg" alt="Profile image">--}}
                    {{--</a>--}}
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
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">


    @include('partials.admin-left-sidebar')


        <!-- partial -->
        <div class="main-panel">
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
<script src="/assets/admin-temp/vendors/js/vendor.bundle.base.js"></script>
<script src="/assets/admin-temp/vendors/js/vendor.bundle.addons.js"></script>
<script src="/assets/admin-temp/js/off-canvas.js"></script>
<script src="/assets/admin-temp/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="/assets/admin-temp/js/dashboard.js"></script>

<script>
    $(document).ready(function() {
        $('#users_llist').DataTable();
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
        });
    } );
</script>
<!-- End custom js for this page-->
</body>

</html>