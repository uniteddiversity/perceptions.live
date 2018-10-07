<?php
preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $info['url'], $matches);
$video_id = isset($matches[1])?$matches[1]:'';
?>
<div style="padding-top: 20px; padding-bottom: 30px; width: 60%; text-align: center; margin: 0 auto;">
    <div style="display: block; width:100%; text-align: center;">
        <div style="display: block; position: relative; width: 100%;"><h4>{{$info['title']}}</h4></div>
        <div style="display: block; width: 100%; margin-top:-10px;">
            <span style="float: left; font-size: 12px; text-transform: uppercase; font-family: ralewaybold;"><?php if(isset($info->category)){ echo $info->category->name; }; ?></span>
            <span style="z-index: 5;">
                <?php foreach($info->gciTags as $tag){
                    if(isset($tag->tag) && isset($tag->tag->tag))
                        echo '<span style="background-color: '.$tag->tag->tag_color.'" class="dot"></span>';
                }
                ?>
            </span>
            <span style="margin-top: 10px; float: right; font-size: 14px; text-transform: uppercase; font-family: ralewaymedium; color: #6060D5;" ><i class="flaticon-pin"></i> {{$info['location']}}</span>

        </div>
    </div>
    <div><img width=100% height=100% src="https://img.youtube.com/vi/<?php echo $video_id ?>/maxresdefault.jpg"></div>


    <div class="placedetails">

        <?php /* ### div with class "groupdet' is only present if there is a group associated with video ### can we align icon with text? */ ?>

        <div>
            <span class="fa-align-center"><i class="fa fa-users"></i>

                <?php if(isset($info->groups) && count($info->groups) > 0){
                $datas = array();
                foreach($info->groups as $group){
                    $datas[] = '@'.'<span class="inactive_link" onclick="openGroupProfile('.$group->group->id.')">'.$group->group->name.'</span>';
                }

                if(!empty($datas)){
                ?>
                <div>
                    <?php
                    echo implode(', ', $datas);
                    ?>
                            </div>
                <?php }
                }; ?>

            </span>
        </div>

        <span class="pull-left" ><i class="fa fa-tag"></i> {{$info['primary_subject_tag']}}</span>
        <span class="pull-right"><i class="flaticon-avatar"></i> <span class="inactive_link"><?php foreach($info->videoProducer as $key => $users){ if(isset($info->videoProducer[$key])){ echo '<span class="inactive_link" onclick="openProfile(\''. $info->videoProducer[$key]->user->id .'\')">@'.$info->videoProducer[$key]->user->display_name.'</span>'; break; } }?></span></span>
    </div>
    <span style="display: block; width:100%; float: left; padding: 10px;"><p style="font-size: .9em; line-height: 1.3em;">
         {{$info['brief_description']}}</p>
     </span>
    <div style="padding-left: 10px; padding-right: 10px;">
        <ul class="listmetas2">
            <?php
            $datas = [];
            foreach($info->sortingTags as $tag){
                if(isset($tag->content_tag_id) && isset($tag->tag->tag)){
                    $datas[] = '<li><a href="#" title=""><i class="fa fa-tag"></i> '.$tag->tag->tag.'</a></li>';
                }
            }
            if(!empty($datas)){
                echo implode(' ', $datas);
            }
            ?>
        </ul>
        <ul class="usersmetas2">
            <li><a href="#" title=""><i class="fa fa-user-circle"></i> Onscreen</a> :
                <?php if(isset($info->onScreen) && count($info->onScreen) > 0){
                $datas = array();
                foreach($info->onScreen as $user){
                    $datas[] = '@'.'<span class="inactive_link" onclick="openProfile('.$user->user->id.')">'.$user->user->display_name.'</span>';
                }

                if(!empty($datas)){
                ?>
                <div>On screen(s):
                    <?php
                    echo implode(', ', $datas);
                    ?>
                </div>
                <?php }
                }; ?>
            </li>
            <li><a href="#" title=""><i class="fa fa-user"></i> Co-Creators</a> :
                <?php if(isset($info->coCreators)){

                    $datas = array();
                    foreach($info->coCreators as $user){
                        $datas[] = '@'.'<span class="inactive_link" onclick="openProfile('.$user->user->id.')">'.$user->user->display_name.'</span>';
                    }

                    if(!empty($datas)){
                        echo implode(', ', $datas);
                    }
                }
                ?></li>
        </ul>

    </div>
