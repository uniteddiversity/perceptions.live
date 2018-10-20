<?php
$display = ($user_status == 'private' || $user_status == 'only-logged')? false : true;
?>
<div style="padding-top: 20px; padding-bottom: 30px; width: 60%; text-align: center; margin: 0 auto;"><?php //dd(date_create()) ?>
    <div style="display: block; width:100%; text-align: left;">

        <div style="width: 30%; padding-right: 20px; border-right: 1px solid #e8ecec; display: block; text-align: center; float: left; margin-left: 5%;">
            <div style="display: block; width:100%; text-align: center;">
                <img height="150" width="150" class="avatar profile_img_mini" src="<?php if(isset($info['image'][0])){ echo '/storage/'.$info['image'][0]->url; }else{ ?>/assets/img/face1.png<?php } ?>" alt="profile image">
            </div>

            <?php /* ### PRIVACY SETTINGS ICON: if public, then fa-eye; if only logged in, then fa-lock; if private, then fa-eye-slash  */ ?>

            <div style="display: block; width:100%; text-align: center;"><h4>{{$info['display_name']}}
                    <?php
                    if($user_status == 'public'){
                        echo '<i class="fa fa-eye"></i>';
                    }elseif($user_status == 'private'){
                        echo '<i class="fa fa-eye-slash"></i>';
                    }elseif($user_status == 'logged-in' || $user_status == 'only-logged'){
                        echo '<i class="fa fa-lock"></i>';
                    }
                    ?>

                </h4></div>

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
            <div>
                <span style="font-size: 18px;"> <em>{{$info['first_name']}}</em></span>
            </div>
            <?php if(!empty($info['location'])){ ?>
            <div style="font-size: 14px; text-transform: uppercase; font-family: ralewaymedium; color: #6060D5;"><i class="flaticon-pin"></i> <em>{{$info['location']}}</em></div>
            <?php } ?>
            <?php /*<div style="padding-top: 20px; font-size: .9em; line-height: 1.3em;"><i class="fa fa-clipboard"></i> SKILLSitem1, <i class="fa fa-clipboard"></i> SKILLSitem2, etc</div> */ ?>

            <?php if(isset($info->actingRoles) && count($info->actingRoles) > 0){ ?>
            <div style="padding-top: 10px; font-size: .9em; line-height: 1.3em;">
                <span>COLLABORATION ROLES: </span>
                <?php foreach($info->actingRoles as $tag){ ?>
                    <span data-toggle="tooltip" data-animation="true" data-placement="bottom" data-original-title="<?php echo $tag->tag->name ?>"><i class="fa <?php echo $tag->tag->icon ?>"></i></span>
                <?php } ?>

            </div>
            <?php } ?>

            <?php } //only visible true ?>

            <?php if($info['status_id'] == '5' ){ ?>
            <div style="width:100%; text-align: center; color: #333333; font-style: italic; font-size: 12px; "><a href="/claim-profile" target="_blank">claim this profile</a></div>
            <?php } ?>
        </div>
    </div>
</div>



<?php if($display){ ?>
<div style="display: block; width:100%; border-top: 1px solid #e8ecec;  float: left; padding-top: 30px; padding-bottom: 40px; text-align: center;">
    <span style="text-transform: none; font-style: italic;"><?php echo $info['description'] ?></span>
</div>

<div style="display: block; width:100%; padding-bottom: 20px; text-align: center;">
    <div style="display: block; width:50%; padding-right: 20px; float: left; text-align: center;">
        <div><h5><i class="fa fa-film"></i> Media Involvements</h5></div>
        <?php /* ### LIST OF ASSOCIATED VIDEOS - CLICK THUMBNAIL IMAGE TO OPEN VIDEO-INFO-BLADE */ ?>

        <?php foreach($info['user_involvement_videos'] as $video){ //dd($video['user_association_tag_slug']);
            preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $video['url'], $matches);
            $video_id = isset($matches[1])?$matches[1]:'';
            ?>
        <div class="video_thumb active_link" onclick="openVideo('<?php echo $video['id'] ?>')">
            <img width=100% height=100% src="https://img.youtube.com/vi/<?php echo $video_id ?>/maxresdefault.jpg">
        </div><div style="clear: both;"></div>
        <div class="placedetails">

            <?php /* ### this is "video producer" or "onscreen" or "co-creator" or "submitter" based on video profile */ ?>
            <span class="pull-left" ><i class="fa fa-star-o"></i>
                <?php echo $video['user_association'] ?>
            </span>
            <?php /* <span class="pull-right"><i class="flaticon-avatar"></i> <span class="inactive_link" onclick="openProfile('<?php echo $video['user_id'] ?>')"><?php (isset($video['display_name']));echo $video['display_name'] ?></span></span> */ ?>
        </div>
        <?php } ?>

    </div>
    <div style="display: block; float: right; width:50%; padding-left: 20px; text-align: center;">
        <div><h5><i class="fa fa-users"></i> Group Associations</h5></div>
        <?php /* ### click group image to open group-info-blade */ ?>
        <?php /* ### this div is only present if there is a group associated with video ### can we align icon with text? */ ?>

        <?php foreach($info['group_involvement_videos'] as $video){ //dd($video['location']);
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $video['url'], $matches);
        $video_id = isset($matches[1])?$matches[1]:'';
        ?>
        <div class="video_thumb active_link" onclick="openVideo('<?php echo $video['id'] ?>')">
            <img width=100% height=100% src="https://img.youtube.com/vi/<?php echo $video_id ?>/maxresdefault.jpg" alt="">
        </div><div style="clear: both;"></div>
        <div class="placedetails">
            <span class="pull-left" ><i class="flaticon-pin"></i> <?php echo $video['location'] ?> </span>
            <?php
                $group_names=[];
            $vid_ids = explode(',',$video['group_names_ids']);
            foreach($vid_ids as $v){
                $group_name_id = explode('-',$v);
                $group_id = isset($group_name_id[1])?$group_name_id[1]:'';
                $group_name = isset($group_name_id[0])?$group_name_id[0]:'';
                $group_names[] = '<span class="inactive_link" onclick="openGroupProfile(\''. $group_id .'\')">'. $group_name .'</span>';
            }
            ?>
            <span class="pull-right"><i class="fa fa-users"></i> <?php echo implode(', ', $group_names) ?>
            <div style="clear: both;"></div>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<div style="clear: both;" ></div>

<?php /*
<div class="row" style="display: block;">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" style="display: block;margin: 25px;">
                    <div class="col-md-2" style="margin:0px;padding: 0px;padding-left: 0px;">
                        <div class="profile-image">
                            <img class="avatar profile_img_mini" src="<?php if(isset($info['image'][0])){ echo '/storage/'.$info['image'][0]->url; }else{ ?>/assets/img/face1.png<?php } ?>" alt="profile image">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div>
                         <h3><?php echo '@'.$info['display_name'] ?></h3>
                         <p><?php echo $info['description'] ?></p>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div><strong>User since: </strong><?php echo date('d-m-Y', strtotime($info['created_at'])) ?></div>
                        <div><strong>Collaboration Roles: </strong><?php
                            if(isset($info->actingRoles)){
                                $datas = array();
                                foreach($info->actingRoles as $role){
                                    if(isset($role->tag)){
                                        $datas[] = $role->tag->name;
                                    }
                                }
                                echo implode(', ', $datas);
                            } ?></div>
                        <div><strong>Primary Intentions: </strong><?php
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

    .inactive_link{
        cursor: pointer;
    }
</style>
 */ ?>