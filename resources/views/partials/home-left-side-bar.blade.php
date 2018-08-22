<div class="col-md-3 no-float col-md-3half" style="padding-right: 0px;">
    <div class="info-box-left" style="margin:10px 10px 10px 10px;overflow: scroll;">
        <h2>Feed {{env('APP_NAME', '')}}</h2>

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
        {{--<div class="form-group">--}}
            {{--<div class="col-md-7" style="margin:0px;padding: 0px;">--}}
                {{--video here--}}
            {{--</div>--}}
            {{--<div class="col-md-5 video_text">--}}
                {{--video goes here--}}
            {{--</div>--}}
        {{--</div>--}}
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