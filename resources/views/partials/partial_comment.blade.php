<div class="comment" id="comment_{{$data['id']}}">
    <p class="com_user" onclick="openProfile('{{$data['user']['id']}}')">
        <?php if(isset($data['user']['image']) && isset($data['user']['image'][0])){ ?>
            <img class="comment_avatar" src="{{ Imgfly::imgFly('../public/'.$data['user']['image'][0]->url.'?w=25' ) }}">&nbsp;
        <?php }else{ ?>
            <img class="comment_avatar" src="{{ Imgfly::imgPublic('face1.png?w=25','img' )}}">&nbsp;
        <?php } ?>
        &nbsp;
        <a href="#">@<?php echo $data['user']['display_name'] ?></a><time class="timeago" datetimez="2016-07-07T09:24:17Z" datetime="<?php echo $data['created_at']->format('c') ?>"><?php echo $data['created_at']->format('c') ?></time>
    </p>
    <div class="comment-inner">
        <p>
            {{$data['comment']}}
            <div class="actions">
                <?php if($data['parent_id'] == 0 && (Auth::user())){ ?>
                    <span class="reply_comment_link link" id="comment_<?php echo uid($data['id']) ?>" onclick="showTextbox('forcomment_<?php echo $data['id'] ?>')" href="#">reply&nbsp;&nbsp;<i class="fas fa-arrow-circle-right"></i></span>
                <?php } ?>
                <?php /*
                    <span class="link"><i onclick="deleteComment('<?php echo uid($data['id']) ?>')"  class="fas fa-trash"></i>&nbsp;&nbsp;</span>
                    */ ?>
                <?php if($data['parent_id'] == 0){ ?>
                    <span class="link" onclick="collapseComments('content_reply_<?php echo uid($data['id']) ?>', this)" ><i class="fas fa-arrow-up" ></i></span>
                <?php } ?>
            </div>
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
<div class="comment" id='content_reply_<?php echo uid($data['id']) ?>' style="padding-left: 20px;"><div class="comment" id='content_reply_<?php echo $data['id'] ?>'>
</div>
