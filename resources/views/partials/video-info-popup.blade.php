<?php
preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $info['url'], $matches);
$video_id = isset($matches[1])?$matches[1]:'';
?>
<div class="modal-body">
    <button class="close mobile_show" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
    <div class="youtube">
        <iframe style="width: 100%;height: 422px" src="<?php echo str_replace( array('watch?v=','http://'), array('embed/','https://'),$info['url']) ?>" frameborder="0" allowfullscreen></iframe>
    </div>

    <div class="modal-inner">
        <div style="display: block; width:100%; text-align: center;">

            <div class="placedetails">
                <span style="float: left; display:none;">
                    <?php if(isset($info->category)){ echo $info->category->name; }; ?>
                </span>
                <div class="credits_outer">
                    <h5 style="display:none;">Credits</h5>
                    <div class="usersmetas2" style="border-top:none;">
                        <strong><i class="fa fa-user-circle"></i> Onscreen: </strong>
                        <?php if(isset($info->onScreen) && count($info->onScreen) > 0){
                $datas = array();
                foreach($info->onScreen as $user){
                    $datas[] = '@'.'<span class="inactive_link" onclick="openProfile('.$user->user->id.')">'.$user->user->display_name.'</span>';
                }

                if(!empty($datas)){
                ?>
                        <div>
                            <?php
                    echo implode(', ', $datas);
                    ?>
                        </div>
                        <?php }
                }; ?>

                        <span class="pull-leftopen">

                            <?php if(isset($info->groups) && count($info->groups) > 0){
            $datas = array();
            foreach($info->groups as $group){
                if(isset($group->group) && isset($group->group->id))
                    $datas[] = '@'.'<span class="inactive_link" onclick="openGroupProfile('.$group->group->id.')">'.$group->group->name.'</span>';
            }

            if(!empty($datas)){
            ?>

                            <?php
                echo implode(', ', $datas);
                ?>

                            <?php }
            }; ?>
                        </span>
                    </div>
                    <div class="usersmetas2" style="margin-left:10px;">
                        <strong><i class="far fa-user"></i> Co-Creators: </strong>
                        <?php if(isset($info->coCreators)){

                    $datas = array(); $users_count = 0;
                    foreach($info->coCreators as $user){
                        $users_count++;
                        $datas[] = '@'.'<span class="inactive_link" onclick="openProfile('.$user->user->id.')">'.$user->user->display_name.'</span>';
                    }

                    if(!empty($datas)){
                        echo implode(', ', $datas);
                    }
                }
                ?>

                        <span class="pull-right">

                            <?php foreach($info->videoProducer as $key => $users){ if(isset($info->videoProducer[$key])){ echo ($users_count>0)?',':''.'@<span class="inactive_link" onclick="openProfile(\''. $info->videoProducer[$key]->user->id .'\')">'.$info->videoProducer[$key]->user->display_name.'</span>'; break; } }?>
                        </span>
                    </div>
                </div>
                <div class="usersmetas1">
                    <span style="float: right;" style="color:#cfcff2;">
                        <i class="fas fa-map-marker-alt"></i> {{$info['location']}}
                    </span>




                </div>
            </div>


            <div class="videosubject">

                <i class="fa fa-tag"></i> {{$info['primary_subject_tag']}}

                <span style="margin-left: auto; margin-right: auto; z-index: 5;">
                    <?php foreach($info->gciTags as $tag){
                    if(isset($tag->tag) && isset($tag->tag->tag))
                        echo '<span class="dot" data-toggle="tooltip" data-animation="true" data-placement="top" style="margin-top:-10px; text-transform: none; background-color: '.$tag->tag->tag_color.'" title="'.$tag->tag->tag.'" ></span>';
                }
                ?>
                </span>

            </div>
            <div style="display: block; position: relative; width: 100%;">
                <h4>{{$info['title']}}</h4>
            </div>
            <div style="display: block; width: 100%;">
                <div style="margin-top:25px; font-size: 14px; text-transform: uppercase; font-family: ralewaybold;">

                </div>
            </div>
        </div>

        <div>
            <span style="display: block; width:100%; float: left;">
                <p style="font-size: .9em; line-height: 1.3em; margin-bottom:15px;">
                    {{$info['brief_description']}}
                </p>
            </span>
        </div>
        <div class="bottom_info">

            <div class="listmetas_outer">
                <span class="listmetas2">
                    <?php
                    $datas = [];
                    foreach($info->sortingTags as $tag){
                        if(isset($tag->content_tag_id) && isset($tag->tag->tag)){
                            $datas[] = ' <strong><i class="fa fa-tag"></i> '.$tag->tag->tag.'</strong> ';
                        }
                    }
                    if(!empty($datas)){
                        echo implode(' ', $datas);
                    }
                    ?>
                </span>
            </div>
        </div>

    </div>

    <div class="right-comments">
        <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="donate mobile_hide">
            <a href="#" class="btn"><i class="fas fa-hand-holding-usd"></i>{{__('backend.donate')}}</a>
        </div>
        <div class="comments_outer">
            <div class="comments_inner">
                @include('partials.commentsDisplay', ['comments' => $comments, 'fk_id' => $info->id, 'table' => 'contents'])
                <?php if(count($comments) == 0){ ?>
                    <div class="comment no-comment-yet-<?php echo uid($info->id) ?> no_comment_yet" >
                        {{__('backend.no_comment_yet')}}
                    </div>
                <?php } ?>
            </div>
        </div>
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <div class="btn_outer">
            <?php if((Auth::user())){ ?>
                <div class="btn_inner" style="border-bottom:1px solid rgb(31,31,31);">
                    <label>{{__('backend.message')}}</label>
                    <?php /* <textarea id="comment_0" placeholder="Text goes here..."></textarea> */ ?>
                    <input type="text" id="comment_text_0" placeholder="Text goes here..." />
                    <a href="#" onclick="postComments('<?php echo uid($info->id) ?>', 'contents', 0, 'comment_text_0')" class="btn">{{__('backend.submit')}}</a>
                </div>
            <?php }?>
            <?php if((Auth::user())){ ?>
            <div class="btn_inner open">
                <a href="#" id="add" class="btn">{{__('backend.add_a_comment')}}</a>
            </div>
            <?php }?>
            <?php if(!(Auth::user())){ ?>
            <div class="open" style="padding: 20px;float: left;width: 100%;">
                <a href="#" class="btn">{{__('backend.login_to_comment')}}</a>
            </div>
            <?php }?>
        </div>
    </div>

    <div class="mobile_btns">
        <a href="#" id="details">
            <span><i class="fas fa-info"></i>{{__('backend.view_video_details', ['name'=>__('video')])}}</span>
            <span><i class="far fa-times-circle"></i>{{__('backend.hide_video_details', ['name'=>__('video')])}}</span>
        </a>
        <a href="#" id="comments">
            <span> <i class="far fa-comment-dots">
                </i>View Comments <strong>(12)</strong></span>
            <span> <i class="far fa-times-circle"></i>{{__('backend.close_comments')}}Close Comments</span>
        </a>
        <a href="#" class="btn mobile_show"><i class="fas fa-hand-holding-usd"></i>{{__('backend.donate')}}</a>
    </div>
