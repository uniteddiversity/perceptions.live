
<?php foreach($uploaded_list as $info){?>
<div class="row" style="margin: 0px;height: auto;">
    <div style="margin:0px;padding: 0px;width: 50%;float: left;">
        <iframe style="width: 100%;height: 105px" src="<?php echo str_replace( 'watch?v=', 'embed/',$info['url']) ?>" frameborder="0" showinfo=0
                controls=0
                autohide=1 allowfullscreen></iframe>
    </div>
    <div style="margin:0px;padding: 0px;padding-left: 10px;width: 48%;float: left;">
        <?php
        $tags = explode(',', $info['tag_colors']);
        foreach($tags as $tag){
            $tag_name_n_color = explode('-', $tag);
            $tag_id = isset($tag_name_n_color[1])? $tag_name_n_color[1] : '0';
            echo '<span onclick="searchByTag(\''.$tag_id.'\')" style="background-color: '.$tag_name_n_color[0].'" class="dot"></span>';
        } ?>
        <div></div>
        <h5 style="margin-top: 0px;font-weight: bold;cursor: pointer;" onclick="openVideo('<?php echo $info['id'] ?>')"><?php echo $info['title'] ?></h5>
            <div><span style="cursor: pointer;" onclick="openProfile('<?php echo $info['user_id'] ?>')">@<?php echo $info['display_name'] ?></span></div>
        <div><?php echo date('d F Y',strtotime($info['created_at'])) ?>, <?php echo $info['location'] ?></div>
    </div>
    <div style="clear: both;"></div>
</div>
<?php } ?>
