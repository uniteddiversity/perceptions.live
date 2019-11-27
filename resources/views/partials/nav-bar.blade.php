<div class="responsiveheader">
    <div class="rheader">

        <img src="/assets/findgo/images/ricon.png" alt="" style="display:none;" />
        <span class="menubt">
            <i class="fas fa-bars"></i>
        </span>

        <div class="logo_mobile">

        </div>
        <?php /* <div class="logo">
            <a href="#" title=""><img src="/assets/findgo/images/live-prcptions-beta-small.png" width=100 height=388 alt="" /></a>
        </div> */ ?>
        <div class="extras" style="display:none;">
            <span class="accountbtn"><i class="flaticon-avatar"></i></span>
        </div>
    </div>
    <div class="rnaver">
        <div class="topb">
            <span class="closeresmenu"><i>x</i></span>
            <P>Navigation</P>
        </div>


        <ul>
            @if (Route::has('login'))

            <li class="important">
                <a href="/claim-profile" target="_blank"><i class="fas fa-user-circle"></i> Claim A Profile</a>
            </li>
            <li class="important">
                <a href="https://perceptiontravel.tv/about-perceptions-live" target="_blank"><i class="fas fa-info-circle"></i>&nbsp;About</a>
            </li>
            @auth
            <li class="important">
                <a href="/user/logout">
                    <i class="fas fa-sign-out-alt"></i> Logout {{Auth::user()->first_name}}
                </a>
            </li>
            @else

            @endauth
            <li style="min-height:12px; background:#fff;"></li>
            <li>
                <a href="#"><i class="fas fa-user-secret"></i>Privacy Policy</a>
            </li>
            <li>
                <a href="#"><i class="far fa-file-alt"></i>Terms of Service</a>
            </li>
            <li>
                <a href="#"><i class="fas fa-hand-holding-usd"></i>Make a Donation</a>
            </li>
            <li>
                <a href="#"><i class="fas fa-pencil-alt"></i>Submit Feedback</a>
            </li>
            <li>
                <a href="/contact-us"><i class="fas fa-pencil-alt"></i>Contact Us</a>
            </li>
            @endif


        </ul>

        @if (Route::has('login'))

        @auth
        <div class="extras">
            <a class="accountbtn two" href="/user/content-add" title="">
                <i class="fas fa-video"></i> Submit PRCPTION</a>
        </div>
        @else
        <div class="extras">
            <span class="accountbtn btn">
                Sign Up/Log In
            </span>
        </div>
        @endif
        @endif
    </div>
    <div class="topsearch" id="slider_feed2">
        <div class="site_mid_title">
            <h5>{{$settings['home_centered_title'] or ""}}</h5>
        </div>
        <div class="site_slider_feed">
            @if(isset($top_slider_feed))
            <div class="left_feed slideshow">
                <span>{{$settings['left_feed_name'] or ""}}</span>
                <div class="thumbs-container bottom">
                    <div id="prev-btn" class="prev">
                        <i class="fa fa-chevron-left fa-1x"></i>
                    </div>
                    <ul class="thumbs">
                        <?php $i = 0; ?>
                        @foreach($top_slider_feed as $feed)
                        <?php $i++; ?>
                        @if($feed['side'] == 'left')
                        <li data-thumb-id="<?php echo $i ?>" class="thumb active" style="background-image: url('/storage/{{$feed['icon']}}')">
                            <span>{{$feed['title']}}</span>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                    <div id="next-btn" class="next">
                        <i class="fa fa-chevron-right fa-1x"></i>
                    </div>
                </div>
            </div>
            <div class="near_me_icon">
                <i class="map_center_icon"></i>
                <p>Nearby Me</p>
            </div>
            <div class="right_feed slideshow">
                <span>{{$settings['right_feed_name'] or ""}}</span>
                <div class="thumbs-container bottom">
                    <div id="prev-btn" class="prev">
                        <i class="fa fa-chevron-left fa-1x"></i>
                    </div>
                    <ul class="thumbs">
                        <?php $i = 0; ?>
                        @foreach($top_slider_feed as $feed)
                        <?php $i++; ?>
                        @if($feed['side'] == 'right')
                        <li data-thumb-id="<?php echo $i ?>" class="thumb active" style="background-image: url('/storage/{{$feed['icon']}}')"></li>
                        @endif
                        @endforeach
                    </ul>
                    <div id="next-btn" class="next">
                        <i class="fa fa-chevron-right fa-1x"></i>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<header class="new-header">
  <div class="header-content">
    <div class="top-bar">
      <div class="top-bar__left">
        <a href="/" class="navbar-logo" onclick="resetSearch()">
          <img src="/assets/findgo/images/live-perceptions-logo.png" alt="">
        </a>
        <div class="search-box">
          <div class="search-box-content">
            <input type="text" placeholder="Quick Search" name="search_text" id="search_text" />
            <button class="btn-search"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </div>
      <h5 class="header-title">"{{$settings['home_centered_title'] or ""}}"</h5>
      <div class="top-bar__right">
        <a class="btn-create-community" data-toggle="modal" data-target="/user/admin/user-group-add">
          <i class="fas fa-users"></i>
          Create Community
        </a>
        <button class="btn-sign-up">Sign Up / Log In</button>
      </div>
    </div>
  </div>
  <div class="header-toolbar">
    <div class="header-toolbar__content">
      <div class="header-toolbar__left header-slider">
        <p class="slider-title">{{$settings['left_feed_name'] or ""}}</p>
        <div class="thumbs-container bottom">
          <div class="thumb_wrapper">
            <div class="left_slide">
              <?php $i = 0; ?>
              @foreach($top_slider_feed as $feed)
              @if($feed['side'] == 'left')
              <?php $i++; ?>
              <div class="slick-tile">
                <div onclick="loadFilters({{$feed['fk_id']}},'{{$feed['type']}}')" data-thumb-id="<?php echo $i ?>" 
                    class="slider-image thumb <?php if($i) echo 'active' ?>" 
                    style="background-image: url('{{ Imgfly::imgFly('../public/'.$feed['icon'].'?w=35' ) }}')">
                </div>
                <div class="slider-text">{{$feed['title']}}</div>
              </div>
              @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class="header-toolbar__center">
        <a class="btn-near-me">
          <img src="/assets/img/map_center_icon.svg" alt="">
          <span>Near by Me</span>
        </a>
      </div>
      <div class="header-toolbar__right header-slider">
        <p class="slider-title">{{$settings['right_feed_name'] or ""}}</p>
        <div class="thumbs-container bottom">
          <div class="thumb_wrapper">
            <div class="right_slide">
                <?php $i = 0; ?>
                @foreach($top_slider_feed as $feed)
                @if($feed['side'] == 'right')
                <?php $i++; ?>
                <div class="slick-tile">
                    <div class="slider-image" onclick="loadFilters({{$feed['fk_id']}},'{{$feed['type']}}')" data-thumb-id="<?php echo $i ?>" class="thumb <?php if($i) echo 'active' ?>" style="background-image: url('{{ Imgfly::imgFly('../public/'.$feed['icon'].'?w=35' ) }}')">
                    </div>
                    <div class="slider-text">{{$feed['title']}}</div>
                </div>
                @endif
                @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<style>
  #logo_overlay {
    position: absolute;
    display: block;
    width: 40%;
    margin-left: 6%;
    background-color: #transparent;
    z-index: 50;
  }

