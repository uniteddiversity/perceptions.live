<?php $user_img = Auth::user()->image; ?>
<nav class="navbar header-navbar pcoded-header">
  <div class="navbar-wrapper">
    <div class="navbar-logo" data-navbar-theme="theme4">
      <div class="sidebar_toggle">
        <a class="mobile-menu" id="mobile-collapse" href="#!">
          <i class="fas fa-bars"></i>
        </a>
      </div>
      <ul class="nav-left mobile_hidden">
        <li>
          <div class="sidebar_toggle">
            <a href="javascript:void(0)">
              <i class="fas fa-bars"></i>
            </a>
          </div>
        </li>
      </ul>
      <a href="/" class="nav-logo">
        <img src="/assets/findgo/images/live-perceptions-logo.png" alt="">
      </a>
      <a class="mobile-options" style="display:none;">
        <i class="fas fa-ellipsis-h"></i>
      </a>

    </div>
    <div class="navbar-container container-fluid" style="padding-right:0;">
      <div>
        <ul class="nav-right">
          <?php /*
                    <li class="header-notification">
                        <a href="#!">
                            <i class="ti-bell"></i>
                            <span class="badge">5</span>
                        </a>
                        <ul class="show-notification">
                            <li>
                                <h6>Notifications</h6>
                                <label class="label label-danger">New</label>
                            </li>
                            <li>
                                <div class="media">
                                    <img class="d-flex align-self-center" src="assets/images/user.png" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h5 class="notification-user">John Doe</h5>
                                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                        <span class="notification-time">30 minutes ago</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media">
                                    <img class="d-flex align-self-center" src="assets/images/user.png" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h5 class="notification-user">Joseph William</h5>
                                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                        <span class="notification-time">30 minutes ago</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media">
                                    <img class="d-flex align-self-center" src="assets/images/user.png" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h5 class="notification-user">Sara Soudein</h5>
                                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                        <span class="notification-time">30 minutes ago</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="header-notification">
                        <a href="#!" class="displayChatbox">
                            <i class="ti-comments"></i>
                            <span class="badge">9</span>
                        </a>
                    </li>
                    */ ?>

          <li class="user-profile header-notification">
            <a href="#!" style="">
              <span class="uimg" style="display:block; ">
                <img src="<?php if (isset($user_img[0])) {
                            echo '/storage/' . $user_img[0]->url;
                          } else { ?>/assets/img/face1.png<?php } ?>" alt="profile image">
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
          <li style="display:none;">
            <!--  include search -->
            <a class="mobile-search morphsearch-search" href="#">
              <i class="fas fa-search"></i>
            </a>
            <p>Search</p>
          </li>
        </ul>


        <!-- search -->
        <div id="morphsearch" class="morphsearch">
          <form class="morphsearch-form">
            <input class="morphsearch-input" type="search" placeholder="Search..." />
            <button class="morphsearch-submit" type="submit">Search</button>
          </form>
          <div class="morphsearch-content">
            <div class="dummy-column">
              <h2>People</h2>
              <a class="dummy-media-object" href="#!">
                <img class="round" src="http://0.gravatar.com/avatar/81b58502541f9445253f30497e53c280?s=50&d=identicon&r=G" alt="Sara Soueidan" />
                <h3>Sara Soueidan</h3>
              </a>
              <a class="dummy-media-object" href="#!">
                <img class="round" src="http://1.gravatar.com/avatar/9bc7250110c667cd35c0826059b81b75?s=50&d=identicon&r=G" alt="Shaun Dona" />
                <h3>Shaun Dona</h3>
              </a>
            </div>
            <div class="dummy-column">
              <h2>Popular</h2>
              <a class="dummy-media-object" href="#!">
                <img src="assets/images/avatar-1.png" alt="PagePreloadingEffect" />
                <h3>Page Preloading Effect</h3>
              </a>
              <a class="dummy-media-object" href="#!">
                <img src="assets/images/avatar-1.png" alt="DraggableDualViewSlideshow" />
                <h3>Draggable Dual-View Slideshow</h3>
              </a>
            </div>
            <div class="dummy-column">
              <h2>Recent</h2>
              <a class="dummy-media-object" href="#!">
                <img src="assets/images/avatar-1.png" alt="TooltipStylesInspiration" />
                <h3>Tooltip Styles Inspiration</h3>
              </a>
              <a class="dummy-media-object" href="#!">
                <img src="assets/images/avatar-1.png" alt="NotificationStyles" />
                <h3>Notification Styles Inspiration</h3>
              </a>
            </div>
          </div>
          <!-- /morphsearch-content -->
          <span class="morphsearch-close"><i class="icofont icofont-search-alt-1"></i></span>
        </div>
        <!-- search end -->
      </div>
    </div>
  </div>
</nav>