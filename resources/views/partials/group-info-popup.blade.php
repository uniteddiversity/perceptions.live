<div class="row" style="display: block;">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" style="display: block;margin: 25px;">
                    <div class="col-md-2" style="margin:0px;padding: 0px;padding-left: 0px;">
                        <div class="profile-image">
                            <img class="avatar profile_img_mini" src="<?php if(isset($info['group_avatar'][0]) && !empty($info['group_avatar'][0]['url'])){ echo '/storage/'.$info['group_avatar'][0]['url']; }else{ ?>/assets/img/face1.png<?php } ?>" alt="profile image">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div>
                         <h3><?php echo $info['name'] ?></h3>
                         <p><?php echo $info['description'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="row" style="display: block;margin: 25px;">
                    <div class="col-md-4">
                        <?php
                        if(isset($info['users'])){
                            $datas = array();
                            foreach($info['users'] as $user){
                                if(isset($user['display_name'])){
                                    $datas[] = '@'.'<span class="inactive_link" onclick="openProfile('.$user['id'].')">'.$user['display_name'].'</span>';
                                }
                            }
                            if(!empty($datas))
                                echo '<h4>Group Users</h4>';

                            echo implode(', ', $datas);
                        } ?>

                    </div>
                </div>

                <div class="row" style="display: block;margin: 25px;">
                    <div class="col-md-8">
                        <h3>Submitted/associated video profiles</h3>
                        <div>
                            <?php foreach($info['videos'] as $video){ ?>
                                <h4 style="margin-top: 0px;font-weight: bold;cursor: pointer;" onclick="openVideo('<?php echo $video['id'] ?>')"><?php echo $video['title'] ?></h4>
                                <iframe width="300" height="150" src="<?php echo str_replace( 'watch?v=', 'embed/',$video['url']) ?>" frameborder="0" allowfullscreen></iframe>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                {{--<p>onscreen: {{$info['onscreen']}}</p>--}}
                {{--<p>Co Creators: {{$info['co_creators']}}</p>--}}
            </div>
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