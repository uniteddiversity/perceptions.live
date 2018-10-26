<div class="responsiveheader">
    <div class="rheader">
        <span><img src="/assets/findgo/images/ricon.png" alt="" /></span>
    <?php /* <div class="logo">
            <a href="#" title=""><img src="/assets/findgo/images/live-prcptions-beta-small.png" width=100 height=388 alt="" /></a>
        </div> */ ?>
        <div class="extras">
            <span class="accountbtn"><i class="flaticon-avatar"></i></span>
        </div>
    </div>
    <div class="rnaver">
        <span class="closeresmenu"><i>x</i>Close</span>
    <div class="logo"><a href="#" title=""><img src="/assets/findgo/images/live-prcptions-beta-small.png" width=100 height=388 alt="" /></a></div>
        @if (Route::has('login'))

            @auth
                <div class="extras">
                    <a href="/user/content-add" title=""><img src="/assets/findgo/images/icon1.png" alt="" /> Submit Video</a>
                </div>
            @else
                <div class="extras">
                    <span class="accountbtn"><i class="flaticon-avatar"></i></span>
                </div>
            @endif
        @endif
        <ul>
            @if (Route::has('login'))
                @auth
                    <li><a href="/user/logout" ><i class="fa fa-sign-out white"></i>&nbspLogout {{Auth::user()->first_name}}</a></li>
                @else

                @endauth
                <li><a href="/claim-profile" target="_blank" ><i class="fa fa-registered white"></i> Claim A Profile</a></li>
                    <li><a href="https://perceptiontravel.tv/about-perceptions-live" target="_blank" ><i class="fa fa-info"></i>&nbsp;About</a></li>
            @endif
        </ul>
    </div>

</div>
<header class="s4 dark">

    <div class="container fluid">git
        <div id="logo_overlay"><img src="/assets/findgo/images/live-perceptions-logo.png" width="600" height="122"></div>

        @if (Route::has('login'))

            @auth
                <div class="extras">
                    <a href="/user/user-profile" title=""><img src="/assets/findgo/images/icon1.png" alt="" /> Submit PRCPTION</a>
                </div>
            @else
                <div class="extras">
                    <span class="accountbtn"><i class="flaticon-avatar"></i></span>
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
                    <li><a href="/user/logout" ><i class="fa fa-sign-out white"></i>&nbspLogout {{Auth::user()->first_name}}</a></li>
                @else

                @endauth
                <li><a href="/claim-profile" target="_blank" ><i class="fa fa-user"></i>&nbsp;Claim A Profile</a></li>
                    <li><a href="https://perceptiontravel.tv/about-perceptions-live" target="_blank" ><i class="fa fa-info"></i>&nbsp;About</a></li>
            @endif
            </ul>
            {{--<ul>--}}
                {{--<li class="menu-item-has-children">--}}
                    {{--<a href="#" title="">Home</a>--}}
                    {{--<ul>--}}
                        {{--<li><a href="index.html" title="">Home 1</a></li>--}}
                        {{--<li><a href="index2.html" title="">Home 2</a></li>--}}
                        {{--<li><a href="index3.html" title="">Home 3</a></li>--}}
                        {{--<li><a href="index4.html" title="">Home 4</a></li>--}}
                        {{--<li><a href="index5.html" title="">Home 5</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="menu-item-has-children">--}}
                    {{--<a href="#" title="">Listings</a>--}}
                    {{--<ul>--}}
                        {{--<li><a href="add-listing.html" title="">Add Listing</a></li>--}}
                        {{--<li><a href="listing-category.html" title="">Listing Category</a></li>--}}
                        {{--<li><a href="listing-category2.html" title="">Listing Category 2</a></li>--}}
                        {{--<li><a href="listing-full.html" title="">Listing Full</a></li>--}}
                        {{--<li><a href="listing-map.html" title="">Listing Map</a></li>--}}
                        {{--<li><a href="listing-map2.html" title="">Listing Map 2</a></li>--}}
                        {{--<li><a href="listing-sidebar.html" title="">Listing Sidebar</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="menu-item-has-children">--}}
                    {{--<a href="#" title="">Listing Details</a>--}}
                    {{--<ul>--}}
                        {{--<li><a href="listing-single1.html" title="">Listing Details 1</a></li>--}}
                        {{--<li><a href="listing-single2.html" title="">Listing Details 2</a></li>--}}
                        {{--<li><a href="listing-single3.html" title="">Listing Details 3</a></li>--}}
                        {{--<li><a href="listing-single4.html" title="">Listing Details 4</a></li>--}}
                        {{--<li><a href="listing-single5.html" title="">Listing Details 5</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="menu-item-has-children">--}}
                    {{--<a href="#" title="">User</a>--}}
                    {{--<ul>--}}
                        {{--<li><a href="user-dashboard.html" title="">User Dashboard</a></li>--}}
                        {{--<li><a href="user-favourite.html" title="">User Favourites</a></li>--}}
                        {{--<li><a href="user-my-listings.html" title="">User Listing</a></li>--}}
                        {{--<li><a href="user-notification.html" title="">User Notifications</a></li>--}}
                        {{--<li><a href="user-profile.html" title="">User Profile</a></li>--}}
                        {{--<li><a href="user-review.html" title="">User Review</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="menu-item-has-children">--}}
                    {{--<a href="#" title="">Pages</a>--}}
                    {{--<ul>--}}
                        {{--<li class="menu-item-has-children">--}}
                            {{--<a href="#" title="">BLog</a>--}}
                            {{--<ul>--}}
                                {{--<li><a href="blog1.html" title="">Blog 1</a></li>--}}
                                {{--<li><a href="blog2.html" title="">Blog 2</a></li>--}}
                                {{--<li><a href="blog-single.html" title="">Blog Details</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li><a href="pricing.html" title="">Pricing</a></li>--}}
                        {{--<li><a href="404.html" title="">404 Error</a></li>--}}
                        {{--<li><a href="contact.html" title="">Contact Us</a></li>--}}
                        {{--<li><a href="services.html" title="">Our Services</a></li>--}}
                        {{--<li><a href="terms.html" title="">Our Terms</a></li>--}}
                        {{--<li><a href="testimonials.html" title="">Testimonials</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="menu-item-has-children">--}}
                    {{--<a href="#" title="">Shop</a>--}}
                    {{--<ul>--}}
                        {{--<li><a href="shop-list.html" title="">Shop Lists</a></li>--}}
                        {{--<li><a href="shop-detail.html" title="">Shop Details</a></li>--}}
                        {{--<li><a href="cart.html" title="">Shop Cart</a></li>--}}
                        {{--<li><a href="checkout.html" title="">Checkout</a></li>--}}
                        {{--<li><a href="shop-order.html" title="">Shop Order</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--</ul>--}}
        </nav>
    </div>
</header>


<style>
    #logo_overlay {
        position: absolute;
        display: block;
        width: 40%;
        margin-left: 6%;
        background-color: #transparent;
        z-index:50;
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
                            <li><a href="/claim-profile" target="_blank" ><i class="fa fa-registered white"></i>&nbspClaim Your Profile</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
 */ ?>