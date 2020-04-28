<div class="left_side_container">
    <div class="info-box-left">
        <h3 class="main_map_title" >{{$basic_info['group']}}</h3>
        <p class="shared_map_description">{{$basic_info['description']}}</p>
        <div class="ml-placessec">
            <div class="rowx" id="video_search_res">
                ...
            </div>
        </div>
    </div>
</div>
<style>
    {{$basic_info['extra_css']}}
</style>
<style>
    .shared_map_description{
        margin: 5px;
        text-align: center;
    }

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