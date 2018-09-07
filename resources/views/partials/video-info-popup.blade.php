<div class="row" style="display: block;">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" style="display: block;margin: 25px;">
                    <div style="text-align: center;">{{date('d-m-Y', strtotime($info['created_at']))}} {{$info['location']}}</div>
                    <h2 class="card-title">{{$info['title']}}</h2>

                    <p style="padding-left: 0px;">{{$info['brief_description']}}</p>
                </div>

                <div class="row" style="display: block;margin: 25px;">
                    <div class="col-md-5" style="margin:0px;padding: 0px;padding-left: 0px;">
                        <div>Category - <?php if(isset($info->category)){ echo $info->category->name; }; ?></div>
                        <div><?php if(!empty($info->learn_more_url)){ echo '<a target="_blank" href="'.$info->learn_more_url.'">Learn more..</a>'; }; ?></div>
                    </div>
                    <div class="col-md-7">
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
                {{--<p>onscreen: {{$info['onscreen']}}</p>--}}
                {{--<p>Co Creators: {{$info['co_creators']}}</p>--}}
            </div>
        </div>
    </div>
</div>