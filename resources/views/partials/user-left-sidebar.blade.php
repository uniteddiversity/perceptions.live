<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">

        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Navigation</div>

        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="/user/user-profile">
                    <span class="pcoded-micon"> <i class="far fa-user"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">Profile</span>
                    <i class="fas fa-long-arrow-alt-right"></i>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu <?php if(in_array(Request::segment(3), array('content-add','content-list-open','content-list','location-list','sorting-tag-add'))){ echo 'active pcoded-trigger'; } ?> pcoded-trigger">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fas fa-video"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Your Videos</span>
                    <span class="pcoded-mcaret"><i class="fas fa-sort-down"></i></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="<?php if(in_array(Request::segment(3), array('content-add'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/content-add">
                            <span class="pcoded-micon"> <i class="fas fa-long-arrow-alt-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default"><i class="fas fa-plus" style="margin-right:10px;"></i>Add Video</span>
                            <span class="pcoded-mcaret"></span>

                        </a>
                    </li>
                </ul>
            </li>

            <li class="<?php if(in_array(Request::segment(3), array('list-profile-claim-request'))){ echo 'active'; } ?>">
                <a class="nav-link" href="/user/user/list-profile-claim-request">
                    <span class="pcoded-micon"><i class="far fa-user-circle"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.default">My Claim Request's</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <li class="pcoded-hasmenu <?php if(in_array(Request::segment(3), array('group-list','user-to-group-add','user-group-add'))){ echo 'active pcoded-trigger'; } ?>">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-list"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">Groups</span>
                    <span class="pcoded-mcaret"><i class="fas fa-sort-down"></i></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('group-list'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/group-list">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">All Groups</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('user-group-add'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/user-group-add">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Create Group</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="/user/logout">
                    <span class="pcoded-micon"><i class="fas fa-sign-out-alt"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">Log Out</span>
                    <span class="pcoded-mcaret"></span>
                    <i class="fas fa-long-arrow-alt-right"></i>
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
