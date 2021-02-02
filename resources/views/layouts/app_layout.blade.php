<!DOCTYPE html>
<html lang="en" class="page-admin-wrapper">

<head>
  <title>{{env('APP_NAME')}}</title>
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <!-- Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta name="description" content="Perceptions.live is a place for media communities to collaborate and connect worldwide.">
  <meta name="keywords" content="Community building, community, media, video editing, frontline communities, grassroots, grassroots organizations">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

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
  <style>
    .user-profile {
      padding: 0
    }
    nav.two {
      border: none;
    }
    nav.two .user-profile .fas.fa-sort-down {
      top: auto;
      height: 70px;
    }
    nav.two .uimg {
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }
    .select2-container--default .select2-selection--single {
      border: none;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
      display: none;
    }
    @media only screen and (max-width: 768px) {
      nav.two {
        padding-right: 0;
        min-width: auto;
      }
      nav.two .header-notification .profile-notification {
        right: 0;
      }
      nav.two .uname {
        display: none;
      }
      nav.two .user-profile .uimg {
        width: 40px;
        height: 40px
      }
      nav.two .fa-sort-down {
        display: none;
      }
    }
    @media only screen and (max-width: 576px) {
      .new-header .top-bar .navbar-logo img {
        width: 150px;
      }
    }
  </style>
</head>