</div>
<input type="hidden" id="page_url" value="<?php echo route('video.page.show', ['_category_name' => isset($info->category)?str_replace(' ', '-', $info->category->name):'category', '_date' => date('Y-m-d', strtotime($info['captured_date'])), '_video_title' => str_replace(' ', '-', $info['title']), '_video_uid' => uid($info->id)]); ?>" />
<div style="clear: both;"></div>

<script>
    $(document).ready(function(){
        window.history.pushState("object or string", "Title", $('#page_url').val());
    })

    $('.btn').on('click', function(e) {
        $('.right-comments .btn_inner').addClass("open");
        $(this).parent().removeClass("open");
        e.preventDefault();
    });

    $('#details').click(function() {
        $('.modal-inner .placedetails').toggleClass("active");
        $(this).toggleClass("active");
    })

    $('#comments').click(function() {
        $('.modal-dialog.big .modal-inner').toggleClass("hidden");
        $('.youtube').toggleClass("hidden");
        $('.modal-body .right-comments').toggleClass("active");
        $('#details').toggleClass("hidden");
        $('#details').removeClass("active");
        $(this).toggleClass("active");
    })

</script>
<script>
    jQuery("time.timeago").timeago();
</script>
<?php /* <div class="row" style="display: block;">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" style="display: block;margin: 25px;">
                    <div style="text-align: center;">{{date('d-m-Y', strtotime($info['created_at']))}} {{$info['location']}}</div>
                    <h2 class="card-title">{{$info['title']}}</h2>

                    <p style="padding-left: 0px;">{{$info['brief_description']}}</p>
                </div>

                <div class="row" style="display: block;margin: 25px;">
                    <div class="col-lg-5 column" style="margin:0px;padding: 0px;padding-left: 0px;">
                        <div>Category - <?php if(isset($info->category)){ echo $info->category->name; }; ?>
</div>
<div>
    <?php if(!empty($info->learn_more_url)){ echo '<a target="_blank" href="'.$info->learn_more_url.'">Learn more..</a>'; }; ?>
</div>
</div>
<div class="col-lg-7 column">
    <div>Submitter:
        <?php if(isset($info->user)){ echo '@'.'<span class="inactive_link" onclick="openProfile('.$info->user->id.')">'.$info->user->display_name.'</span>'; }; ?>
    </div>
    <?php if(isset($info->videoProducer)){
                            $datas = array();
                            foreach($info->videoProducer as $user){
                                $datas[] = '@'.'<span class="inactive_link" onclick="openProfile('.$user->user->id.')">'.$user->user->display_name.'</span>';
                            }

                            if(!empty($datas)){
                            ?>
    <div>Producer(s):
        <?php
                            echo implode(', ', $datas);
                            ?>
    </div>
    <?php }
                        }; ?>
    <?php if(isset($info->coCreators)){

                            $datas = array();
                            foreach($info->coCreators as $user){
                                $datas[] = '@'.'<span class="inactive_link" onclick="openProfile('.$user->user->id.')">'.$user->user->display_name.'</span>';
                            }

                            if(!empty($datas)){
                            ?>

    <div>Co-creators(s):
        <?php
                                echo implode(', ', $datas);
                                ?>
    </div>

    <?php }
                        }; ?>
    <?php if(isset($info->onScreen) && count($info->onScreen) > 0){
                            $datas = array();
                            foreach($info->onScreen as $user){
                                $datas[] = '@'.'<span class="inactive_link" onclick="openProfile('.$user->user->id.')">'.$user->user->display_name.'</span>';
                            }

                            if(!empty($datas)){
                            ?>
    <div>On screen(s):
        <?php
                            echo implode(', ', $datas);
                            ?>
    </div>
    <?php }
                        }; ?>
    <?php if(isset($info->groups) && count($info->groups) > 0){
                            $datas = array();
                            foreach($info->groups as $group){
                                $datas[] = '@'.'<span class="inactive_link" onclick="openGroupProfile('.$group->group->id.')">'.$group->group->name.'</span>';
                            }

                            if(!empty($datas)){
                            ?>
    <div>Organization(s):
        <?php
                                echo implode(', ', $datas);
                                ?>
    </div>
    <?php }
                        }; ?>

</div>
</div>
<div class="row" style="display: block;margin: 25px;">
    <iframe width="800" height="400" src="<?php echo str_replace( 'watch?v=', 'embed/',$info['url']) ?>" frameborder="0" allowfullscreen></iframe>
</div>
</div>
</div>
</div>
</div>
*/ ?>

<?php /*
<img width=200 height=100 src="https://img.youtube.com/vi/<?php echo $video_id ?>/mqdefault.jpg">
<div class="row" style="display: block;margin: 5px;">
    <div style="font-size: 16px;margin-top: 6px;margin-bottom: 6px;">{{$info['title']}}
        <span style="padding-bottom: 6px;float: right;">
            <?php foreach($info->gciTags as $tag){
                    if(isset($tag->tag) && isset($tag->tag->tag))
                    echo '<span style="background-color: '.$tag->tag->tag_color.'" class="dot-small"></span>';
                }
                ?>
        </span>
    </div>
    <div><i class="flaticon-pin"> {{$info['location']}}</i></div>
    <div><i class="flaticon-avatar"></i>
        <?php foreach($info->videoProducer as $key => $users){ if(isset($info->videoProducer[$key])){ echo '<span class="inactive_link" onclick="openProfile(\''. $info->videoProducer[$key]->user->id .'\')">@'.$info->videoProducer[$key]->user->display_name.'</span>'; break; } }?>
    </div>

    <div><a href="#" onclick="openVideo('<?php echo $info['id'] ?>')"><i class="flaticon-eye"> Open Video</i></a></div>

</div>
*/ ?>
