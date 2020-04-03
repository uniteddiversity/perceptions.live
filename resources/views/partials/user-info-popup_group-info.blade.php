<?php
//$group_names=[];
//$vid_ids = explode(',',$video['group_names_ids']);
//foreach($vid_ids as $v){
//    $group_name_id = explode('-',$v);
//    $group_id = isset($group_name_id[1])?$group_name_id[1]:'';
//    $group_name = isset($group_name_id[0])?$group_name_id[0]:'';
//    $group_names[] = '<span class="inactive_link" onclick="openGroupProfile(\''. $group_id .'\')">'. $group_name .'</span>';
//}
//            dd($group_names);
?>
<?php /*
<span class="pull-right"><i class="fa fa-users"></i> <?php echo implode(', ', $group_names) ?>
    <div style="clear: both;"></div>
</span>
*/ ?>
<?php /* ### click group image to open group-info-blade */ ?>

<?php
if(isset($groupsInfo)){
    foreach($groupsInfo as $group){  //dd($group);
        if(empty($group->id)){
            continue;
        }
        ?>
        <div style="width: 100%; text-align: center;">
            <?php if(!isset($group['group_avatar']) || empty($group['group_avatar'])){?>
                <img class="active_link" onclick="openGroupProfile('<?php echo $group['group_id'] ?>')" style="margin-left: 10%;" height="150" width="150" src="/assets/img/face1.png">
            <?php }else{ ?>
                <img class="active_link" onclick="openGroupProfile('<?php echo $group['group_id'] ?>')" style="margin-left: 10%;" height="150" width="150" src="<?php echo '/storage/'.$group['group_avatar']; ?>">
            <?php } ?>

            <div style="clear: both"></div>
        </div>
        <div style="display: block; width: 100%; text-align: center;">
                    <span style="color: #8d8d8d;"><i class="fa fa-user"></i> <span class="inactive_link" onclick="openGroupProfile('<?php echo $group['id'] ?>')">
                            <?php echo $group['group_name'] ?></span></span>
            <?php if(!empty($group['group_default_location'])){ ?>
                <div style="color: #8d8d8d;"><i class="flaticon-pin"></i>
                    <?php echo $group['group_default_location'] ?>
                </div>
            <?php } ?>

        </div>
        <?php
    }
}
?>

<div class="pages">
    @include('partials.pagination-popup', ['paginationData' => $paginationData, 'id' => 'user_group_paging'])
</div>
