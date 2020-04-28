<?php
preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $info['url'], $matches);
$video_id = isset($matches[1])?$matches[1]:'';
?>
<span class="dot_outer">
    <?php foreach($info->gciTags as $tag){
                if(isset($tag->tag) && isset($tag->tag->tag))
                    echo '<span style="background-color: '.$tag->tag->tag_color.'" class="dot"></span>';
            }
            ?>
</span>
<a class="openvideo" href="#" >
<!--    <img width=200 height=100 src="https://img.youtube.com/vi/--><?php //echo $video_id ?><!--/mqdefault.jpg" border="0">-->
    <iframe width="200" height="170"
            src="https://www.youtube.com/embed/<?php echo $video_id ?>">
    </iframe>
</a>
<div class="row" style="display: block;margin: 5px;">in
    <div>
<?php //dd($info->id) ?>
        <a target="_blank" href="{{route('video.page.show', ['_category_name' => isset($info->category)?str_replace(' ', '-', $info->category->name):'category', '_date' => date('Y-m-d', strtotime($info['captured_date'])), '_video_title' => str_replace(' ', '-', $info['title']), '_video_uid' => uid($info->id)])}}"><h3>{{$info['title']}}</h3></a>

    </div>
    <p><i class="fas fa-map-marker-alt"></i>
        {{$info['location']}}</p>
    <div style="float:right;">
        <p> <i class="far fa-user"></i>

            <?php foreach($info->videoProducer as $key => $users){ if(isset($info->videoProducer[$key])){ echo '<a class="inactive_link" target="_blank" href="'.route('group.page.show', ['_user_name' => str_replace(' ', '-', $info->videoProducer[$key]->user->first_name.' '.$info->videoProducer[$key]->user->last_name), '_user_id' => uid($info->videoProducer[$key]->user->id)]).'" >@'.$info->videoProducer[$key]->user->display_name.'</a>'; break; } }?>
        </p>
    </div>


</div>
<div class="btn_outer"><a class="btn" target="_blank" href="{{route('video.page.show', ['_category_name' => isset($info->category)?str_replace(' ', '-', $info->category->name):'category', '_date' => date('Y-m-d', strtotime($info['captured_date'])), '_video_title' => str_replace(' ', '-', $info['title']), '_video_uid' => uid($info->id)])}}" onclick="openVideo('<?php echo $info['id'] ?>')">
        Open Video
    </a></div>