</div>
<div style="clear: both;" ></div>
<?php /* <div class="row" style="display: block;">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" style="display: block;margin: 25px;">
                    <div style="text-align: center;">{{date('d-m-Y', strtotime($info['created_at']))}} {{$info['location']}}</div>
                    <h2 class="card-title">{{$info['title']}}</h2>

                    <p style="padding-left: 0px;">{{$info['brief_description']}}</p>
                </div>

                <div class="row" style="display: block;margin: 25px;">
                    <div class="col-lg-5 column" style="margin:0px;padding: 0px;padding-left: 0px;">
                        <div>Category - <?php if(isset($info->category)){ echo $info->category->name; }; ?></div>
                        <div><?php if(!empty($info->learn_more_url)){ echo '<a target="_blank" href="'.$info->learn_more_url.'">Learn more..</a>'; }; ?></div>
                    </div>
                    <div class="col-lg-7 column">
                        <div>Submitter: <?php if(isset($info->user)){ echo '@'.'<span class="inactive_link" onclick="openProfile('.$info->user->id.')">'.$info->user->display_name.'</span>'; }; ?></div>
                        <?php if(isset($info->videoProducer)){
                            $datas = array();
                            foreach($info->videoProducer as $user){
                                $datas[] = '@'.'<span class="inactive_link" onclick="openProfile('.$user->user->id.')">'.$user->user->display_name.'</span>';
                            }

                            if(!empty($datas)){
                            ?>
                        <div>Producer(s):
                            <?php
                            echo implode(', ', $datas);
                            ?>
                        </div>
                        <?php }
                        }; ?>
                        <?php if(isset($info->coCreators)){

                            $datas = array();
                            foreach($info->coCreators as $user){
                                $datas[] = '@'.'<span class="inactive_link" onclick="openProfile('.$user->user->id.')">'.$user->user->display_name.'</span>';
                            }

                            if(!empty($datas)){
                            ?>

                        <div>Co-creators(s):
                                <?php
                                echo implode(', ', $datas);
                                ?>
                            </div>

                        <?php }
                        }; ?>
                        <?php if(isset($info->onScreen) && count($info->onScreen) > 0){
                            $datas = array();
                            foreach($info->onScreen as $user){
                                $datas[] = '@'.'<span class="inactive_link" onclick="openProfile('.$user->user->id.')">'.$user->user->display_name.'</span>';
                            }

                            if(!empty($datas)){
                            ?>
                        <div>On screen(s):
                            <?php
                            echo implode(', ', $datas);
                            ?>
                        </div>
                        <?php }
                        }; ?>
                        <?php if(isset($info->groups) && count($info->groups) > 0){
                            $datas = array();
                            foreach($info->groups as $group){
                                $datas[] = '@'.'<span class="inactive_link" onclick="openGroupProfile('.$group->group->id.')">'.$group->group->name.'</span>';
                            }

                            if(!empty($datas)){
                            ?>
                            <div>Organization(s):
                                <?php
                                echo implode(', ', $datas);
                                ?>
                            </div>
                        <?php }
                        }; ?>

                    </div>
                </div>
                <div class="row" style="display: block;margin: 25px;">
                    <iframe width="800" height="400" src="<?php echo str_replace( 'watch?v=', 'embed/',$info['url']) ?>" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
*/ ?>

<?php /*
<img width=200 height=100 src="https://img.youtube.com/vi/<?php echo $video_id ?>/mqdefault.jpg">
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
 */ ?>