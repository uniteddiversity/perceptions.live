<nav class="pcoded-navbar" >
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">

        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation" >{{__('backend.navigation')}}</div>


        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu <?php if(in_array(Request::segment(3), array('content-add','content-list-open','content-list','location-list','sorting-tag-add'))){ echo 'active pcoded-trigger'; } ?> ">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-video-camera"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">{{__('content')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="<?php if(in_array(Request::segment(3), array('content-add'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/content-add">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{__('backend.add_video', ['name' => __('content')])}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if(in_array(Request::segment(3), array('content-list-open'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/content-list-open">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{__('backend.open_video', ['name' => __('content')])}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if(in_array(Request::segment(3), array('content-list'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/content-list">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{__('backend.all_videos', ['name' => __('content')])}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if(in_array(Request::segment(3), array('location-list'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/location-list">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{__('backend.content_locations')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if(in_array(Request::segment(3), array('sorting-tag-add'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/sorting-tag-add">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{__('backend.content_tags')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu <?php if(in_array(Request::segment(3), array('user-list','user-add'))){ echo 'active pcoded-trigger'; } ?>">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-user"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">{{__('backend.user_manage', ['name' => __('user')] )}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="<?php if(in_array(Request::segment(3), array('user-list'))){ echo 'active'; } ?>" >
                        <a href="/user/admin/user-list">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{__('backend.all_users', ['name' => __('user')])}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if(in_array(Request::segment(3), array('user-add'))){ echo 'active'; } ?>" >
                        <a href="/user/admin/user-add">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{__('backend.add_user', ['name' => __('user')])}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if(in_array(Request::segment(3), array('list-profile-claim-request'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/list-profile-claim-request">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{__('backend.profile_claim_request')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu <?php if(in_array(Request::segment(3), array('group-list','user-to-group-add','user-group-add'))){ echo 'active pcoded-trigger'; } ?>">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-list"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">{{__('backend.groups', ['name' => __('group')] )}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('group-list'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/group-list">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{__('backend.all_groups', ['name' => __('group')] )}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?php if(in_array(Request::segment(3), array('content-list-group'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/group-admin/content-list-group">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{__('backend.my_group_videos', ['name1' => __('group'), 'name2' => __('video')] )}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('user-to-group-add'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/group-admin/user-to-group-add/1">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{__('backend.my_group_users', ['name1' => __('group'), 'name2' => __('user')] )}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('user-to-group-add'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/user-to-group-add">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{__('backend.assign_users_to_group', ['name1' => __('user'), 'name2' => __('group')] )}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('user-group-add'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/user-group-add">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{__('backend.create_group', ['name' => __('group')] )}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu <?php if(in_array(Request::segment(3), array('map-generate-list','map-generate'))){ echo 'active pcoded-trigger'; } ?>">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-share"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">{{__('backend.sharing')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('map-generate-list'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/map-generate-list">
                            {{__('backend.all_maps')}}
                        </a>
                    </li>
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('map-generate'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/map-generate">
                            {{__('backend.generate_map')}}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu <?php if(in_array(Request::segment(3), array('site-settings','list-slider-feed','home-slider-feed'))){ echo 'active pcoded-trigger'; } ?>">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-share"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">{{__('backend.page_settings')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('site-settings'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/site-settings">
                            {{__('backend.site_settings')}}
                        </a>
                    </li>
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('list-slider-feed'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/list-slider-feed">
                            {{__('backend.list_home_slider')}}
                        </a>
                    </li>
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('home-slider-feed'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/home-slider-feed">
                            {{__('backend.add_home_slider')}}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu <?php if(in_array(Request::segment(3), array('global-settings','list-slider-feed','home-slider-feed'))){ echo 'active pcoded-trigger'; } ?>">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-share"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">{{__('backend.global_settings')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('global-settings'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/setting/terms">
                            Terms
                        </a>
                    </li>
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('list-slider-feed'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/setting/appearance">
                            Appearance
                        </a>
                    </li>
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('home-slider-feed'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/setting/platform-config">
                            Platform configuration
                        </a>
                    </li>
                    <li class="nav-item <?php if(in_array(Request::segment(3), array('home-slider-feed'))){ echo 'active'; } ?>">
                        <a class="nav-link" href="/user/admin/setting/organization-contact">
                            Organization and contact
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <?php /*<ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="/user/movie-editor">
                    <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">Movie Editor</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>

        <ul class="pcoded-item pcoded-left-item <?php if(in_array(Request::segment(3), array('package-manager'))){ echo 'active'; } ?>">
            <li class="pcoded-hasmenu">
                <a href="/user/admin/package-manager/">
                    <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">Package Manager</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>*/ ?>

        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="/user/logout">
                    <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">{{__('backend.logout')}}</span>
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
                        <a class="nav-link" href="/user/admin/content-list-open"> Open Videos </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/admin/content-list"> All Videos </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/admin/content-add"> Add Video </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/admin/sorting-tag-add"> Tags </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/admin/location-list"> Location List </a>
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
                        <a class="nav-link" href="/user/admin/user-list"> List Users </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/admin/user-add"> Create User </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/admin/user-group-add"> Create Group </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/admin/user-to-group-add"> Assign User to Group </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/admin/group-list"> List Groups </a>
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
            <a class="nav-link" data-toggle="collapse" href="#share" aria-expanded="false" aria-controls="share">
                <i class="menu-icon mdi mdi-restart"></i>
                <span class="menu-title">Shearing</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="share">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/user/admin/map-generate-list"> Sheared List </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/admin/map-generate"> Map Generate </a>
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
 */ ?>