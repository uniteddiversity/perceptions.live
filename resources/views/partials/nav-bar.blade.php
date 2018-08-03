<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="navbar-icon-container">
                <a href="#" class="navbar-icon pull-right visible-xs" id="nav-btn"><i class="fa fa-bars fa-lg white"></i></a>
                <a href="#" class="navbar-icon pull-right visible-xs" id="sidebar-toggle-btn"><i class="fa fa-search fa-lg white"></i></a>
            </div>
            <a data-toggle="collapse" data-target=".navbar-collapse.in" class="navbar-brand" href="#">OSM</a>
        </div>
        <div class="navbar-collapse collapse">
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group has-feedback">
                    <input id="searchbox" type="text" placeholder="Search" class="form-control">
                    <span id="searchicon" class="fa fa-search form-control-feedback"></span>
                </div>
            </form>
            <ul class="nav navbar-nav">
                <!--<li class="hidden-xs"><a href="#" data-toggle="collapse" data-target=".navbar-collapse.in" id="list-btn"><i class="fa fa-list white"></i>&nbsp;</a></li>-->
                <?php if(empty(Auth::user()->email)){ ?>
                <li><a href="#" data-toggle="collapse" data-target=".navbar-collapse.in" id="login-btn"><i class="fa fa-user white"></i>&nbspLogin</a></li>
                <li><a href="#" data-toggle="collapse" data-target=".navbar-collapse.in" id="register-btn"><i class="fa fa-registered white"></i>&nbspRegister</a></li>
                <?php }else{ ?>
                <li><a href="/user/upload-video" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-upload white"></i>&nbspUpload a Video</a></li>
                <li><a href="/user/logout" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-sign-out white"></i>&nbspLogout {{Auth::user()->first_name}}</a></li>
                <?php } ?>
                {{--<li class="dropdown">--}}
                {{--<a id="toolsDrop" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe white"></i>&nbsp;&nbsp;Tools <b class="caret"></b></a>--}}
                {{--<ul class="dropdown-menu">--}}
                {{--<li><a href="#" data-toggle="collapse" data-target=".navbar-collapse.in" id="full-extent-btn"><i class="fa fa-arrows-alt"></i>&nbsp;&nbsp;cde</a></li>--}}
                {{--<li><a href="#" data-toggle="collapse" data-target=".navbar-collapse.in" id="legend-btn"><i class="fa fa-picture-o"></i>&nbsp;&nbsp;abc</a></li>--}}
                {{--<li class="divider hidden-xs"></li>--}}
                {{--<li><a href="#" data-toggle="collapse" data-target=".navbar-collapse.in" id="login-btn"><i class="fa fa-user"></i>&nbsp;&nbsp;efg</a></li>--}}
                {{--</ul>--}}
                {{--</li>--}}

            </ul>
        </div>
    </div>
</div>