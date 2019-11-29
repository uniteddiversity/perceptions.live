<header class="new-header">
  <div class="header-content">
    <div class="top-bar">
      <div class="top-bar__left">
        <a href="/" class="navbar-logo" onclick="resetSearch()">
          <img src="/assets/findgo/images/live-perceptions-logo.png" alt="">
        </a>
        <div class="search-box">
          <div class="search-box-content">
            <input type="text" placeholder="Quick Search" name="search_text" id="search_text" />
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
        <button class="btn-sign-up">Sign Up / Log In</button>
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
                <div onclick="loadFilters({{$feed['fk_id']}},'{{$feed['type']}}')" data-thumb-id="<?php echo $i ?>" 
                    class="slider-image thumb <?php if($i) echo 'active' ?>" 
                    style="background-image: url('{{ Imgfly::imgFly('../public/'.$feed['icon'].'?w=35' ) }}')">
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
        <a class="btn-near-me">
          <img src="/assets/img/map_center_icon.svg" alt="">
          <span>Near by Me</span>
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
                    <div class="slider-image" onclick="loadFilters({{$feed['fk_id']}},'{{$feed['type']}}')" data-thumb-id="<?php echo $i ?>" class="thumb <?php if($i) echo 'active' ?>" style="background-image: url('{{ Imgfly::imgFly('../public/'.$feed['icon'].'?w=35' ) }}')">
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
<div class="new-mobile-header">
  <div class="mobile-header-content">
    <button class="btn-toggle-menubar">

    </button>
  </div>
</div>