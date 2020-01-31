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
<div class="row" style="display: block;margin: 5px;">
    <div>

        <h3>{{$info['title']}}</h3>

    </div>
    <p><i class="fas fa-map-marker-alt"></i>
        {{$info['location']}}</p>
    <div style="float:right;">
        <p> <i class="far fa-user"></i>

            <?php foreach($info->videoProducer as $key => $users){ if(isset($info->videoProducer[$key])){ echo '<span class="inactive_link" onclick="openProfile(\''. $info->videoProducer[$key]->user->id .'\')">@'.$info->videoProducer[$key]->user->display_name.'</span>'; break; } }?>
        </p>
    </div>

</div>
<div class="btn_outer"><a class="btn" href="#" onclick="openVideo('<?php echo $info['id'] ?>')">
        Open Video
    </a></div>
