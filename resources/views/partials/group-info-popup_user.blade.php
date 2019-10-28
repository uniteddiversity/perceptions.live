<?php /* ### list of group users that have privacy setting = public (or, if logged in, = logged in)*/
foreach($groupUsers as $user){
    ?>
    <?php /* ### click user name or image to open user-info-blade */ ?>

    <?php /* ### can you please help align these divs to center? */ ?>
    <div style="width: 100%; text-align: center;">
        <?php if(!isset($user->image[0]->url)){?>
            <img class="active_link" onclick="openProfile('<?php echo $user->id ?>')" style="margin-left: 10%;" height="150" width="150" src="/assets/img/face1.png">
        <?php }else{ ?>
            <img class="active_link" onclick="openProfile('<?php echo $user->id ?>')" style="margin-left: 10%;" height="150" width="150" src="<?php echo '/storage/'.$user->image[0]->url; ?>">
        <?php } ?>

        <div style="clear: both"></div>
    </div>
    <div style="display: block; width: 100%; text-align: center;padding: 10px;">
                    <span style="color: #8d8d8d;"><i class="fa fa-user"></i> <span class="inactive_link" onclick="openProfile('<?php echo $user->id ?>')">
                            <?php echo $user->display_name ?></span></span>
    </div>
<?php } ?>
<div class="pages">
    @include('partials.pagination-popup', ['paginationData' => $paginationData, 'id' => 'group_user_paging'])
</div>
