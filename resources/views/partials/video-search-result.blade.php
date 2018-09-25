<input type="hidden" id="result_count" value="{{$result_count}}" />
<div class="ml-filterbar" style="margin-left: 18px;margin-right: 10px;">
    <h3><i class="flaticon-eye"></i>{{$result_count}} Results Found</h3>
    <ul>
        <li class="singleplaces active"><span><i class="fa fa-exchange"></i></span></li>
        <li class="doubleplaces"><span><i class="fa fa-th-large"></i></span></li>
        <li class="listingplaces"><span><i class="fa fa-th-list"></i></span></li>
    </ul>
</div>
<?php foreach($uploaded_list as $info){

preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $info['url'], $matches);
$video_id = isset($matches[1])?$matches[1]:'';
?>

<div class="col-lg-12">
    <div class="places s2">
        <div class="placethumb">
            <img src="https://img.youtube.com/vi/<?php echo $video_id ?>/mqdefault.jpg">
            <?php /*<iframe frameborder="0" showinfo="0" controls="0" autohide="1" style="width: 100%;" src="<?php echo str_replace( 'watch?v=', 'embed/',$info['url']) ?>" frameborder="0" allowfullscreen></iframe> */ ?>
            <div class="placeoptions">
                <span class="pull-left"> <i class="flaticon-eye"></i> Watch </span>
                <span class="pull-right"> <i class="flaticon-note"></i> More Info </span>
            </div>
        </div>
        <div class="boxplaces">
            <div class="placeinfos">
                <span style="padding-bottom: 6px;">
                    <?php
                    $tags = explode(',', $info['tag_colors']);
                    foreach($tags as $tag){
                        $tag_name_n_color = explode('-', $tag);
                        $tag_id = isset($tag_name_n_color[1])? $tag_name_n_color[1] : '0';
                        echo '<span onclick="searchByTag(\''.$tag_id.'\')" style="background-color: '.$tag_name_n_color[0].'" class="dot"></span>';
                    } ?>
                </span>
                <h3><a href="#" title="" onclick="openVideo('<?php echo $info['id'] ?>')"><?php echo $info['title'] ?></a></h3>
                <span style="padding-bottom: 6px;"><small><em><?php echo date('d F Y',strtotime($info['created_at'])) ?></em></small></span>
                <?php if(!empty($info['trim_description'])){ ?>
                    <span style="font-size: .8em;"><?php echo $info['trim_description'] ?> [...]</span>
                <?php } ?>

                <ul class="listmetas">
                    <li><span class="rated">3</span>interactions</li>
                    <li><a href="#" title=""><i class="flaticon-chef"></i> <?php echo $info['primary_subject_tag'] ?></a></li>
                </ul>
            </div>
            <div class="placedetails">
                <span class="pull-left" onclick="navigateOnMap('<?php echo $info['lat'] ?>','<?php echo $info['long'] ?>');" style="cursor: pointer;"><i class="flaticon-pin"></i> <?php echo $info['location'] ?></span>
                <span class="pull-right"><i class="flaticon-avatar"></i> <?php foreach($info->videoProducer as $key => $users){ if(isset($info->videoProducer[$key])){ echo '<span class="inactive_link" onclick="openProfile(\''. $info->videoProducer[$key]->user->id .'\')">@'.$info->videoProducer[$key]->user->display_name.'</span>'; break; } }?></span>
            </div>
        </div>
    </div>
</div>
<?php } ?>
