<?php
preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $info['url'], $matches);
$video_id = isset($matches[1])?$matches[1]:'';
?>
<a href="#" onclick="openVideo('<?php echo $info['id'] ?>')"><img width=200 height=100 src="https://img.youtube.com/vi/<?php echo $video_id ?>/mqdefault.jpg" border="0"></a>
<div class="row" style="display: block;margin: 5px;">
    <div style="font-size: 16px;margin-top: 6px;margin-bottom: 6px;">{{$info['title']}}
        <span style="padding-bottom: 6px;float: right;">
                <?php foreach($info->gciTags as $tag){
                if(isset($tag->tag) && isset($tag->tag->tag))
                    echo '<span style="background-color: '.$tag->tag->tag_color.'" class="dot-small"></span>';
            }
            ?>
                </span>
    </div>
    <div><i class="flaticon-pin"> {{$info['location']}}</i></div>
    <div><i class="flaticon-avatar"></i> <?php foreach($info->videoProducer as $key => $users){ if(isset($info->videoProducer[$key])){ echo '<span class="inactive_link" onclick="openProfile(\''. $info->videoProducer[$key]->user->id .'\')">@'.$info->videoProducer[$key]->user->display_name.'</span>'; break; } }?></div>

    <div><a href="#" onclick="openVideo('<?php echo $info['id'] ?>')"><i class="flaticon-eye"> Open Video</i></a></div>
</div>
