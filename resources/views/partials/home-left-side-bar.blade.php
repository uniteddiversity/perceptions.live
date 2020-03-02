<div class="searchbox">
    <div class="rfield" style="display:none;">
        <input type="text" placeholder="What are you looking for?" name="search_text" id="search_text" />
        <i class="fas fa-search" style="cursor:pointer" onclick="searchVideo()"></i>
    </div>
    <!-- test -->
    <div class="logo_mobile">
    </div>
    <div class="cats">
        <div class="greaterdots" id="step4">
            {{--<div style="display: block; float: left;"><span title="What are Greater Community Intentions?" style="background: rebeccapurple; background: -webkit-linear-gradient(left, orange , yellow, green, cyan, blue, violet); background: -o-linear-gradient(right, orange, yellow, green, cyan, blue, violet); background: -moz-linear-gradient(right, orange, yellow, green, cyan, blue, violet); background: linear-gradient(to right, orange , yellow, green, cyan, blue, violet);" class="dot">
                    <a class="tooltip2" style="padding-left: 7px; color: #ffffff; text-shadow: 2px 2px 4px #000;" href="#">? <span class="aboutgci"><em>Greater Community Intentions</em> Use the colored dots to sort through the different styles of community gathering around the world.</span></a>
                </span></div>--}}
            <?php
            foreach($gci_tags as $tag){
                echo '<span data-toggle="tooltip" data-animation="true" data-placement="bottom" title="'.$tag['tag'].'" onclick="searchByTag(\''.$tag['id'].'\')" style="background-color: '.$tag['tag_color'].'" class="dot"></span>';
            } ?>
        </div>
    </div>
    <div class="header-toolbar__left header-slider leftsliders">
        <p class="slider-title">{{$settings['left_feed_name'] or ""}}</p>
        <div class="thumbs-container bottom">
            <div class="thumb_wrapper">
                <div class="left_slide">
                    <?php $i = 0; ?>
                    @foreach($top_slider_feed as $feed)
                        @if($feed['side'] == 'left')
                            <?php $i++; ?>
                            <div class="slick-tile">
                                <div onclick="loadFilters('{{ $feed['type_ids'] }}','')" data-thumb-id="<?php echo $i ?>"
                                     class="slider-image thumb <?php if($i) echo 'active' ?>"
                                     style="cursor:pointer !important; background-image: url('{{ Imgfly::imgFly('../public/'.$feed['icon'].'?h=65' ) }}')">
                                </div>
                                <div class="slider-text">{{$feed['title']}}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
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
                                <div class="slider-image" onclick="loadFilters( '{{$feed['type_ids']}}' ,'')" data-thumb-id="<?php echo $i ?>" class="thumb <?php if($i) echo 'active' ?>" style="background-image: url('{{ Imgfly::imgFly('../public/'.$feed['icon'].'?h=65' ) }}')">
                                </div>
                                <div class="slider-text">{{$feed['title']}}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <div class="randomcategories">
        <a href="#" class="btn">Random</a>
        <div class="searchchat">

            <div id="select-dropdown" class="closed">
                <div id="select-default" class="select default">All Categories <i class="far fa-arrow-alt-circle-down"></i></div>
                @foreach($categories as $cat)
                <div class="select option" data-id="{{$cat->id}}">{{$cat->name}}</div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mlfield s2 searchcat" style="display:none;">
        <select class="selectbox" id="content_search_cat">
            <option class="first" value="">All Categories</option>
            @foreach($categories as $cat)
            <option value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
        </select>

    </div>
    <div class="mlfield searchchat" style="display:none;">
        <div id="select-dropdown" class="closed">
            <div id="select-default" class="select default">All Categories <i class="far fa-arrow-alt-circle-down"></i></div>
            @foreach($categories as $cat)
            <div class="select option" data-id="{{$cat->id}}">{{$cat->name}}</div>
            @endforeach
        </div>
    </div>


</div>



