
<?php foreach($uploaded_list as $info){?>
<div class="row" style="display: block;margin: 0px;height: auto;">
    <div class="col-md-6" style="margin:0px;padding: 0px;">
        <iframe style="width: 100%;" src="<?php echo str_replace( 'watch?v=', 'embed/',$info['url']) ?>" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="col-md-6" style="margin:0px;padding: 0px;padding-left: 10px;">
        <?php
        $tags = explode(',', $info['tag_colors']);
        foreach($tags as $tag){
            $tag_name_n_color = explode('-', $tag);

            echo '<span style="background-color: '.$tag_name_n_color[0].'" class="dot"></span>';
        } ?>
        <div></div>
        <h4 style="margin-top: 0px;font-weight: bold;"><?php echo $info['title'] ?></h4>
        <div>@<?php echo $info['display_name'] ?></div>
        <div><?php echo date('d F Y',strtotime($info['created_at'])) ?>, <?php echo $info['location'] ?></div>
    </div>
</div>
<?php } ?>
