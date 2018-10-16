<?php //dd($group_users) ?>
<div style="padding-top: 20px; padding-bottom: 30px; width: 60%; text-align: center; margin: 0 auto;">
    <div style="display: block; width:100%; text-align: left;">

        <div style="width: 30%; padding-right: 20px; border-right: 1px solid #e8ecec; display: block; text-align: center; float: left; margin-left: 5%;">
            <div style="display: block; width:100%; text-align: center;">
                <img  width="150" src="<?php if(isset($info['group_avatar'][0]) && !empty($info['group_avatar'][0]['url'])){ echo '/storage/'.$info['group_avatar'][0]['url']; }else{ ?>/assets/img/face1.png<?php } ?>" alt="profile image">
            </div>

            <?php /* ### PRIVACY SETTINGS ICON: if public, then fa-eye; if only logged in, then fa-lock; if private, then fa-eye-slash  */ ?>

            <div style="width:100%; text-align: center;"><h4><?php echo $info['name'] ?>
                    {{--<i class="fa fa-eye"></i>--}}
                </h4>
            </div>

            <div style="width:100%; text-align: center; margin-top:-10px; color: #CCCCCC; font-style: italic; font-size: 12px; "><?php echo ($info['status'] == '1' )? '<span style="color:green">Active</span>': 'Inactive'; ?></div>

            <?php /* ### If Inactive, add link: CLAIM THIS PROFILE */ ?>
            <?php if($info['status'] == '5' ){ ?>
            <div style="width:100%; text-align: center; color: #333333; font-style: italic; font-size: 12px; "><a href="/claim-profile" target="_blank">claim this group</a></div>
            <?php } ?>

<?php //dd($info['acting_roles']) ?>
            <?php if(isset($info['acting_roles']) && count($info['acting_roles']) > 0){ ?>
            <div style="padding-top: 10px; font-size: .9em; line-height: 1.3em;">
                <span>COLLABORATION ROLES: </span>
                <?php foreach($info['acting_roles'] as $tag){ //dd($tag['tag']['icon']); ?>
                <span data-toggle="tooltip" data-original-title="<?php echo $tag['tag']['name'] ?>" title="<?php echo $tag['tag']['name'] ?>" ><i class="fa <?php echo $tag['tag']['icon'] ?>"></i></span>
                <?php } ?>

            </div>
            <?php } ?>

        </div>

            <div style="display: block; width: 50%; padding-left: 5%; z-index: 99; float: left;">
                <div style="padding-bottom: 10px;">
                     <span class="dot" style="background-color: #1c2833;"></span>
                     <span class="dot" style="background-color: red;"></span>
                     <span class="dot" style="background-color: orange;"></span>
                </div>

                <div style="padding-bottom: 10px;">
                    <div style="font-size: 14px; text-transform: uppercase; line-height: .8em; font-family: ralewaybold;"> Category</div>
                    <div style="text-transform: none; padding-top: 10px; font-style: italic;"><?php echo $info['current_mission'] ?></div>
                </div>

                <div style="font-size: 12px; text-transform: uppercase; font-family: ralewaymedium; color: #6060D5;"><i class="flaticon-pin"></i> <em><?php echo $info['default_location'] ?></em></div>

                <?php /*
                <div style="padding-top: 20px; font-size: .9em; line-height: 1.3em;"><i class="fa fa-clipboard"></i> SKILLS 1, <i class="fa fa-clipboard"></i> SKILL 2, etc</div>

                <div style="padding-top: 10px; font-size: .9em; line-height: 1.3em;">
                    <span>COLLABORATION ROLES: </span>
                    <span><i class="fa fa-file-audio-o"></i> </span>
                    <span><i class="fa fa-video-camera"></i> </span>
                    <span><i class="fa fa-film"></i> </span>

                </div>
                */?>
        </div>
        <div style="display: block; position: absolute; top: 15%; right: 30%; width: 10%; padding-left: 5%; z-index: 99;">
            <span style="font-size: 26px; color: #6060D5;"><i class="fa fa-envelope-o"></i></span>
        </div>

    </div>
