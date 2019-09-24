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
                    <li class="<?php if(in_array(Request::segment(3), array('content-list'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/group-admin/content-list">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">All Videos</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if(in_array(Request::segment(3), array('location-list'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/group-admin/location-list">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Locations</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if(in_array(Request::segment(3), array('sorting-tag-add'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/group-admin/sorting-tag-add">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Tags</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu <?php if(in_array(Request::segment(3), array('user-list','user-add'))){ echo 'active pcoded-trigger'; } ?> pcoded-trigger">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-user"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">User Manage</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="<?php if(in_array(Request::segment(3), array('user-list'))){ echo 'active'; } ?>" >
                        <a href="/user/group-admin/user-list">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">All Users</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if(in_array(Request::segment(3), array('user-add'))){ echo 'active'; } ?>" >
                        <a href="/user/group-admin/user-add">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Add User</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu <?php if(in_array(Request::segment(3), array('group-list','user-to-group-add','user-group-add'))){ echo 'active pcoded-trigger'; } ?>">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-list"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">Groups</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('group-list'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/group-admin/group-list">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">All Groups</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('user-to-group-add'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/group-admin/user-to-group-add">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Assign User to Group</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('user-group-add'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/group-admin/user-group-add">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Create Group</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if(in_array(Request::segment(3), array('content-list'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/group-admin/content-list-group">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Group Videos</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu <?php if(in_array(Request::segment(3), array('map-generate-list','map-generate'))){ echo 'active pcoded-trigger'; } ?>">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-share"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">Sharing</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('map-generate-list'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/group-admin/map-generate-list">
                            All Maps
                        </a>
                    </li>
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('map-generate'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/group-admin/map-generate">
                            Generate Map
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


<?php /*
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <?php $user_img = Auth::user()->image; ?>
                        <img src="<?php if(isset($user_img[0])){ echo '/storage/'.$user_img[0]->url; }else{ ?>/assets/img/face1.png<?php } ?>" alt="profile image">
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
                        <a class="nav-link" href="/user/group-admin/content-list"> List Videos </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/content-add"> Add Video </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/group-admin/sorting-tag-add"> Tags </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/group-admin/location-list"> Location List </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-restart"></i>
                <span class="menu-title">User Manage</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/user/group-admin/user-list"> List Users </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/group-admin/user-add"> Create User </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/group-admin/user-group-add"> Create Group </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/group-admin/user-to-group-add"> Assign User to Group </a>
                    </li>
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="/user/group-admin/group-list"> List Groups </a>--}}
                    {{--</li>--}}
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
            <a class="nav-link" data-toggle="collapse" href="#share" aria-expanded="false" aria-controls="share">
                <i class="menu-icon mdi mdi-restart"></i>
                <span class="menu-title">Shearing</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="share">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/user/group-admin/map-generate-list"> Sheared List </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/group-admin/map-generate"> Map Generate </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a href="/user/logout" class="nav-link" aria-expanded="false" aria-controls="">
                <i class="menu-icon mdi mdi-logout"></i>
                <span class="menu-title">Log Out</span>
            </a>
        </li>
    </ul>
</nav>
 */?>