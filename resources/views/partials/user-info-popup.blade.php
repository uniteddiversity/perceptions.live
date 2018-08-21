<div class="row" style="display: block;"><?php //dd($info) ?>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" style="display: block;margin: 25px;">
                    <div class="col-md-2" style="margin:0px;padding: 0px;padding-left: 0px;">
                        <div class="profile-image">
                            <img src="<?php if(isset($info['image'][0])){ echo '/storage/'.$info['image'][0]->url; }else{ ?>/assets/img/face1.png<?php } ?>" alt="profile image">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div>
                         <h3><?php echo '@'.$info['display_name'] ?></h3>
                         <h3><?php echo $info['description'] ?></h3>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div><strong>Date Joined: </strong><?php date('d-m-Y', strtotime($info['created_at'])) ?></div>
                        <div><strong>Collaboration Roles: </strong><?php
                            if(isset($info->actingRoles)){
                                foreach($info->actingRoles as $role){
                                    if(isset($role->tag)){
                                        echo $role->tag->name.',<br/>';
                                    }
                                }
                            } ?></div>
                    </div>
                </div>
                <div class="row" style="display: block;margin: 25px;">
                    <div class="col-md-8">
                        <h3>Submitted/associated video profiles</h3>
                        <div>
                            <?php foreach($user_associate_videos as $video){ ?>
                                <iframe width="300" height="150" src="<?php echo str_replace( 'watch?v=', 'embed/',$video['url']) ?>" frameborder="0" allowfullscreen></iframe>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4>Associated Users/Groups</h4>
                        <?php
                        if(isset($info->groups)){
                            foreach($info->groups as $group){
                                if(isset($group->group)){
                                    echo $group->group->name.',<br/>';
                                }
                            }
                        } ?>

                    </div>
                </div>
                {{--<p>onscreen: {{$info['onscreen']}}</p>--}}
                {{--<p>Co Creators: {{$info['co_creators']}}</p>--}}
            </div>
        </div>
    </div>
</div>