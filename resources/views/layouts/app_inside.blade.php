<!DOCTYPE html>
<html lang="en">

<head>
    <title>PRCPTIONS.LIVE: exploring the world's perception</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="#">
    <meta name="keywords" content="flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="/assets/mashable/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Mada:300,400,500,600,700" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="/assets/mashable/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="/assets/mashable/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="/assets/mashable/icon/icofont/css/icofont.css">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="/assets/mashable/pages/flag-icon/flag-icon.min.css">
    <!--SVG Icons Animated-->
    <link rel="stylesheet" type="text/css" href="/assets/mashable/icon/SVG-animated/svg-weather.css">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="/assets/mashable/pages/menu-search/css/component.css">
    <!-- Horizontal-Timeline css -->
    <link rel="stylesheet" type="text/css" href="/assets/mashable/pages/dashboard/horizontal-timeline/css/style.css">
    <!-- amchart css -->
    <link rel="stylesheet" type="text/css" href="/assets/mashable/pages/dashboard/amchart/css/amchart.css">
    <!-- Calender css -->
    <link rel="stylesheet" type="text/css" href="/assets/mashable/pages/widget/calender/pignose.calendar.min.css">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="/assets/mashable/pages/flag-icon/flag-icon.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="/assets/mashable/css/style.css">
    <!--color css-->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/mashable/css/linearicons.css">
    <link rel="stylesheet" type="text/css" href="/assets/mashable/css/simple-line-icons.css">
    <link rel="stylesheet" type="text/css" href="/assets/mashable/css/ionicons.css">
    <link rel="stylesheet" type="text/css" href="/assets/mashable/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="/js/dist/css/select2.min.css" />

    <link rel="stylesheet" href="/assets/css/custom_common_styles.css" />
    <link rel="stylesheet" href="/assets/css/custom.css" />

    <link rel="stylesheet" href="/assets/croppie/croppie.css" />
    <link rel="stylesheet" href="/assets/js/datatable/datatables.min.css" />
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div></div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <!-- Menu header start -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>



        <div class="pcoded-container navbar-wrapper">
            @include('partials.admin-nav-bar')



            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    <?php if(Auth::user()->is('admin')){ ?>
                    @include('partials.admin-left-sidebar')
                    <?php }elseif(Auth::user()->is('group-admin')){ ?>
                    @include('partials.group-admin-left-sidebar')
                    <?php }elseif(Auth::user()->is('moderator')){ ?>
                    @include('partials.moderator-left-sidebar')
                    <?php }else{ ?>
                    @include('partials.user-left-sidebar')
                    <?php } ?>

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                @yield('content')
                                <?php /*
                            <div class="page-wrapper">
                                <div class="page-header">
                                    <div class="page-header-title">
                                        <h4>Dashboard</h4>
                                    </div>
                                    <div class="page-header-breadcrumb">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.html">
                                                    <i class="icofont icofont-home"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Pages</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="page-body">
                                    <div class="row">
                                        <!-- Visitor Chart Start-->
                                        <div class="col-md-6 col-xl-4">
                                            <div class="card">
                                                <div class="card-block-big card-visitor-block">
                                                    <div class="row">
                                                        <div class="col-sm-8  card-visitor-button">
                                                            <button class="btn btn-primary btn-icon"><i class="icofont icofont-user-alt-3"></i></button>
                                                            <div class="card-contain">
                                                                <h6>2,534</h6>
                                                                <p class="text-muted f-18 m-0">Visitors</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 text-center">
                                                            <span class="visitor-chart"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-4">
                                            <div class="card">
                                                <div class="card-block-big card-visitor-block">
                                                    <div class="row">
                                                        <div class="col-sm-8 card-visitor-button">
                                                            <button class="btn btn-warning btn-icon"><i class="icofont icofont-shopping-cart"></i></button>
                                                            <div class="card-contain">
                                                                <h6>5,782</h6>
                                                                <p class="text-muted f-18 m-0">Total Sale</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 text-center">
                                                            <span class="sale-chart"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xl-4">
                                            <div class="card">
                                                <div class="card-block-big card-visitor-block">
                                                    <div class="row">
                                                        <div class="col-sm-8 card-visitor-button">
                                                            <button class="btn btn-success btn-icon"><i class="icofont icofont-shopping-cart"></i></button>
                                                            <div class="card-contain">
                                                                <h6>2,534</h6>
                                                                <p class="text-muted f-18 m-0">Revenue</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 text-center">
                                                            <span class="resource-barchart"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Visitor Chart End-->

                                        <!-- Start -->
                                        <!-- Analythics Start -->
                                        <div class="col-xl-8 col-md-6">
                                            <div class="card">
                                                <div class="card-block">
                                                    <h5>Analythics</h5>
                                                </div>
                                                <div class="card-block">
                                                    <div id="analythics-graph" style="height:340px"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Analythics End -->


                                        <div class="col-xl-4 col-md-6">
                                            <div class="user-card-block card">
                                                <div class="card-block">
                                                    <div class="top-card text-center">
                                                        <img src="assets/images/widget/user1.png" class="img-responsive" alt="">
                                                    </div>
                                                    <div class="card-contain text-center p-t-40">
                                                        <h5 class="text-capitalize p-b-10">Gregory Johnes</h5>
                                                        <p class="text-muted">Califonia, USA</p>
                                                    </div>
                                                    <div class="card-data m-t-40">
                                                        <div class="row">
                                                            <div class="col-3 b-r-default text-center">
                                                                <p class="text-muted">Followers</p>
                                                                <span>345</span>
                                                            </div>
                                                            <div class="col-3 b-r-default text-center">
                                                                <p class="text-muted">Following</p>
                                                                <span>40</span>
                                                            </div>
                                                            <div class="col-3 b-r-default text-center">
                                                                <p class="text-muted">Questions</p>
                                                                <span>12</span>
                                                            </div>
                                                            <div class="col-3 text-center">
                                                                <p class="text-muted">Answers</p>
                                                                <span>40</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-button p-t-50">
                                                        <div class="row">
                                                            <div class="col-6 text-right">
                                                                <button class="btn btn-primary btn-round">Follow</button>
                                                            </div>
                                                            <div class="col-6 text-left">
                                                                <button class="btn btn-success btn-round">Message</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Total Sale Start -->
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-block">
                                                    <h5>Total Sales</h5>
                                                </div>
                                                <div class="card-block">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="customtext">
                                                                <span>1,600,000</span>
                                                                <span class="p-t-5">USD</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <span class="customchart"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Total Sale Start -->

                                        <!-- Product table Start -->
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-block">
                                                    <h5>Product Detail</h5>
                                                </div>
                                                <div class="card-block product-table">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                            <tr class="text-uppercase">
                                                                <th>Product</th>
                                                                <th>Quantity</th>
                                                                <th>Total</th>
                                                                <th>Dilevery</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>1. Awesome T-shirt</td>
                                                                <td>24</td>
                                                                <td><button type="button" class="btn btn-primary">$550</button></td>
                                                                <td>M oscow,Lenina 44-1</td>
                                                                <td><button type="button" class="btn btn-success btn-round btn-outline-success">View</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>2. Awesome T-shirt</td>
                                                                <td>24</td>
                                                                <td><button type="button" class="btn btn-primary">$550</button></td>
                                                                <td>M oscow,Lenina 44-1</td>
                                                                <td><button type="button" class="btn btn-success btn-round btn-outline-success">View</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>3. Awesome T-shirt</td>
                                                                <td>24</td>
                                                                <td><button type="button" class="btn btn-primary">$550</button></td>
                                                                <td>M oscow,Lenina 44-1</td>
                                                                <td><button type="button" class="btn btn-success btn-round btn-outline-success">View</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>4. Awesome T-shirt</td>
                                                                <td>24</td>
                                                                <td><button type="button" class="btn btn-primary">$550</button></td>
                                                                <td>M oscow,Lenina 44-1</td>
                                                                <td><button type="button" class="btn btn-success btn-round btn-outline-success">View</button></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product table End -->

                                        <!-- facebook Start -->
                                        <div class="col-md-12 col-xl-8">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="news-card m-b-30 color-success card-block">
                                                        <h6>Awesome News Title</h6>
                                                        <span>22/12/2015</span>
                                                        <p class="p-t-20">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="card borderless-card">
                                                        <div class="row">
                                                            <div class="col-sm-5 weather-card-1  text-center">
                                                                <div class="mob-bg-calender bg-primary">
                                                                    <div class="row p-t-20 p-b-20">
                                                                        <div class="col-sm-12">
                                                                            <h4>Sunday</h4>
                                                                            <div class="row">
                                                                                <div class="col-6 text-right">
                                                                                    <svg version="1.1" id="sun" class="climacon climacon_sun" viewBox="15 15 70 70">
                                                                                        <clipPath id="sunFillClip">
                                                                                            <path d="M0,0v100h100V0H0z M50.001,57.999c-4.417,0-8-3.582-8-7.999c0-4.418,3.582-7.999,8-7.999s7.998,3.581,7.998,7.999C57.999,54.417,54.418,57.999,50.001,57.999z"></path>
                                                                                        </clipPath>
                                                                                        <g class="climacon_iconWrap climacon_iconWrap-sun">
                                                                                            <g class="climacon_componentWrap climacon_componentWrap-sun">
                                                                                                <g class="climacon_componentWrap climacon_componentWrap-sunSpoke">
                                                                                                    <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-east" d="M72.03,51.999h-3.998c-1.105,0-2-0.896-2-1.999s0.895-2,2-2h3.998c1.104,0,2,0.896,2,2S73.136,51.999,72.03,51.999z"></path>
                                                                                                    <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-northEast" d="M64.175,38.688c-0.781,0.781-2.049,0.781-2.828,0c-0.781-0.781-0.781-2.047,0-2.828l2.828-2.828c0.779-0.781,2.047-0.781,2.828,0c0.779,0.781,0.779,2.047,0,2.828L64.175,38.688z"></path>
                                                                                                    <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M50.034,34.002c-1.105,0-2-0.896-2-2v-3.999c0-1.104,0.895-2,2-2c1.104,0,2,0.896,2,2v3.999C52.034,33.106,51.136,34.002,50.034,34.002z"></path>
                                                                                                    <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-northWest" d="M35.893,38.688l-2.827-2.828c-0.781-0.781-0.781-2.047,0-2.828c0.78-0.781,2.047-0.781,2.827,0l2.827,2.828c0.781,0.781,0.781,2.047,0,2.828C37.94,39.469,36.674,39.469,35.893,38.688z"></path>
                                                                                                    <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-west" d="M34.034,50c0,1.104-0.896,1.999-2,1.999h-4c-1.104,0-1.998-0.896-1.998-1.999s0.896-2,1.998-2h4C33.14,48,34.034,48.896,34.034,50z"></path>
                                                                                                    <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-southWest" d="M35.893,61.312c0.781-0.78,2.048-0.78,2.827,0c0.781,0.78,0.781,2.047,0,2.828l-2.827,2.827c-0.78,0.781-2.047,0.781-2.827,0c-0.781-0.78-0.781-2.047,0-2.827L35.893,61.312z"></path>
                                                                                                    <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-south" d="M50.034,65.998c1.104,0,2,0.895,2,1.999v4c0,1.104-0.896,2-2,2c-1.105,0-2-0.896-2-2v-4C48.034,66.893,48.929,65.998,50.034,65.998z"></path>
                                                                                                    <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-southEast" d="M64.175,61.312l2.828,2.828c0.779,0.78,0.779,2.047,0,2.827c-0.781,0.781-2.049,0.781-2.828,0l-2.828-2.827c-0.781-0.781-0.781-2.048,0-2.828C62.126,60.531,63.392,60.531,64.175,61.312z"></path>
                                                                                                </g>
                                                                                                <g class="climacon_componentWrap climacon_componentWrap_sunBody" clip-path="url(#sunFillClip)">
                                                                                                    <circle class="climacon_component climacon_component-stroke climacon_component-stroke_sunBody" cx="50.034" cy="50" r="11.999"></circle>
                                                                                                </g>
                                                                                            </g>
                                                                                        </g>
                                                                                    </svg>
                                                                                </div>
                                                                                <div class="col-6 text-left">
                                                                                    <span class="weather-temp">72°</span>
                                                                                </div>
                                                                            </div>
                                                                            <h5>Wingston, D.C.</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-7 p-l-0">
                                                                <div class="text-center p-20">
                                                                    <div class="row text-center daily-whether">
                                                                        <div class="col-sm-3">
                                                                            <h5>SUN</h5>
                                                                            <svg version="1.1" id="w-svg-1" class="climacon climacon_cloudSnow" viewBox="15 15 70 70">
                                                                                <g class="climacon_iconWrap climacon_iconWrap-cloudSnow">
                                                                                    <g class="climacon_wrapperComponent climacon_wrapperComponent-snow" clip-path="url(#snowFillClip)">
                                                                                        <circle class="climacon_component climacon_component-stroke climacon_component-stroke_snow climacon_component-stroke_snow-left" cx="42.001" cy="59.641" r="2"></circle>
                                                                                        <circle class="climacon_component climacon_component-stroke climacon_component-stroke_snow climacon_component-stroke_snow-middle" cx="50.001" cy="59.641" r="2"></circle>
                                                                                        <circle class="climacon_component climacon_component-stroke climacon_component-stroke_snow climacon_component-stroke_snow-right" cx="57.999" cy="59.641" r="2"></circle>
                                                                                    </g>
                                                                                    <g class="climacon_wrapperComponent climacon_wrapperComponent-cloud">
                                                                                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_cloud" d="M63.999,64.943v-4.381c2.39-1.386,3.999-3.963,3.999-6.922c0-4.417-3.581-7.999-7.999-7.999c-1.601,0-3.083,0.48-4.333,1.291c-1.23-5.317-5.974-9.291-11.665-9.291c-6.627,0-11.998,5.373-11.998,12c0,3.549,1.55,6.729,4,8.924v4.916c-4.777-2.769-8-7.922-8-13.84c0-8.836,7.163-15.999,15.998-15.999c6.004,0,11.229,3.312,13.965,8.204c0.664-0.113,1.337-0.205,2.033-0.205c6.627,0,11.999,5.373,11.999,11.999C71.998,58.863,68.654,63.293,63.999,64.943z"></path>
                                                                                    </g>
                                                                                </g>
                                                                            </svg>
                                                                            <span>18°</span>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <h5>MON</h5>
                                                                            <svg version="1.1" id="w-svg-2" class="climacon climacon_cloudDrizzleSunAlt" viewBox="15 15 70 70">
                                                                                <clipPath id="sunCloudFillClip-2">
                                                                                    <path d="M15,15v70h70V15H15z M57.945,49.641c-4.417,0-8-3.582-8-7.999c0-4.418,3.582-7.999,8-7.999s7.998,3.581,7.998,7.999C65.943,46.059,62.362,49.641,57.945,49.641z"></path>
                                                                                </clipPath>
                                                                                <clipPath id="cloudSunFillClip-1">
                                                                                    <path d="M15,15v70h20.947V63.481c-4.778-2.767-8-7.922-8-13.84c0-8.836,7.163-15.998,15.998-15.998c6.004,0,11.229,3.312,13.965,8.203c0.664-0.113,1.338-0.205,2.033-0.205c6.627,0,11.998,5.373,11.998,12c0,5.262-3.394,9.723-8.107,11.341V85H85V15H15z"></path>
                                                                                </clipPath>
                                                                                <g class="climacon_iconWrap climacon_iconWrap-cloudDrizzleSunAlt">
                                                                                    <g clip-path="url(#cloudSunFillClip)">
                                                                                        <g class="climacon_componentWrap climacon_componentWrap-sun climacon_componentWrap-sun_cloud">
                                                                                            <g class="climacon_componentWrap climacon_componentWrap_sunSpoke">
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M80.029,43.611h-3.998c-1.105,0-2-0.896-2-1.999s0.895-2,2-2h3.998c1.104,0,2,0.896,2,2S81.135,43.611,80.029,43.611z"></path>
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M72.174,30.3c-0.781,0.781-2.049,0.781-2.828,0c-0.781-0.781-0.781-2.047,0-2.828l2.828-2.828c0.779-0.781,2.047-0.781,2.828,0c0.779,0.781,0.779,2.047,0,2.828L72.174,30.3z"></path>
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M58.033,25.614c-1.105,0-2-0.896-2-2v-3.999c0-1.104,0.895-2,2-2c1.104,0,2,0.896,2,2v3.999C60.033,24.718,59.135,25.614,58.033,25.614z"></path>
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M43.892,30.3l-2.827-2.828c-0.781-0.781-0.781-2.047,0-2.828c0.78-0.781,2.047-0.781,2.827,0l2.827,2.828c0.781,0.781,0.781,2.047,0,2.828C45.939,31.081,44.673,31.081,43.892,30.3z"></path>
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M42.033,41.612c0,1.104-0.896,1.999-2,1.999h-4c-1.104,0-1.998-0.896-1.998-1.999s0.896-2,1.998-2h4C41.139,39.612,42.033,40.509,42.033,41.612z"></path>
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M43.892,52.925c0.781-0.78,2.048-0.78,2.827,0c0.781,0.78,0.781,2.047,0,2.828l-2.827,2.827c-0.78,0.781-2.047,0.781-2.827,0c-0.781-0.78-0.781-2.047,0-2.827L43.892,52.925z"></path>
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M58.033,57.61c1.104,0,2,0.895,2,1.999v4c0,1.104-0.896,2-2,2c-1.105,0-2-0.896-2-2v-4C56.033,58.505,56.928,57.61,58.033,57.61z"></path>
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M72.174,52.925l2.828,2.828c0.779,0.78,0.779,2.047,0,2.827c-0.781,0.781-2.049,0.781-2.828,0l-2.828-2.827c-0.781-0.781-0.781-2.048,0-2.828C70.125,52.144,71.391,52.144,72.174,52.925z"></path>
                                                                                            </g>
                                                                                            <g class="climacon_wrapperComponent climacon_wrapperComponent-sunBody" clip-path="url(#sunCloudFillClip)">
                                                                                                <circle class="climacon_component climacon_component-stroke climacon_component-stroke_sunBody" cx="58.033" cy="41.612" r="11.999"></circle>
                                                                                            </g>
                                                                                        </g>
                                                                                    </g>
                                                                                    <g class="climacon_wrapperComponent climacon_wrapperComponent-drizzle">
                                                                                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_drizzle climacon_component-stroke_drizzle-left" id="Drizzle-Left_1_" d="M56.969,57.672l-2.121,2.121c-1.172,1.172-1.172,3.072,0,4.242c1.17,1.172,3.07,1.172,4.24,0c1.172-1.17,1.172-3.07,0-4.242L56.969,57.672z"></path>
                                                                                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_drizzle climacon_component-stroke_drizzle-middle" d="M50.088,57.672l-2.119,2.121c-1.174,1.172-1.174,3.07,0,4.242c1.17,1.172,3.068,1.172,4.24,0s1.172-3.07,0-4.242L50.088,57.672z"></path>
                                                                                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_drizzle climacon_component-stroke_drizzle-right" d="M43.033,57.672l-2.121,2.121c-1.172,1.172-1.172,3.07,0,4.242s3.07,1.172,4.244,0c1.172-1.172,1.172-3.07,0-4.242L43.033,57.672z"></path>
                                                                                    </g>
                                                                                    <g class="climacon_wrapperComponent climacon_wrapperComponent-cloud" clip-path="url(#cloudFillClip)">
                                                                                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_cloud" d="M63.999,64.944v-4.381c2.387-1.386,3.998-3.961,3.998-6.92c0-4.418-3.58-8-7.998-8c-1.603,0-3.084,0.481-4.334,1.291c-1.232-5.316-5.973-9.29-11.664-9.29c-6.628,0-11.999,5.372-11.999,12c0,3.549,1.55,6.729,3.998,8.926v4.914c-4.776-2.769-7.998-7.922-7.998-13.84c0-8.836,7.162-15.999,15.999-15.999c6.004,0,11.229,3.312,13.965,8.203c0.664-0.113,1.336-0.205,2.033-0.205c6.627,0,11.998,5.373,11.998,12C71.997,58.864,68.655,63.296,63.999,64.944z"></path>
                                                                                    </g>
                                                                                </g>
                                                                            </svg>
                                                                            <span>16°</span>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <h5>TUE</h5>
                                                                            <svg version="1.1" id="w-svg-3" class="climacon climacon_cloudRain" viewBox="15 15 70 70">
                                                                                <clipPath id="cloudFillClip-4">
                                                                                    <path d="M15,15v70h70V15H15z M59.943,61.639c-3.02,0-12.381,0-15.999,0c-6.626,0-11.998-5.371-11.998-11.998c0-6.627,5.372-11.999,11.998-11.999c5.691,0,10.434,3.974,11.665,9.29c1.252-0.81,2.733-1.291,4.334-1.291c4.418,0,8,3.582,8,8C67.943,58.057,64.361,61.639,59.943,61.639z"></path>
                                                                                </clipPath>
                                                                                <g class="climacon_iconWrap climacon_iconWrap-cloudRain">
                                                                                    <g class="climacon_wrapperComponent climacon_wrapperComponent-rain">
                                                                                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_rain climacon_component-stroke_rain- left" d="M41.946,53.641c1.104,0,1.999,0.896,1.999,2v15.998c0,1.105-0.895,2-1.999,2s-2-0.895-2-2V55.641C39.946,54.537,40.842,53.641,41.946,53.641z"></path>
                                                                                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_rain climacon_component-stroke_rain- middle" d="M49.945,57.641c1.104,0,2,0.896,2,2v15.998c0,1.104-0.896,2-2,2s-2-0.896-2-2V59.641C47.945,58.535,48.841,57.641,49.945,57.641z"></path>
                                                                                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_rain climacon_component-stroke_rain- right" d="M57.943,53.641c1.104,0,2,0.896,2,2v15.998c0,1.105-0.896,2-2,2c-1.104,0-2-0.895-2-2V55.641C55.943,54.537,56.84,53.641,57.943,53.641z"></path>
                                                                                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_rain climacon_component-stroke_rain- left" d="M41.946,53.641c1.104,0,1.999,0.896,1.999,2v15.998c0,1.105-0.895,2-1.999,2s-2-0.895-2-2V55.641C39.946,54.537,40.842,53.641,41.946,53.641z"></path>
                                                                                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_rain climacon_component-stroke_rain- middle" d="M49.945,57.641c1.104,0,2,0.896,2,2v15.998c0,1.104-0.896,2-2,2s-2-0.896-2-2V59.641C47.945,58.535,48.841,57.641,49.945,57.641z"></path>
                                                                                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_rain climacon_component-stroke_rain- right" d="M57.943,53.641c1.104,0,2,0.896,2,2v15.998c0,1.105-0.896,2-2,2c-1.104,0-2-0.895-2-2V55.641C55.943,54.537,56.84,53.641,57.943,53.641z"></path>
                                                                                    </g>
                                                                                    <g class="climacon_wrapperComponent climacon_wrapperComponent_cloud" clip-path="url(#cloudFillClip)">
                                                                                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_cloud" d="M63.943,64.941v-4.381c2.389-1.384,4-3.961,4-6.92c0-4.417-3.582-8-8-8c-1.601,0-3.082,0.48-4.334,1.291c-1.23-5.317-5.973-9.29-11.665-9.29c-6.626,0-11.998,5.372-11.998,11.998c0,3.549,1.551,6.728,4,8.924v4.916c-4.777-2.768-8-7.922-8-13.84c0-8.835,7.163-15.997,15.998-15.997c6.004,0,11.229,3.311,13.965,8.203c0.664-0.113,1.338-0.205,2.033-0.205c6.627,0,11.998,5.372,11.998,12C71.941,58.863,68.602,63.293,63.943,64.941z"></path>
                                                                                    </g>
                                                                                </g>
                                                                            </svg>
                                                                            <span>11°</span>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <h5>WED</h5>
                                                                            <svg version="1.1" id="w-svg-4" class="climacon climacon_cloudSnowSunAlt" viewBox="15 15 70 70">
                                                                                <clipPath id="cloudFillClip-2">
                                                                                    <path d="M15,15v70h70V15H15z M59.943,61.639c-3.02,0-12.381,0-15.999,0c-6.626,0-11.998-5.371-11.998-11.998c0-6.627,5.372-11.999,11.998-11.999c5.691,0,10.434,3.974,11.665,9.29c1.252-0.81,2.733-1.291,4.334-1.291c4.418,0,8,3.582,8,8C67.943,58.057,64.361,61.639,59.943,61.639z"></path>
                                                                                </clipPath>
                                                                                <clipPath id="sunCloudFillClip">
                                                                                    <path d="M15,15v70h70V15H15z M57.945,49.641c-4.417,0-8-3.582-8-7.999c0-4.418,3.582-7.999,8-7.999s7.998,3.581,7.998,7.999C65.943,46.059,62.362,49.641,57.945,49.641z"></path>
                                                                                </clipPath>
                                                                                <clipPath id="cloudSunFillClip">
                                                                                    <path d="M15,15v70h20.947V63.481c-4.778-2.767-8-7.922-8-13.84c0-8.836,7.163-15.998,15.998-15.998c6.004,0,11.229,3.312,13.965,8.203c0.664-0.113,1.338-0.205,2.033-0.205c6.627,0,11.998,5.373,11.998,12c0,5.262-3.394,9.723-8.107,11.341V85H85V15H15z"></path>
                                                                                </clipPath>
                                                                                <clipPath id="snowFillClip">
                                                                                    <path d="M15,15v70h70V15H15z M50,65.641c-1.104,0-2-0.896-2-2c0-1.104,0.896-2,2-2c1.104,0,2,0.896,2,2S51.104,65.641,50,65.641z"></path>
                                                                                </clipPath>
                                                                                <g class="climacon_iconWrap climacon_iconWrap-cloudSnowSunAlt">
                                                                                    <g clip-path="url(#cloudSunFillClip)">
                                                                                        <g class="climacon_componentWrap climacon_componentWrap-sun climacon_componentWrap-sun_cloud">
                                                                                            <g class="climacon_componentWrap climacon_componentWrap_sunSpoke">
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M80.029,43.611h-3.998c-1.105,0-2-0.896-2-1.999s0.895-2,2-2h3.998c1.104,0,2,0.896,2,2S81.135,43.611,80.029,43.611z"></path>
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M72.174,30.3c-0.781,0.781-2.049,0.781-2.828,0c-0.781-0.781-0.781-2.047,0-2.828l2.828-2.828c0.779-0.781,2.047-0.781,2.828,0c0.779,0.781,0.779,2.047,0,2.828L72.174,30.3z"></path>
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M58.033,25.614c-1.105,0-2-0.896-2-2v-3.999c0-1.104,0.895-2,2-2c1.104,0,2,0.896,2,2v3.999C60.033,24.718,59.135,25.614,58.033,25.614z"></path>
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M43.892,30.3l-2.827-2.828c-0.781-0.781-0.781-2.047,0-2.828c0.78-0.781,2.047-0.781,2.827,0l2.827,2.828c0.781,0.781,0.781,2.047,0,2.828C45.939,31.081,44.673,31.081,43.892,30.3z"></path>
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M42.033,41.612c0,1.104-0.896,1.999-2,1.999h-4c-1.104,0-1.998-0.896-1.998-1.999s0.896-2,1.998-2h4C41.139,39.612,42.033,40.509,42.033,41.612z"></path>
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M43.892,52.925c0.781-0.78,2.048-0.78,2.827,0c0.781,0.78,0.781,2.047,0,2.828l-2.827,2.827c-0.78,0.781-2.047,0.781-2.827,0c-0.781-0.78-0.781-2.047,0-2.827L43.892,52.925z"></path>
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M58.033,57.61c1.104,0,2,0.895,2,1.999v4c0,1.104-0.896,2-2,2c-1.105,0-2-0.896-2-2v-4C56.033,58.505,56.928,57.61,58.033,57.61z"></path>
                                                                                                <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunSpoke climacon_component-stroke_sunSpoke-north" d="M72.174,52.925l2.828,2.828c0.779,0.78,0.779,2.047,0,2.827c-0.781,0.781-2.049,0.781-2.828,0l-2.828-2.827c-0.781-0.781-0.781-2.048,0-2.828C70.125,52.144,71.391,52.144,72.174,52.925z"></path>
                                                                                            </g>
                                                                                            <g class="climacon_wrapperComponent climacon_wrapperComponent-sunBody" clip-path="url(#sunCloudFillClip)">
                                                                                                <circle class="climacon_component climacon_component-stroke climacon_component-stroke_sunBody" cx="58.033" cy="41.612" r="11.999"></circle>
                                                                                            </g>
                                                                                        </g>
                                                                                    </g>
                                                                                    <g class="climacon_wrapperComponent climacon_wrapperComponent-snowAlt">
                                                                                        <g class="climacon_component climacon_component climacon_component-snowAlt" clip-path="url(#snowFillClip)">
                                                                                            <path class="climacon_component climacon_component-stroke climacon_component-stroke_snowAlt" d="M43.072,59.641c0.553-0.957,1.775-1.283,2.732-0.731L48,60.176v-2.535c0-1.104,0.896-2,2-2c1.104,0,2,0.896,2,2v2.535l2.195-1.268c0.957-0.551,2.18-0.225,2.73,0.732c0.553,0.957,0.225,2.18-0.73,2.731l-2.196,1.269l2.196,1.268c0.955,0.553,1.283,1.775,0.73,2.732c-0.552,0.954-1.773,1.282-2.73,0.729L52,67.104v2.535c0,1.105-0.896,2-2,2c-1.104,0-2-0.895-2-2v-2.535l-2.195,1.269c-0.957,0.553-2.18,0.226-2.732-0.729c-0.552-0.957-0.225-2.181,0.732-2.732L46,63.641l-2.195-1.268C42.848,61.82,42.521,60.598,43.072,59.641z"></path>
                                                                                        </g>
                                                                                    </g>
                                                                                    <g class="climacon_wrapperComponent climacon_wrapperComponent-cloud">
                                                                                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_cloud" d="M61.998,65.461v-4.082c3.447-0.891,6-4.012,6-7.738c0-4.417-3.582-7.999-7.999-7.999c-1.601,0-3.084,0.48-4.334,1.291c-1.231-5.317-5.973-9.291-11.664-9.291c-6.627,0-11.999,5.373-11.999,12c0,4.438,2.417,8.305,5.999,10.379v4.444c-5.86-2.375-9.998-8.112-9.998-14.825c0-8.835,7.162-15.999,15.998-15.999c6.004,0,11.229,3.312,13.965,8.204c0.664-0.113,1.336-0.205,2.033-0.205c6.626,0,11.998,5.373,11.998,11.998C71.997,59.586,67.671,64.506,61.998,65.461z"></path>
                                                                                    </g>
                                                                                </g>
                                                                            </svg>
                                                                            <span>21°</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- facebook End -->
                                        <!-- Start-->
                                        <div class="col-md-12 col-xl-4">
                                            <!-- Overdue Task Start-->
                                            <div class="row">
                                                <div class="col-xl-12 col-md-6">
                                                    <div class="card">
                                                        <div class="card-block-big card-status">
                                                            <h5>Income Status</h5>
                                                            <div class="card-block text-center">
                                                                <h2 class="text-primary">$4,612</h2>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <p class="f-16 text-muted m-0">Totale Income : $4,679</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="text-muted f-16 text-right">
                                                                        <span>20.56%</span>
                                                                        <i class="icofont icofont-caret-up text-success"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-md-6">
                                                    <div class="card">
                                                        <div class="card-block-big card-status">
                                                            <h5>Sale Status</h5>
                                                            <div class="card-block text-center">
                                                                <h2 class="text-warning">425</h2>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <p class="f-16 text-muted m-0">Totale Income : 3,712</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="text-muted f-16 text-right">
                                                                        <span>20.56%</span>
                                                                        <i class="icofont icofont-caret-down text-primary"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End-->

                                        <!-- Reset Order Start -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-block">
                                                    <h5>Reset Order</h5>
                                                </div>
                                                <div class="card-block reset-table p-t-0">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                            <tr class="text-uppercase">
                                                                <th>Image</th>
                                                                <th>Product Name</th>
                                                                <th>Product Code</th>
                                                                <th>Status</th>
                                                                <th>Purchased on</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td><a href="#!"><img class="img-responsive" src="assets/images/widget/prod1.jpg" alt="chat-user"></a>
                                                                </td>
                                                                <td>Leisure Suit Casual</td>
                                                                <td>3BSD59</td>
                                                                <td><button type="button" class="btn btn-success btn-round">Pending</button></td>
                                                                <td>27 Sep 2015</td>
                                                                <td>$99.00</td>
                                                                <td>2</td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="#!"><img class="img-responsive" src="assets/images/widget/prod4.jpg" alt="chat-user"></a>
                                                                </td>
                                                                <td>Leisure Suit Casual</td>
                                                                <td>3BSD59</td>
                                                                <td><button type="button" class="btn btn-primary btn-round">Process</button></td>
                                                                <td>27 Sep 2015</td>
                                                                <td>$99.00</td>
                                                                <td>2</td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="#!"><img class="img-responsive" src="assets/images/widget/prod2.jpg" alt="chat-user"></a>
                                                                </td>
                                                                <td>Leisure Suit Casual</td>
                                                                <td>3BSD59</td>
                                                                <td><button type="button" class="btn btn-warning btn-round">Failed</button></td>
                                                                <td>27 Sep 2015</td>
                                                                <td>$99.00</td>
                                                                <td>2</td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="#!"><img class="img-responsive" src="assets/images/widget/prod3.jpg" alt="chat-user"></a>
                                                                </td>
                                                                <td>Leisure Suit Casual</td>
                                                                <td>3BSD59</td>
                                                                <td><button type="button" class="btn btn-primary btn-round">Process</button></td>
                                                                <td>27 Sep 2015</td>
                                                                <td>$99.00</td>
                                                                <td>2</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Reset Order End -->

                                    </div>
                                </div>
                            </div>
                            */ ?>

                                {{--<div id="styleSelector">--}}

                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Warning Section Ends -->
    <!-- Required Jqurey -->
    <script type="text/javascript" src="/assets/mashable/bower_components/jquery/js/jquery.min.js"></script>
    <script src="/assets/mashable/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/assets/mashable/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="/assets/mashable/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="/assets/mashable/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="/assets/mashable/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="/assets/mashable/bower_components/modernizr/js/css-scrollbars.js"></script>
    <!-- Calender js -->
    <script type="text/javascript" src="/assets/mashable/bower_components/moment/js/moment.min.js"></script>
    <script type="text/javascript" src="/assets/mashable/pages/widget/calender/pignose.calendar.min.js"></script>
    <!-- classie js -->
    <!-- c3 chart js -->
    <script src="/assets/mashable/bower_components/c3/js/c3.js"></script>
    <script type="text/javascript" src="/assets/mashable/bower_components/classie/js/classie.js"></script>
    <!-- knob js -->
    <script src="/assets/mashable/pages/chart/knob/jquery.knob.js"></script>
    <script type="text/javascript" src="/assets/mashable/pages/widget/jquery.sparkline.js"></script>
    <!-- Rickshow Chart js -->
    <script src="/assets/mashable/bower_components/d3/js/d3.js"></script>
    <script src="/assets/mashable/bower_components/rickshaw/js/rickshaw.js"></script>
    <!-- Morris Chart js -->
    <script src="/assets/mashable/bower_components/raphael/js/raphael.min.js"></script>
    <script src="/assets/mashable/bower_components/morris.js/js/morris.js"></script>
    <!-- Float Chart js -->
    <script src="/assets/mashable/pages/chart/float/jquery.flot.js"></script>
    <script src="/assets/mashable/pages/chart/float/jquery.flot.categories.js"></script>
    <script src="/assets/mashable/pages/chart/float/jquery.flot.pie.js"></script>
    <!-- Horizontal-Timeline js -->
    <script type="text/javascript" src="/assets/mashable/pages/dashboard/horizontal-timeline/js/main.js"></script>
    <!-- amchart js -->
    <script type="text/javascript" src="/assets/mashable/pages/dashboard/amchart/js/amcharts.js"></script>
    <script type="text/javascript" src="/assets/mashable/pages/dashboard/amchart/js/serial.js"></script>
    <script type="text/javascript" src="/assets/mashable/pages/dashboard/amchart/js/light.js"></script>
    <script type="text/javascript" src="/assets/mashable/pages/dashboard/amchart/js/custom-amchart.js"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="/assets/mashable/bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="/assets/mashable/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="/assets/mashable/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="/assets/mashable/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="/assets/mashable/pages/dashboard/custom-dashboard.js"></script>
    <script type="text/javascript" src="/assets/mashable/js/script.js"></script>

    <!-- pcmenu js -->
    <script src="/assets/mashable/js/pcoded.min.js"></script>
    <script src="/assets/mashable/js/demo-12.js"></script>
    <script src="/assets/mashable/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="/assets/mashable/js/jquery.mousewheel.min.js"></script>
    <script src="/js//dist/js/select2.full.min.js"></script>
    <script src="/assets/js/custom_common.js"></script>
    <script type="text/javascript" src="/assets/mashable/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/assets/js/app.js"></script>
    <script src="/assets/croppie/croppie.js"></script>
    <script src="/assets/js/datatable/datatables.min.js"></script>

    <script src="/assets/js/dropzone.js"></script>

    <script>
        $(document).ready(function() {
            // $('#users_llist').DataTable({"aaSorting": []});
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                // startDate: '-3d',
                autoclose: true,
                keepOpen: false,
            });

            $('.select2-ajax-content').trigger('change');
            $('.select2-ajax-users').trigger('change');
            $('.select2-ajax-groups').trigger('change');
            $('.select2-ajax-my-groups-content').trigger('change');
        });



        function submit_content() {
            if (addr_search()) {

            }
        }

        $('.select2-ajax-content').select2({
            ajax: {
                url: '/home/ajax/video-search-list',
                dataType: 'json'
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            }
        });

        $('.select2-ajax-users').select2({
            ajax: {
                url: '/home/ajax/user-search-list',
                dataType: 'json'
            }
        });


        $('.select2-ajax-groups').select2({
            ajax: {
                url: '/home/ajax/group-search-list',
                dataType: 'json'
            }
        });

        $('.select2-ajax-my-groups-content').select2({
            ajax: {
                url: '/home/ajax/video-search-list?only_my_group=yes',
                dataType: 'json'
            }
        });

        $('#shearable_code').click(function() {
            $(this).select();
        })

    </script>




    <script type="text/javascript">
        $(document).ready(function() {
            var $uploadCrop;

            function readFile(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $uploadCrop.croppie('bind', {
                            url: e.target.result
                        });
                        $('.upload-demo').addClass('ready');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $uploadCrop = $('#upload-profile').croppie({
                viewport: {
                    width: 120,
                    height: 120,
                    type: 'circle'
                },
                boundary: {
                    width: 200,
                    height: 200
                }
            });

            $('#upload').on('change', function() {
                readFile(this);
                // updateSource();
                setInterval(updateSource, 300);
            });

            function updateSource() {
                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: 'original'
                }).then(function(resp) {
                    $('#imagebase64').val(resp);
                    // $('#form').submit();
                });
            }
            $('.upload-result').on('click', function(ev) {
                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: 'original'
                }).then(function(resp) {
                    $('#imagebase64').val(resp);
                    // $('#form').submit();
                });
            });

            console.log('image path is ' + $('#preset_image_path').val());
            $('.cr-image').attr('src', $('#preset_image_path').val());
        });
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</body>