</style>




<?php /*


<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="navbar-icon-container">
                <a href="#" class="navbar-icon pull-right visible-xs" id="nav-btn"><i class="fa fa-bars fa-lg white"></i></a>
                <a href="#" class="navbar-icon pull-right visible-xs" id="sidebar-toggle-btn"><i class="fa fa-search fa-lg white"></i></a>
            </div>
            <a data-toggle="collapse" data-target=".navbar-collapse.in" class="navbar-brand" href="/">OSM</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @if (Route::has('login'))

                        @auth
                        <?php if(Auth::user()->is('admin')){ ?>
<li><a href="/user/admin/content-add" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-upload white"></i>&nbspControl panel</a></li>
<?php }else{ ?>
<li><a href="/user/content-add" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-upload white"></i>&nbspUpload a Video</a></li>
<?php } ?>

<li><a href="/user/logout" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-sign-out white"></i>&nbspLogout {{Auth::user()->first_name}}</a></li>
@else
<li><a href="#" data-toggle="collapse" data-target=".navbar-collapse.in" id="login-btn"><i class="fa fa-user white"></i>&nbspLogin</a></li>
<li><a href="#" data-toggle="collapse" data-target=".navbar-collapse.in" id="register-btn"><i class="fa fa-registered white"></i>&nbspRegister</a></li>
@endauth
<li><a href="/claim-profile" target="_blank"><i class="fa fa-registered white"></i>&nbspClaim Your Profile</a></li>
@endif
</ul>
</div>
</div>
</div>
*/ ?>