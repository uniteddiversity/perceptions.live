@extends('layouts.app')
@section('content')

<?php //dd($group_users) ?>
<div class="modal-dialog big" style="margin-top: 0px !important;">

<div class="modal-inner two">
    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
    <button class="model-back" onclick="modalBack()" aria-hidden="true">&lt;</button>


    <div class="user_info">
        <div style="display: block; width:100%; text-align: left;">
            <div class="user_img">
                <span>
                    <img height="150" width="150" class="avatar profile_img_mini" src="<?php if(isset($info['image'][0])){ echo '/storage/'.$info['image'][0]->url; }else{ ?>/assets/img/face1.png<?php } ?>" alt="profile image">
                </span>
            </div>

            <?php /* ### PRIVACY SETTINGS ICON: if public, then fa-eye; if only logged in, then fa-lock; if private, then fa-eye-slash  */ ?>


            <div class="right" style="float:left;">

                <h4>
                    <?php echo $info['name'] ?>
                    {{--<i class="fa fa-eye"></i>--}}
                </h4>


                <div class="status">
                    <?php echo ($info['status'] == '1' )? '<span style="color:green">{{__('backend.active')}}</span>': 'Inactive'; ?>
                </div>


                <?php if(isset($info['acting_roles']) && count($info['acting_roles']) > 0){ ?>
                <div style="padding-top: 10px; font-size: .9em; line-height: 1.3em;">
                    <span>COLLABORATION ROLES: </span>
                    <?php foreach($info['acting_roles'] as $tag){ //dd($tag['tag']['icon']); ?>
                    <span data-toggle="tooltip" data-animation="true" data-placement="bottom" data-original-title="<?php echo $tag['tag']['name'] ?>" title="<?php echo $tag['tag']['name'] ?>"><i class="fa <?php echo $tag['tag']['icon'] ?>"></i></span>
                    <?php } ?>

                </div>
                <?php } ?>


                <div style="display: block; width: 100%; float: left;">
                    <div style="padding-bottom: 5px;">
                        <span class="dot" style="background-color: #1c2833;"></span>
                        <span class="dot" style="background-color: red;"></span>
                        <span class="dot" style="background-color: orange;"></span>
                    </div>

                    <div style="padding-bottom: 5px;">
                        <div style="font-size: 14px; text-transform: uppercase; line-height: .8em; font-family: ralewaybold;"> Category : <span style="font-weight: normal;">
                                <?php if(isset($info['category'])){ echo $info['category']['name']; } ?></span></div>
                        <?php //dd($info) ?>
                        <div style="text-transform: none; padding-top: 10px; font-style: italic;">
                            <?php echo $info['current_mission'] ?>
                        </div>
                    </div>

                    <div style="font-size: 12px; text-transform: uppercase; font-family: ralewaymedium; color: #6060D5;"><i class="flaticon-pin"></i> <em>
                            <?php echo $info['default_location'] ?></em></div>
                </div>
            </div>

            <?php /* ### If Inactive, add link: CLAIM THIS PROFILE */ ?>
            <?php if($info['status'] == '5' ){ ?>
            <div class="btn_top">
                <a class="btn white" href="/claim-profile" target="_blank">claim this group</a>
            </div>
            <?php } ?>

            <div style="display: none; position: absolute; top: 15%; right: 30%; width: 10%; padding-left: 5%; z-index: 99;">
                <span style="font-size: 26px; color: #6060D5;"><i class="fa fa-envelope-o"></i></span>
            </div>
        </div>
    </div>
    <div style="display: block; width:100%; float: left; text-align: center;">
        <span style="text-transform: none; font-size: 20px; font-family: questrial; font-style: italic;">
            <?php echo $info['greeting_message_to_community'] ?></span>
    </div>
    <div style="display: block; width:100%; float: left; text-align: center;">
        <span style="text-transform: none; font-style: italic;">
            <?php echo $info['description'] ?></span>
    </div>

    <?php /* ### map of associated videos, zoom to fit **/ ?>
    {{--<div style="display: block; padding-bottom: 40px;"><img width=100% height=100% src="smallmap.png" alt=""></div>--}}

    <div class="video_section row">
        <div class="video_inner col-9">

            <div>
                <h5><i class="fas fa-video"></i> Media Involvements</h5>
            </div>
            <div id="group-info-popup_video">
                @include('partials.group-info-popup_video', ['videos' => $group_contents, 'paginationData' => $contents1])
            </div>
        </div>
        <div class="col-3">
            <div>
                <h5><i class="fas fa-users"></i> Users</h5>
            </div>
            <div id="group-info-popup_user">
                @include('partials.group-info-popup_user', ['groupUsers' => $group_users, 'paginationData' => $contents2])
            </div>
        </div>

        <input id="popup_group_id" type="hidden" value="{{$group_id}}" />
    </div>
    <div style="clear: both;"></div>
</div>
</div>
<style>
    #featureModal .modal-header {
        display: none;
    }
</style>
@endsection