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