<div style="padding-left: 30px; padding-top: 12px; padding-bottom: 30px;">
    <div class="rfield">
        <input type="text" placeholder="Looking for something?" name="search_text" id="search_text" />
        <i class="flaticon-magnifying-glass" style="cursor:pointer" onclick="searchVideo()" ></i>
    </div>

    <div class="mlfield s2">
        <select class="selectbox" id="content_search_cat">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{$cat->id}}" >{{$cat->name}}</option>
            @endforeach
        </select>
    </div>
	<div style="width=100%; padding-left: 20px; float: left;">
    <?php
    foreach($gci_tags as $tag){
        echo '<span data-toggle="tooltip" data-placement="bottom" title="'.$tag['tag'].'" onclick="searchByTag(\''.$tag['id'].'\')" style="background-color: '.$tag['tag_color'].'" class="dot"></span></div>';
    } ?>
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
    {{--<h3><i class="flaticon-eye"></i>14 Results Found</h3>--}}
    {{--<ul>--}}
        {{--<li class="singleplaces active"><span><i class="fa fa-exchange"></i></span></li>--}}
        {{--<li class="doubleplaces"><span><i class="fa fa-th-large"></i></span></li>--}}
        {{--<li class="listingplaces"><span><i class="fa fa-th-list"></i></span></li>--}}
    {{--</ul>--}}
{{--</div>--}}
<div class="ml-placessec">
    <div class="row" id="video_search_res" >
        ...
    </div>
</div>


<style>
    .dot {
        height: 22px;
        width: 22px;
        border-radius: 50%;
        display: inline-block;
        margin: 2px;
        cursor: pointer;
    }

    .dot-small {
        height: 10px;
        width: 10px;
        border-radius: 50%;
        display: inline-block;
        margin: 2px;
        cursor: pointer;
    }

    .inactive_link{
        cursor: pointer;
    }

    .SumoSelect{
        width: 96%;
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
                        <option value="{{$cat->id}}" >{{$cat->name}}</option>
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

    .inactive_link{
        cursor: pointer;
    }
</style>

 */ ?>