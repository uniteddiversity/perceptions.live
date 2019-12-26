<header class="new-header">
  <div class="header-content">
    <div class="top-bar">
      <div class="top-bar__left">
        <a href="/" class="navbar-logo" onclick="resetSearch()">
          <img src="/assets/findgo/images/live-perceptions-logo.png" alt="">
        </a>
        <div class="search-box">
          <div class="search-box-content">
            <input type="text" placeholder="Quick Search" name="header_search_text" id="header_search_text" />
            <button class="btn-search" onclick="toggleSearchbar()"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </div>
      <h5 class="header-title">"{{$settings['home_centered_title'] or ""}}"</h5>
      <div class="top-bar__right">
        <a class="btn-create-community" data-toggle="modal" data-target="/user/admin/user-group-add">
          <i class="fas fa-users"></i>
          Create Community
        </a>
        @if (Route::has('login'))
        @auth
        
        <nav class="two">
          <ul>
            <li class="user-profile header-notification">
                <a href="#!">
                    <span class="uimg" style="display:block;">
                        <img src="<?php if(isset($user_img[0])){ echo '/storage/'.$user_img[0]->url; }else{ ?>/assets/img/face1.png<?php } ?>" alt="profile image">
                    </span>

                    <span>
                        <?php echo Auth::user()->display_name ?></span>
                    <i class="fas fa-sort-down"></i>
                </a>
                <ul class="show-notification profile-notification">
                    <li>
                        <!--  include search -->
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="fas fa-search"></i> Quick Search
                        </a>
                    </li>
                    <li>
                        <a href="/user/user-profile">
                            <i class="fas fa-user-cog"></i>
                            Control Panel
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
                <div onclick="loadFilters('{{ $feed['type_ids'] }}','')" data-thumb-id="<?php echo $i ?>"
                    class="slider-image thumb <?php if($i) echo 'active' ?>" 
                    style="background-image: url('{{ Imgfly::imgFly('../public/'.$feed['icon'].'?h=65' ) }}')">
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
        <a class="btn-near-me" onclick="nearByMeFunc()">
          <img src="/assets/img/map_center_icon.svg" alt="">
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
                    <div class="slider-image" onclick="loadFilters( '{{$feed['type_ids']}}' ,'')" data-thumb-id="<?php echo $i ?>" class="thumb <?php if($i) echo 'active' ?>" style="background-image: url('{{ Imgfly::imgFly('../public/'.$feed['icon'].'?h=65' ) }}')">
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

<div class="responsiveheader">
    <div class="rheader">
        <img src="/assets/findgo/images/ricon.png" alt="" style="display:none;" />
        <span class="menubt">
            <i class="fas fa-bars"></i>
        </span>

        <div class="logo_mobile">

        </div>
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


    <?php /*<div class="toolbar">
      <div class="thumbs-container bottom">
        <div class="thumb_wrapper">
          <div class="left_slide">
            <?php $i = 0; ?>
            @foreach($top_slider_feed as $feed)
            @if($feed['side'] == 'left')
            <?php $i++; ?>
            <div class="slick-tile">
              <div onclick="loadFilters('','')" data-thumb-id="<?php echo $i ?>"
                  class="slider-image thumb <?php if($i) echo 'active' ?>"
                  style="background-image: url('{{ Imgfly::imgFly('../public/'.$feed['icon'].'?w=65' ) }}')">
              </div>
              <div class="slider-text">{{$feed['title']}}</div>
            </div>
            @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>
    */ ?>


</div>
<!-- <div class="new-mobile-header">
  <div class="new-mobile-inner">
    <div class="mobile-header-content">
      <button class="menubtn btn-toggle-menubar">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <div class="logo-wrapper">
        <a href=""><img src="/assets/img/logo_2.png" alt=""></a>
      </div>
    </div>
  </div>
</div> -->