{{--<div class="ml-filterbar">--}}
{{--<ul>--}}
{{--<li><a id="finddo-geolocate" class="theme-btn2" href="#"><em class="fa fa-crosshairs"></em> Geolocate</a></li>--}}
{{--<li><a id="finddo-target" class="theme-btn2" href="#"><i class="fa fa-bullseye"></i> Target </a></i></span></li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--<div class="col-lg-12">--}}
{{--<div class="mlradius">--}}
{{--<span>Radius :</span>--}}
{{--<div class="mlfield s2">--}}
{{--<select class="selectbox">--}}
{{--<option>Kilometer</option>--}}
{{--<option>Miles</option>--}}
{{--</select>--}}
{{--</div>--}}
{{--<div class="rslider">--}}
{{--<amino-slider class="slider" data-min="0" data-max="100" data-value="10"></amino-slider>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="ml-filterbar">--}}
{{--<h3>4 Results Found</h3>--}}
{{--<ul>--}}
{{--<li class="singleplaces active"><span><i class="fa fa-exchange"></i></span></li>--}}
{{--<li class="doubleplaces"><span><i class="fa fa-th-large"></i></span></li>--}}
{{--<li class="listingplaces"><span><i class="fa fa-th-list"></i></span></li>--}}
{{--</ul>--}}
{{--</div>--}}
<div class="ml-placessec">
    <div class="row" id="video_search_res">
        ...
    </div>
</div>

<script>
    $(document).ready(function() {

	$('#select-default').bind("click", toggle);

	function toggle() {
		if ($('#select-dropdown').hasClass('open')) {
			collapse();
		} else {
			expand();
		}
	}
	function expand() {
		$('#select-dropdown').removeClass('closed').addClass('open');

		options = $('.searchchat .select');

		options.each(function(index) {
			var layer = options.length - index;
			$(this).css("top", 50 * index + "px");
			$(this).css("width", 200);
			$(this).css("margin-left", 0);
		});
	}
	function collapse() {
		$('#select-dropdown').removeClass('open').addClass('closed');

		options = $('.searchchat .select');

		options.each(function(index) {
			var layer = options.length - index;
			$(this).css("z-index", layer);
			$(this).css("top", 0 * index + "px");
			$(this).css("width", 200 - 2 * index);
			$(this).css("margin-left", 0 + index);
		});
	}

	$('.option').bind("click", select);

	function select() {
		if ($('#select-dropdown').hasClass('open')) {
			var selection = $(this).text();
			$('#select-default').text(selection);
			var data = $(this).data("id");

			window.dropdown = data;
			console.log(window.dropdown);

			collapse();
		} else {
			expand();
		}
	}

	collapse();
});
</script>


<style>

    .dot-small {
        height: 10px;
        width: 10px;
        border-radius: 50%;
        display: inline-block;
        margin: 2px;
        cursor: pointer;
    }
</style>
<?php /*

<div class="col-md-3 no-float col-md-3half" style="padding-right: 0px;">
    <div class="info-box-left" style="margin:10px 10px 10px 10px;overflow: scroll;">
        <h2>Feed {{env('APP_NAME', '')}}</h2>

        <div class="form-group">
            <div class="col-md-5">SORT FEED</div>
            <div class="col-md-7">
                <?php
                foreach($gci_tags as $tag){
                    echo '<span onclick="searchByTag(\''.$tag['id'].'\')" style="background-color: '.$tag['tag_color'].'" class="dot"></span>';
                } ?>
</div>
</div>
<div class="form-group">
    <div class="col-md-4" style="margin:0px;padding: 0px;">
        <input type="text" class="form-control" aria-describedby="nameHelp" name="search_text" id="search_text" placeholder="Search">
    </div>
    <div class="col-md-4" style="padding-right: 0px;">
        <select class="form-control" id="content_search_cat">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
            <option value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4" style="padding-right: 0px;padding-left: 10px;">
        <buttonc class="btn btn-primary" onclick="searchVideo()">Search</buttonc>
        <buttonc class="btn btn-primary" onclick="resetSearch()">Reset</buttonc>
    </div>
</div>
<div class="form-group">
    RECENT
</div>

<div class="form-group" style="height: 100%; " id="video_search_res">
</div>
</div>
</div>
<style>
    .dot {
        height: 10px;
        width: 10px;
        border-radius: 50%;
        display: inline-block;
        margin: 2px;
        cursor: pointer;
    }

    .inactive_link {
        cursor: pointer;
    }

</style>

*/ ?>
