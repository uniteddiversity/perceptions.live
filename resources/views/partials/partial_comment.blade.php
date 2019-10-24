<div class="comment" id="comment_{{$data['id']}}">
    <p class="com_user" onclick="openProfile('{{$data['user']['id']}}')">
        <?php if(isset($data['user']['image']) && isset($data['user']['image'][0])){ ?>
            <img class="comment_avatar" src="{{ Imgfly::imgFly('../public/'.$data['user']['image'][0]->url.'?w=25' ) }}">&nbsp;
        <?php }else{ ?>
            <img class="comment_avatar" src="{{ Imgfly::imgPublic('face1.png?w=25','img' )}}">&nbsp;
        <?php } ?>
        &nbsp;
        <a href="#">@<?php echo $data['user']['display_name'] ?></a>
    </p>
    <div class="comment-inner">
        <p>
            {{$data['comment']}}
            <?php if($data['parent_id'] == 0){ ?>
                <a class="reply_comment_link" id="comment_<?php echo uid($data['id']) ?>" onclick="showTextbox('forcomment_<?php echo $data['id'] ?>')" href="#">reply&nbsp;&nbsp;<i class="fas fa-arrow-circle-right"></i></a>
            <?php } ?>
        </p>
    </div>
</div>
<?php if($data['parent_id'] == 0){ ?>
    <div id="forcomment_<?php echo $data['id'] ?>" class="reply_comment">
        <div style="width: 65%;">
            <input class="comment_box" type="text" id="comment_text_<?php echo $data['id'] ?>" placeholder="Text goes here..." />
        </div>
        <div style="float: left;">
            <a href="#" onclick="postComments('<?php echo uid($data['fk_id']) ?>', 'contents', '<?php echo $data['id'] ?>', 'comment_text_<?php echo $data['id'] ?>')" class="btn btn-primary">Submit</a>
        </div>
    </div>
<?php } ?>
<div class="comment" id='content_reply_<?php echo uid($data['id']) ?>' style="padding-left: 20px;"><div class="comment" id='content_reply_<?php echo $data['id'] ?>' style="padding-left: 20px;">
</div>
