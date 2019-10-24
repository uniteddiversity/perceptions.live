@foreach($comments as $comment)
    <div class="comment" id="comment_<?php echo uid($comment['id']) ?>">
        <p class="com_user" onclick="openProfile('<?php echo $comment['user']['id'] ?>')">
            <?php if(isset($comment['user']['image']) && isset($comment['user']['image'][0])){ ?>
                <img class="comment_avatar" src="{{ Imgfly::imgFly('../public/'.$comment['user']['image'][0]->url.'?w=25' ) }}">&nbsp;
            <?php }else{ ?>
                <img class="comment_avatar" src="{{ Imgfly::imgPublic('face1.png?w=25','img' )}}">&nbsp;
            <?php } ?>

            <a href="#">@<?php echo $comment['user']['display_name'] ?></a></p>
        <div class="comment-inner">
            <p>
                <?php echo $comment['comment'] ?>
                <?php if($comment['parent_id'] == 0){ ?>
                    <a class="reply_comment_link" id="comment_<?php echo uid($comment['id']) ?>" onclick="showTextbox('forcomment_<?php echo uid($comment['id']) ?>')" href="#">reply&nbsp;&nbsp;<i class="fas fa-arrow-circle-right"></i></a>
                <?php } ?>
            </p>
        </div>
    </div>

    <?php if($comment['parent_id'] == 0){ ?>
        <div id="forcomment_<?php echo uid($comment['id']) ?>" class="reply_comment">
            <div style="width: 65%;">
                <input class="comment_box" type="text" id="comment_text_<?php echo uid($comment['id']) ?>" placeholder="Text goes here..." />
            </div>
            <div style="float: left;">
                <a href="#" onclick="postComments('<?php echo uid($info->id) ?>', 'contents', '<?php echo uid($comment['id']) ?>', 'comment_text_<?php echo uid($comment['id']) ?>')" class="btn btn-primary">Submit</a>
            </div>
        </div>
    <?php } ?>
    <div class="comment" id='content_reply_<?php echo uid($comment['id']) ?>' style="padding-left: 20px;">
        @include('partials.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach
