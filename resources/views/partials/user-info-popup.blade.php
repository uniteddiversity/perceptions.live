<?php
$display = ($user_status == 'private' || $user_status == 'only-logged')? false : true;
?>

<div class="modal-inner two">
    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
    <button class="model-back" onclick="modalBack()" aria-hidden="true">&lt;</button>
    <div class="modal-body">
        <div style="display: block; width:100%; text-align: left;">
            <div class="user_info">
                <div style="float:left;">
                    <div class="user_img">
                        <span>
                            <img height="150" width="150" class="avatar profile_img_mini" src="<?php if(isset($info['image'][0])){ echo '/storage/'.$info['image'][0]->url; }else{ ?>/assets/img/face1.png<?php } ?>" alt="profile image">
                        </span>
                    </div>

                    <?php /* ### PRIVACY SETTINGS ICON: if public, then fa-eye; if only logged in, then fa-lock; if private, then fa-eye-slash  */ ?>

                    <div class="right" style="float:left;">
                        <div style="float:left; width:100%;">
                            <h4 style="margin-bottom:5px;">{{$info['display_name']}}
                                <?php
                                if($user_status == 'public'){
                                    echo '<i class="fa fa-eye" style="display:none;"></i>';
                                }elseif($user_status == 'private'){
                                    echo '<i class="fa fa-eye-slash" style="display:none;"></i>';
                                }elseif($user_status == 'logged-in' || $user_status == 'only-logged'){
                                    echo '<i class="fa fa-lock"></i>';
                                }
                                ?>
                            </h4>
                            <?php /* ### If profile is inactive, add this div ?>
                            <div style="width:100%; text-align: center; color: #333333; font-style: italic; font-size: 12px; ">claim this profile</div>
                        </div>

                        <div style="display: block; width: 50%; padding-left: 5%; z-index: 99; float: left;">
                            <div style="padding-bottom: 10px;">
                                <span class="dot" style="background-color: #1c2833;"></span>
                                <span class="dot" style="background-color: red;"></span>
                                <span class="dot" style="background-color: orange;"></span>
                            </div>

                            <?php /* ### HIDE FIRST NAME DIV IF UNAVAILABLE */ ?>


                            <?php if($display){ ?>
                            <div style="float:left; clear:both; margin-bottom:10px;">
                                <span style="font-size: 18px;"> <em>{{$info['first_name']}}</em></span>
                            </div>
                        </div>

                        <?php if(!empty($info['location'])){ ?>
                        <div class="location" style="font-size: 14px; text-transform: uppercase; color: #6060D5;"><i class="flaticon-pin"></i> <em>{{$info['location']}}</em></div>
                        <?php } ?>
                        <?php /*<div style="padding-top: 20px; font-size: .9em; line-height: 1.3em;"><i class="fa fa-clipboard"></i> SKILLSitem1, <i class="fa fa-clipboard"></i> SKILLSitem2, etc</div> */ ?>

                        <?php if(isset($info->actingRoles) && count($info->actingRoles) > 0){ ?>
                        <div class="roles" style="padding-top: 10px; font-size: .9em; line-height: 1.3em; float:left;">
                            <span style="margin:0;">COLLABORATION ROLES: </span>
                            <?php foreach($info->actingRoles as $tag){ ?>
                            <span data-toggle="tooltip" data-animation="true" data-placement="bottom" data-original-title="<?php echo $tag->tag->name ?>"><i class="fa <?php echo $tag->tag->icon ?>"></i></span>
                            <?php } ?>

                        </div>
                        <?php } ?>
                    </div>
                    <div class="btn_top">
                        <?php } //only visible true ?>

                        <?php if($info['status_id'] == '5' ){ ?>
                        <a class="btn white" href="/claim-profile" target="_blank">Claim this Profile</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php if($display){ ?>
    <div class="video_section row">
        <div class="video_inner col-9">
            <div style="display: block; width:100%; float: left; text-align: center; padding-top:15px;padding-bottom:10px;">
                <span style="text-transform: none; font-style: italic;">
                    <?php echo $info['description'] ?>
                </span>
            </div>
            <div>
                <h5><i class="fas fa-video"></i> Media Involvements</h5>
            </div>
            <div id="user-info-popup_video">
                @include('partials.user-info-popup_video-info', ['contentInfo' => $info['user_involvement_videos'], 'paginationData' => $contents1])
            </div>
        </div>


        <div class="col-3">
            <div>
                <h5><i class="fas fa-users"></i> Group Associations</h5>
            </div>
            <div id="user-info-popup_group">
                @include('partials.user-info-popup_group-info', ['groupsInfo' => $info['user_groups'], 'paginationData' => $contents2])
            </div>
        </div>

    </div>
    <?php } ?>
    <div style="clear: both;"></div>
    <input type="hidden" id="popup_user_id" value="<?php echo $user_id ?>" />
</div>

<?php /*
<div class="row" style="display: block;">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" style="display: block;margin: 25px;">
                    <div class="col-md-2" style="margin:0px;padding: 0px;padding-left: 0px;">
                        <div class="profile-image">
                            <img class="avatar profile_img_mini" src="<?php if(isset($info['image'][0])){ echo '/storage/'.$info['image'][0]->url; }else{ ?>/assets/img/face1.png
<?php } ?>" alt="profile image">
</div>
</div>
<div class="col-md-7">
    <div>
        <h3>
            <?php echo '@'.$info['display_name'] ?>
        </h3>
        <p>
            <?php echo $info['description'] ?>
        </p>
    </div>

</div>
<div class="col-md-3">
    <div><strong>User since: </strong>
        <?php echo date('d-m-Y', strtotime($info['created_at'])) ?>
    </div>
    <div><strong>Collaboration Roles: </strong>
        <?php
                            if(isset($info->actingRoles)){
                                $datas = array();
                                foreach($info->actingRoles as $role){
                                    if(isset($role->tag)){
                                        $datas[] = $role->tag->name;
                                    }
                                }
                                echo implode(', ', $datas);
                            } ?>
    </div>
    <div><strong>Primary Intentions: </strong>
        <?php
                            if(isset($info['gci'])){
                                $datas = array();$tag_in = array();
                                foreach($info['gci'] as $tag){
                                    $tag_in[] = $tag['user_tag_id'];
                                }

                                foreach($gci_tags as $tag){
                                    if(in_array($tag['id'], $tag_in)){
                                        echo '<span style="background-color: '.$tag['tag_color'].'" class="dot"></span>';
                                    }
                                }

                            } ?>
    </div>
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
                            $datas = array();
                            foreach($info->groups as $group){
                                if(isset($group->group)){
                                    $datas[] = '<span class="inactive_link" onclick="openGroupProfile('.$group->group->id.')">'.$group->group->name.'</span>';
                                }
                            }
                            echo implode(', ', $datas);
                        } ?>

    </div>
</div>
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

    .inactive_link {
        cursor: pointer;
    }

</style>
*/ ?>