<body class="page-admin">
  <div class="page-loading">
    <img src="/assets/frontend/images/loader.gif" alt="" />
  </div>
  <header class="new-header" >
    <div class="header-content">
      <div class="top-bar">
        <div class="top-bar__left">
          <a href="/" class="navbar-logo" onclick="resetSearch()">
            <img src="/assets/frontend/images/live-perceptions-logo.png" alt="">
          </a>
        </div>
        <div class="top-bar__right">
          @if (Route::has('login'))
          @auth
          
          <nav class="two">
            <ul>
              <li class="user-profile header-notification">
                  <a href="#!">
                      <span class="uimg" style="background-image: url(<?php if(isset($user_img[0])){ echo '/storage/'.$user_img[0]->url; }else{ ?>/assets/img/face1.png<?php } ?>)">
                          <!-- <img src="<?php if(isset($user_img[0])){ echo '/storage/'.$user_img[0]->url; }else{ ?>/assets/img/face1.png<?php } ?>" alt="profile image"> -->
                      </span>

                      <span class="uname"><?php echo Auth::user()->display_name ?></span>
                      <i class="fas fa-sort-down"></i>
                  </a>
                  <ul class="show-notification profile-notification">
                    <li>
                      <a href="/user/user-profile">
                        <i class="fas fa-user-cog"></i>
                        My Profile
                      </a>
                    </li>
                    <li>
                      <a href="/user/group-admin/content-list">
                        <i class="fas fa-video"></i>
                        My Videos
                      </a>
                    </li>
                    <li><a href="/claim-profile" target="_blank">
                        <i class="fas fa-user-circle"></i>
                        Claim A Profile</a></li>
                    <li>
                          <a href="/user/logout">
                              <i class="fas fa-sign-out-alt"></i> Logout {{Auth::user()->first_name}}
                          </a>
                      </li>
                  </ul>
              </li>
            </ul>
          </nav>

          @else 
          <button class="btn-sign-up accountbtn">Sign Up / Log In</button>
          @endif
          @endif
        </div>
      </div>
    </div>
  </header>
  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>



    <div class="pcoded-container navbar-wrapper">
      <!-- Sidebar inner chat end-->
      <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
          <div class="">
            <div class="pcoded-inner-content">
              <div class="main-body">
                @yield('content')

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <span style="display: block; padding-bottom: 7px; margin: auto;">
        <a href="https://perceptiontravel.tv/privacy-policy" target="_blank">Privacy Policy</a> | <a href="https://perceptiontravel.tv/terms-of-service" target="_blank">Terms of Service</a> | <a href="https://perceptiontravel.tv/community/donations/" target="_blank">Make a Donation</a> | <a href="https://perceptiontravel.tv/community-feedback/" target="_blank">Submit Feedback</a> | <a href="https://perceptiontravel.tv/about/" target="_blank">About Us</a> | <a href="/contact-us" target="_blank">Contact Us</a></span>
      <span>
        <strong>© 2018-2019 <a href="https://perceptiontravel.tv/" target="_blank">PRCPTION Travel, Inc.</a> - a non-profit, 501(c)3 organization.</strong></span>

    </div>
  </div>

  <script type="text/javascript" src="/assets/mashable/bower_components/jquery/js/jquery.min.js"></script>
  <script src="/assets/mashable/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="/assets/mashable/bower_components/popper.js/js/popper.min.js"></script>
  <script type="text/javascript" src="/assets/mashable/bower_components/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/assets/mashable/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
  <script type="text/javascript" src="/assets/mashable/bower_components/modernizr/js/modernizr.js"></script>
  <script type="text/javascript" src="/assets/mashable/bower_components/modernizr/js/css-scrollbars.js"></script>
  <script type="text/javascript" src="/assets/mashable/bower_components/moment/js/moment.min.js"></script>
  <script type="text/javascript" src="/assets/mashable/pages/widget/calender/pignose.calendar.min.js"></script>
  <script src="/assets/mashable/bower_components/c3/js/c3.js"></script>
  <script type="text/javascript" src="/assets/mashable/bower_components/classie/js/classie.js"></script>
  <script src="/assets/mashable/pages/chart/knob/jquery.knob.js"></script>
  <script type="text/javascript" src="/assets/mashable/pages/widget/jquery.sparkline.js"></script>
  <script src="/assets/mashable/bower_components/d3/js/d3.js"></script>
  <script src="/assets/mashable/bower_components/rickshaw/js/rickshaw.js"></script>
  <script src="/assets/mashable/bower_components/raphael/js/raphael.min.js"></script>
  <script src="/assets/mashable/bower_components/morris.js/js/morris.js"></script>
  <script src="/assets/mashable/pages/chart/float/jquery.flot.js"></script>
  <script src="/assets/mashable/pages/chart/float/jquery.flot.categories.js"></script>
  <script src="/assets/mashable/pages/chart/float/jquery.flot.pie.js"></script>
  <script type="text/javascript" src="/assets/mashable/pages/dashboard/horizontal-timeline/js/main.js"></script>
  <script type="text/javascript" src="/assets/mashable/pages/dashboard/amchart/js/amcharts.js"></script>
  <script type="text/javascript" src="/assets/mashable/pages/dashboard/amchart/js/serial.js"></script>
  <script type="text/javascript" src="/assets/mashable/pages/dashboard/amchart/js/light.js"></script>
  <script type="text/javascript" src="/assets/mashable/pages/dashboard/amchart/js/custom-amchart.js"></script>
  <script type="text/javascript" src="/assets/mashable/bower_components/i18next/js/i18next.min.js"></script>
  <script type="text/javascript" src="/assets/mashable/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
  <script type="text/javascript" src="/assets/mashable/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
  <script type="text/javascript" src="/assets/mashable/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
  <script type="text/javascript" src="/assets/mashable/pages/dashboard/custom-dashboard.js"></script>
  <script type="text/javascript" src="/assets/mashable/js/script.js"></script>

  <script src="/assets/mashable/js/pcoded.min.js"></script>
  <script src="/assets/js/notify.js"></script>
  <script src="/assets/mashable/js/demo-12.js"></script>
  <script src="/assets/mashable/js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="/assets/mashable/js/jquery.mousewheel.min.js"></script>
  <script src="/js//dist/js/select2.full.min.js"></script>
  <script src="/assets/js/custom_common.js"></script>
  <script type="text/javascript" src="/assets/mashable/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="/js/jquery.timeago.js"></script>
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
  <script>
    jQuery("time.timeago").timeago();
  </script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
</body>

</html>