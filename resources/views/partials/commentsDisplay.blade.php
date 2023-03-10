@foreach($comments as $comment)
    <div class="comment" id="comment_<?php echo uid($comment['id']) ?>">
        <p class="com_user" onclick="openProfile('<?php echo $comment['user']['id'] ?>')">
            <?php if(isset($comment['user']['image']) && isset($comment['user']['image'][0])){ ?>
                <img class="comment_avatar" src="{{ Imgfly::imgFly('../public/'.$comment['user']['image'][0]->url.'?w=25' ) }}">&nbsp;
            <?php }else{ ?>
                <img class="comment_avatar" src="{{ Imgfly::imgPublic('face1.png?w=25','img' )}}">&nbsp;
            <?php } ?>

            <a href="#">@<?php echo $comment['user']['display_name'] ?></a><time class="timeago" datetimez="2016-07-07T09:24:17Z" datetime="<?php echo $comment['created_at']->format('c') ?>"><?php echo $comment['created_at']->format('c') ?></time>
        </p>
        <div class="comment-inner">
            <p>
                <?php echo $comment['comment'] ?>
                <div class="actions">
                <?php if($comment['parent_id'] == 0 && (Auth::user())){ ?>
                    <span class="reply_comment_link link" id="comment_<?php echo uid($comment['id']) ?>" onclick="showTextbox('forcomment_<?php echo uid($comment['id']) ?>')" href="#">{{__('backend.reply')}}&nbsp;<i class="fas fa-arrow-circle-right"></i></span>
                <?php } ?>
                <?php /*
                <span class="link"><i onclick="deleteComment('<?php echo uid($comment['id']) ?>')"  class="fas fa-trash"></i>&nbsp;&nbsp;</span>
                */ ?>
                <?php if($comment['parent_id'] == 0){ ?>
                    <span class="link" onclick="collapseComments('content_reply_<?php echo uid($comment['id']) ?>', this)" ><i class="fas fa-arrow-up" ></i></span>
                <?php } ?>
                </div>
            </p>
        </div>
    </div>

    <?php if($comment['parent_id'] == 0){ ?>
        <div id="forcomment_<?php echo uid($comment['id']) ?>" class="reply_comment">
            <div style="width: 65%;">
                <input class="comment_box" type="text" id="comment_text_<?php echo uid($comment['id']) ?>" placeholder="{{__('backend.text_goes_here')}}" />
            </div>
            <div style="float: left;">
                <a href="#" onclick="postComments('<?php echo uid($fk_id) ?>', '<?php echo ($table) ?>', '<?php echo uid($comment['id']) ?>', 'comment_text_<?php echo uid($comment['id']) ?>')" class="btn btn-primary">{{__('backend.submit')}}</a>
            </div>
        </div>
    <?php } ?>
    <div class="comment" id='content_reply_<?php echo uid($comment['id']) ?>' style="padding-left: 20px;">
        @include('partials.commentsDisplay', ['comments' => $comment->replies, 'fk_id' => $fk_id, 'table' => $table])
    </div>
@endforeach

<script>
    jQuery("time.timeago").timeago();
</script>