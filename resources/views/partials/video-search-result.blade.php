<input type="hidden" id="result_count" value="{{$result_count}}" />
<div class="ml-filterbar" style="margin-left: 18px;margin-right: 10px;">
    <a href="#"><i class="fas fa-redo"></i> Reset Search</a>
    <h3><b>{{$result_count}} PRCPTIONs</b><i class="fas fa-list"></i></h3>

</div>
<?php foreach($uploaded_list as $info){

preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $info['url'], $matches);
$video_id = isset($matches[1])?$matches[1]:'';
?>

<div class="col-lg-12">
    <div class="places s2">
        <div style="width: 100%; text-align: center; display:none;">

            <ul class="listmetas">
                <li><a href="#" title=""><i class="fa fa-tag"></i>
                        <?php echo $info['primary_subject_tag'] ?></a></li>
            </ul>

        </div>
        <div class="bottom_info">
            <i class="far fa-calendar-alt"></i>
            <p>
                <?php echo date('d F Y',strtotime($info['captured_date'])) ?>
            </p>
            <ul class="listmetas">
                <li>
                    <p>in</p><a href="#" title="">
                        <?php echo $info['primary_subject_tag'] ?></a>
                </li>
            </ul>
            <span class="dot_cat">
                <?php

                    $tags = explode(',', $info['tag_colors']);
                    foreach($tags as $tag){
                        $tag_name_n_color = explode('-', $tag);
                        $tag_id = isset($tag_name_n_color[1])? $tag_name_n_color[1] : '0';
                        echo '<span data-toggle="tooltip" data-animation="false" data-placement="right" title="'.$tag.'" onclick="searchByTag(\''.$tag_id.'\')" style="background-color: '.$tag_name_n_color[0].'" class="dot-small"></span>';
                        
                    } ?>
            </span>
        </div>
        <div class="placethumb active_link" onclick="openVideo('<?php echo $info['id'] ?>')">
            <img src="https://img.youtube.com/vi/<?php echo $video_id ?>/mqdefault.jpg">
            <?php /*<iframe frameborder="0" showinfo="0" controls="0" autohide="1" style="width: 100%;" src="<?php echo str_replace( 'watch?v=', 'embed/',$info['url']) ?>" frameborder="0" allowfullscreen></iframe> */ ?>
            <div class="watchicon2" onclick="openVideo('<?php echo $info['id'] ?>')"> <a href="#" title=""><img src="/assets/findgo/images/play3.png" alt=""> </a>
            </div>
        </div>
        <div class="boxplaces">
            <div class="placeinfos" style="display: block;">

                <h3><a href="#" title="" onclick="openVideo('<?php echo $info['id'] ?>')">
                        <?php echo $info['title'] ?></a>

                </h3>
            </div>
        </div>
        <div class="placeinfosdesc">

            <div class="inner">
                <div class="placedetails">

                    <span class="pull-right">
                        <p>By</p>
                        <i class="far fa-user"></i>
                        <?php foreach($info->videoProducer as $key => $users){ if(isset($info->videoProducer[$key])){ echo '<span class="inactive_link" onclick="openProfile(\''. $info->videoProducer[$key]->user->id .'\')">@'.$info->videoProducer[$key]->user->display_name.'</span>'; break; } }?>
                    </span>

                </div>
                <?php if(!empty($info['trim_description'])){ ?>
                <p>
                    <?php echo $info['trim_description'] ?>...<a href="#" onclick="openVideo('<?php echo $info['id'] ?>')"> Read more →</a> </p>
                <?php } ?>
                <div class="placedetails">


                    <span class="pull-right" onclick="navigateOnMap('<?php echo $info['lat'] ?>','<?php echo $info['long'] ?>');" style="cursor: pointer;"><i class="fas fa-map-pin"></i>
                        <?php echo $info['location'] ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php } ?>
