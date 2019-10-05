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
        <div class="site_mid_title"><h5>{{$settings['home_centered_title'] or ""}}</h5></div>
        <div class="site_slider_feed" >
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
                <i class="map_center_icon" ></i>
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
<header class="s4 dark">

    <div class="container fluid">

        <div id="logo_overlay">
            <img src="/assets/findgo/images/live-perceptions-logo.png" width="600" height="122" style="display:none;">
        </div>

        <div class="topsearch">
            <div class="rfield">
                <input type="text" placeholder="What are you looking for?" name="search_text" id="search_text" />
                <i class="fas fa-search" style="cursor:pointer" onclick="searchVideo()"></i>
            </div>
        </div>


        <div class="topsearch" id="slider_feed">
            <div class="site_mid_title"><h5>{{$settings['home_centered_title'] or ""}}</h5></div>


            <div class="site_slider_feed" >
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
                    <i class="map_center_icon" ></i>
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
                            <a href="/">
                                <i class="fas fa-home"></i> Home
                            </a>
                        </li>
                        <li>
                            <!--  include search -->
                            <a class="mobile-search morphsearch-search" href="#">
                                <i class="fas fa-search"></i> Search
                            </a>
                        </li>
                        <li><a href="/claim-profile" target="_blank">
                                <i class="fas fa-user-circle"></i>
                                Claim A Profile</a></li>
                        <li>
                            <a href="/user/user-profile">
                                <i class="far fa-user"></i>Profile
                            </a>
                        </li>
                        <li>
                            <a href="/user/logout">
                                <i class="fas fa-sign-out-alt"></i> Logout {{Auth::user()->first_name}}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="extras">
            <a class="submitprcp" href="/user/content-add" title="">
                <i class="fas fa-video"></i>
                Submit PRCPTION</a>
        </div>
        @else
        <nav class="two">
            <ul>

            </ul>
        </nav>

        <div class="extras">
            <span class="accountbtn">
                <i class="flaticon-avatar"></i>
                Sign Up/Log In
            </span>
        </div>

        @endif
        @endif

        <div class="logo">
            <?php /*           <a href="#" title=""><img src="/assets/findgo/images/horizontal-white.png" height="40" width="175" alt="" /></a> */ ?>
        </div>


        <nav>
            <ul>
                @if (Route::has('login'))
                @auth
                <li style="display:none;">
                    <a href="/user/logout">

                        <i class="fas fa-sign-out-alt"></i> Logout {{Auth::user()->first_name}}
                    </a>
                </li>
                @else

                @endauth
                <li style="display:none;"><a href="/claim-profile" target="_blank">
                        <i class="fas fa-user-circle"></i>
                        Claim A Profile</a></li>
                <li><a data-toggle="modal" data-target="#about">
                        <i class="fas fa-info-circle"></i>
                        About</a></li>
                @endif
            </ul>

        </nav>


        <div class="navbar-container container-fluid" style="padding-right:0; display:none;">
            <div>
                <ul class="nav-right">

                    <li style="display:none;">
                        <!--  include search -->
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="fas fa-search"></i>
                        </a>
                        <p>Search</p>
                    </li>
                </ul>
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
