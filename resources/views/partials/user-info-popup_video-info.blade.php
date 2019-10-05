<?php /* ### LIST OF ASSOCIATED VIDEOS - CLICK THUMBNAIL IMAGE TO OPEN VIDEO-INFO-BLADE */ ?>

<?php foreach($contentInfo as $video){
    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $video['url'], $matches);
    $video_id = isset($matches[1])?$matches[1]:'';
    ?>
    <div class="video_thumb active_link" onclick="openVideo('<?php echo $video['id'] ?>')">
        <span>
            <img width=100% style="max-height: 142px" src="https://img.youtube.com/vi/<?php echo $video_id ?>/maxresdefault.jpg">
        </span>
        <div class="placedetails">

            <?php /* ### this is "video producer" or "onscreen" or "co-creator" or "submitter" based on video profile */ ?>
            <span class="pull-left">
                        <?php echo empty($video['user_association'])?'Creator' : $video['user_association'] ?>
                    </span>
            <?php /* <span class="pull-right"><i class="flaticon-avatar"></i> <span class="inactive_link" onclick="openProfile('<?php echo $video['user_id'] ?>')">
                    <?php (isset($video['display_name']));echo $video['display_name'] ?></span></span> */ ?>
        </div>
    </div>
<?php } ?>

<div class="pages">
    @include('partials.pagination-popup', ['paginationData' => $paginationData, 'id' => 'user_video_paging'])
</div>