</div>
<div style="display: block; width:100%; border-top: 1px solid #e8ecec;  float: left; padding-top: 20px; padding-bottom: 20px; text-align: center;">
    <span style="text-transform: none; font-size: 20px; font-family: questrial; font-style: italic;"><?php echo $info['greeting_message_to_community'] ?></span>
</div>
<div style="display: block; width:100%; border-top: 1px solid #e8ecec;  float: left; padding-top: 10px; padding-bottom: 40px; text-align: center;">
    <span style="text-transform: none; font-style: italic;"><?php echo $info['description'] ?></span>
</div>

<?php /* ### map of associated videos, zoom to fit **/ ?>
{{--<div style="display: block; padding-bottom: 40px;"><img width=100% height=100% src="smallmap.png" alt=""></div>--}}

<div style="display: block; width:100%; text-align: center;">
    <div style="display: block; padding-bottom: 40px; width:65%; padding-top: 40px; padding-right: 20px; float: left; text-align: center;">
        <div><h5><i class="fa fa-film"></i> Media Involvements</h5></div>
        <?php /* ### LIST OF ASSOCIATED VIDEOS - CLICK THUMBNAIL IMAGE TO OPEN VIDEO-INFO-BLADE */ ?>
        <?php

        foreach($group_contents as $content){
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $content['url'], $matches);
        $video_id = isset($matches[1])?$matches[1]:'';
        ?>
        <div onclick="openVideo('<?php echo $content['id'] ?>')"><img width=100% src="https://img.youtube.com/vi/<?php echo $video_id ?>/maxresdefault.jpg"></div>
        <div class="placedetails">
            <span class="pull-left" ><i class="fa fa-tag"></i> <?php echo $content['primary_subject_tag'] ?></span>
            <?php foreach($content->videoProducer as $user){ ?>
                <span class="pull-right"><i class="flaticon-avatar"></i> <span class="inactive_link" onclick="openProfile('<?php echo $user->user->id ?>')" >@<?php echo $user->user->display_name ?></span></span>
            <?php } ?>
        </div>
        <?php } ?>

    </div>
    <div style="display: block; text-align: center; padding-bottom: 40px; padding-top: 40px; float: right; width:35%; padding-left: 20px; ">
        <div><h5><i class="fa fa-users"></i> Users</h5></div>
        <?php /* ### list of group users that have privacy setting = public (or, if logged in, = logged in)*/
        foreach($group_users as $user){
        ?>
        <?php /* ### click user name or image to open user-info-blade */ ?>

        <?php /* ### can you please help align these divs to center? */ ?>
        <div style="width: 100%; text-align: center;">
            <?php if(!isset($user->image[0]->url)){?>
                <img onclick="openProfile('<?php echo $user->id ?>')" style="margin-left: 25%;" height="150" width="150" src="/profilephoto.png">
            <?php }else{ ?>
                <img onclick="openProfile('<?php echo $user->id ?>')" style="margin-left: 25%;" height="150" width="150" src="<?php echo '/storage/'.$user->image[0]->url; ?>">
            <?php } ?>

            <div style="clear: both"></div>
        </div>
        <div style="display: block; width: 100%; text-align: center;">
            <span style="color: #8d8d8d;"><i class="fa fa-user"></i> <span class="inactive_link" onclick="openProfile('<?php echo $user->id ?>')"><?php echo $user->display_name ?></span></span>
        </div>
        <?php } ?>
    </div>
</div>
<div style="clear: both;" ></div>
<?php /*
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
                                <h6 style="margin-top: 0px;font-weight: bold;cursor: pointer;" onclick="openVideo('<?php echo $video['id'] ?>')"><?php echo $video['title'] ?></h6>
                                <iframe width="300" height="150" src="<?php echo str_replace( 'watch?v=', 'embed/',$video['url']) ?>" frameborder="0" allowfullscreen></iframe>
                            <?php } ?>
                        </div>
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

    .inactive_link{
        cursor: pointer;
    }
</style>

 */ ?>