</html>
<?php /*<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="/assets/admin-temp/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/admin-temp/vendors/css/vendor.bundle.base.css">
    {{--<link rel="stylesheet" href="/assets/admin-temp/css/style.css">--}}
    <link rel="stylesheet" href="/assets/admin-temp/css/style2.css" />

    {{--<link rel="stylesheet" href="/assets/admin-temp/vendors/css/vendor.bundle.addons.css">--}}
    <link rel="stylesheet" href="/js/dist/css/select2.min.css" />
    <link rel="stylesheet" href="/assets/css/custom_common_styles.css">
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}
    <link rel="shortcut icon" href="/assets/admin-temp/images/favicon.png" />
    {{--<link rel="stylesheet" href="https://www.bootstrapdash.com/demo/star-admin-pro/jquery/css/style.css" />--}}

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
            {{--<a class="navbar-brand brand-logo" href="index.html">--}}
                {{--<img src="images/logo.svg" alt="logo" />--}}
            {{--</a>--}}
            {{--<a class="navbar-brand brand-logo-mini" href="index.html">--}}
                {{--<img src="images/logo-mini.svg" alt="logo" />--}}
            {{--</a>--}}
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

    <?php if(Auth::user()->is('admin')){ ?>
@include('partials.admin-left-sidebar')
<?php }elseif(Auth::user()->is('group-admin')){ ?>
@include('partials.group-admin-left-sidebar')F
<?php }elseif(Auth::user()->is('moderator')){ ?>
@include('partials.moderator-left-sidebar')
<?php }else{ ?>
@include('partials.user-left-sidebar')
<?php } ?>



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

<script src="/assets/admin-temp/vendors/js/vendor.bundle.base.js"></script>
<script src="/assets/admin-temp/vendors/js/vendor.bundle.addons.js"></script>
<script src="/assets/admin-temp/js/off-canvas.js"></script>
<script src="/assets/admin-temp/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="/assets/admin-temp/js/dashboard.js"></script>

<script src="/js//dist/js/select2.full.min.js"></script>
<script src="/assets/js/custom_common.js"></script>

<script src="/assets/js/app.js"></script>

<script>
    $(document).ready(function() {
        $('#users_llist').DataTable({
            "aaSorting": []
        });
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            // startDate: '-3d',
            autoclose: true,
            keepOpen: false,
        });
        //        $('.datepicker').on('changeDate', function(ev){
        //            $(this).datepicker('hide');
        //        });

        $('.select2-ajax-content').trigger('change');
        $('.select2-ajax-users').trigger('change');
        $('.select2-ajax-groups').trigger('change');
        $('.select2-ajax-my-groups-content').trigger('change');
    });



    function submit_content() {
        if (addr_search()) {

        }
    }

    $('.select2-ajax-content').select2({
        ajax: {
            url: '/home/ajax/video-search-list',
            dataType: 'json'
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
        }
    });

    $('.select2-ajax-users').select2({
        ajax: {
            url: '/home/ajax/user-search-list',
            dataType: 'json'
        }
    });


    $('.select2-ajax-groups').select2({
        ajax: {
            url: '/home/ajax/group-search-list',
            dataType: 'json'
        }
    });

    $('.select2-ajax-my-groups-content').select2({
        ajax: {
            url: '/home/ajax/video-search-list?only_my_group=yes',
            dataType: 'json'
        }
    });

    $('#shearable_code').click(function() {
        $(this).select();
    })

</script>
<!-- End custom js for this page-->
</body>
<style>
    #featureModal .modal-dialog {
        width: 950px;
        max-width: 950px;
    }

    .select2-container .select2-selection--single {
        height: 38px;
    }

</style>

</html>
*/ ?>
