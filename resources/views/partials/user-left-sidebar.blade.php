<nav class="pcoded-navbar" >
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">

        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation" >Navigation</div>


        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu <?php if(in_array(Request::segment(3), array('content-add','content-list-open','content-list','location-list','sorting-tag-add'))){ echo 'active pcoded-trigger'; } ?> pcoded-trigger">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-video-camera"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Video</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="<?php if(in_array(Request::segment(3), array('content-add'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/content-add">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Add Video</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="/user/logout">
                    <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">Log Out</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<?php /* <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <?php $user_img = Auth::user()->image; ?>
                        <img width="50" src="<?php if(isset($user_img[0])){ echo '/storage/'.$user_img[0]->url; }else{ ?>/assets/img/face1.png<?php } ?>" alt="profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{Auth::user()->email}}</p>
                        <div>
                            <small class="designation text-muted">{{Auth::user()->role->name}}</small>
                            <span class="status-indicator online"></span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        {{--<li class="nav-item">--}}
        {{--<a class="nav-link" href="index.html">--}}
        {{--<i class="menu-icon mdi mdi-television"></i>--}}
        {{--<span class="menu-title">Dashboard</span>--}}
        {{--</a>--}}
        {{--</li>--}}
        <li class="nav-item">
            <a href="/" class="nav-link" aria-expanded="false" aria-controls="">
                <i class="menu-icon mdi mdi-face-profile"></i>
                <span class="menu-title">Home/Map</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#contnet-sub" aria-expanded="false" aria-controls="contnet-sub">
                <i class="menu-icon mdi mdi-table"></i>
                <span class="menu-title">Video</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="contnet-sub">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/user/user/content-list"> List Videos </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/content-add"> Add Video </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a href="/user/user-profile" class="nav-link" aria-expanded="false" aria-controls="">
                <i class="menu-icon mdi mdi-face-profile"></i>
                <span class="menu-title">Profile Setting</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="/user/logout" class="nav-link" aria-expanded="false" aria-controls="">
                <i class="menu-icon mdi mdi-logout"></i>
                <span class="menu-title">Log Out</span>
            </a>
        </li>
    </ul>
</nav>
 */ ?>