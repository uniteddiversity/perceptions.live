
<?php foreach($uploaded_list as $info){?>
<div class="row" style="display: block;margin: 0px;">
    <div class="col-md-6" style="margin:0px;padding: 0px;">
        <iframe style="width: 100%;" src="<?php echo str_replace( 'watch?v=', 'embed/',$info['url']) ?>" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="col-md-6" style="margin:0px;padding: 0px;padding-left: 10px;">
        <div></div>
        <h3 style="margin-top: 0px;"><?php echo $info['title'] ?></h3>
        <div>@<?php echo $info['display_name'] ?></div>
        <div><?php echo date('d F Y',strtotime($info['created_at'])) ?>, <?php echo $info['location'] ?></div>
    </div>
</div>
<?php } ?>
