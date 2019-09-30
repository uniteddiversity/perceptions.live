<?php /* ### LIST OF ASSOCIATED VIDEOS - CLICK THUMBNAIL IMAGE TO OPEN VIDEO-INFO-BLADE */ ?>
<?php

foreach($videos as $content){
    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $content['url'], $matches);
    $video_id = isset($matches[1])?$matches[1]:'';
    ?>
    <div class="video_thumb active_link" onclick="openVideo('<?php echo $content['id'] ?>')">
                <span>
                    <img width=100% style="max-height: 142px" src="https://img.youtube.com/vi/<?php echo $video_id ?>/maxresdefault.jpg">
                </span>
        <div class="placedetails">
                    <span class="pull-left"><i class="fa fa-tag"></i>
                        <?php echo $content['primary_subject_tag'] ?></span>
            <?php foreach($content->videoProducer as $user){ ?>
                <span class="pull-right"><i class="fa fa-film"></i> <span class="inactive_link" onclick="openProfile('<?php echo $user->user->id ?>')">@
                            <?php echo $user->user->display_name ?></span></span>
            <?php } ?>
        </div>
    </div>
<?php } ?>
<div class="pages">
    @include('partials.pagination-popup', ['paginationData' => $paginationData, 'id' => 'group_video_paging'])
</div>
