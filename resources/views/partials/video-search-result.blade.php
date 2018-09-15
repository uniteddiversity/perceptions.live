<?php foreach($uploaded_list as $info){ ?>
<div class="col-lg-12">
    <div class="places s2">
        <div class="placethumb">
            <iframe frameborder="0" showinfo="0" controls="0" autohide="1" style="width: 100%;" src="<?php echo str_replace( 'watch?v=', 'embed/',$info['url']) ?>" frameborder="0" allowfullscreen></iframe>
            <div class="placeoptions">
                <span class="pull-left"> <i class="flaticon-eye"></i> Watch </span>
                <span class="pull-right"> <i class="flaticon-note"></i> More Info </span>
            </div>
            <span class="datebox""><small><em>19 August, 2018</small></em></span>
        </div>
        <div class="boxplaces">
            <div class="placeinfos">
                <span style="padding-bottom: 6px;">
                    <?php
                    $tags = explode(',', $info['tag_colors']);
                    foreach($tags as $tag){
                        $tag_name_n_color = explode('-', $tag);
                        $tag_id = isset($tag_name_n_color[1])? $tag_name_n_color[1] : '0';
                        echo '<span onclick="searchByTag(\''.$tag_id.'\')" style="background-color: '.$tag_name_n_color[0].'" class="dot"></span>';
                    } ?>
                </span>
                <h3><a href="#" title="" onclick="openVideo('<?php echo $info['id'] ?>')"><?php echo $info['title'] ?></a></h3>
                <span style="padding-bottom: 6px;"><small><em><?php echo date('d F Y',strtotime($info['created_at'])) ?></small></em></span>
                <span style="font-size: .8em;">First 128 characters of video description [...]</span>
                <ul class="listmetas">
                    <li><span class="rated">3</span>interactions</li>
                    <li><a href="#" title=""><i class="flaticon-chef"></i> Primary Subject Tag</a></li>
                </ul>
            </div>
            <div class="placedetails">
                <span class="pull-left"><i class="flaticon-pin"></i>Adelaide, Australia</span>
                <span class="pull-right"><i class="flaticon-avatar"></i>@videoproducer</span>
            </div>
        </div>
    </div>
</div>
<?php } ?>
