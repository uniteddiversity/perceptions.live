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


    <div class="placethumb">
        <img src="https://img.youtube.com/vi/<?php echo $video_id ?>/mqdefault.jpg">
        <div class="watchicon2" onclick="openVideo('<?php echo $info['id'] ?>')""> <a href="#" title=""><img src="/assets/findgo/images/play3.png" alt=""> </a>
    </div>
<div class="row" style="display: block;margin: 5px;">
        <div style="font-size: 16px;margin-top: 6px;margin-bottom: 6px;">
        <h3><a href="#" title="" onclick="openVideo('<?php echo $info['id'] ?>')">{{$info['title']}}</a></h3>
        <span style="padding-bottom: 6px; float: right;">
    <?php foreach($info->gciTags as $tag){
                if(isset($tag->tag) && isset($tag->tag->tag))
//                    echo '<br/> tag '.$tag->tag->tag;
                    echo '<span style="background-color: '.$tag->tag->tag_color.'" class="dot-small"></span>';
            }
            ?>
        </span></div>
        <span style="padding-bottom: 6px;"><small><i class="fa fa-calendar"></i> <em><?php echo date('d F Y',strtotime($info['created_at'])) ?></em></small></span>
    </div>
<div class="placeinfosdesc">
    <?php if(!empty($info['trim_description'])){ ?>
    <span style="font-size: .8em;"><?php echo $info['trim_description'] ?> [...]</span>
    <?php } ?>

    <ul class="listmetas">
        <li><i class="fa fa-exchange"></i> EXCHANGE <?php echo $info['exchange'] ?></li>
        <li><a href="#" title=""><i class="fa fa-tag"></i><?php echo $info['primary_subject_tag'] ?></a></li>
    </ul>
</div>