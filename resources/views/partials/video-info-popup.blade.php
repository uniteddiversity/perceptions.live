<div class="row" style="display: block;">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" style="display: block;margin: 25px;">
                    <div style="text-align: center;">{{date('d-m-Y', strtotime($info['created_at']))}} {{$info['location']}}</div>
                    <h2 class="card-title">{{$info['title']}}</h2>

                    <p style="padding-left: 0px;">{{$info['brief_description']}}</p>
                </div>

                <div class="row" style="display: block;margin: 25px;">
                    <div class="col-md-5" style="margin:0px;padding: 0px;padding-left: 0px;">
                        <div>Category - <?php if(isset($info->category)){ echo $info->category->name; }; ?></div>
                        <div><?php if(!empty($info->learn_more_url)){ echo '<a target="_blank" href="'.$info->learn_more_url.'">Learn more..</a>'; }; ?></div>
                    </div>
                    <div class="col-md-7">
                        <div>Submitter: <?php if(isset($info->user)){ echo '@'.$info->user->display_name; }; ?></div>
                        <div>Producer(s): <?php if(isset($info->videoProducer)){
                            foreach($info->videoProducer as $user){
                                echo '@'.$user->user->display_name.',';
                            }
                        }; ?></div>
                        <div>Co-creators(s): <?php if(isset($info->coCreators)){
                                foreach($info->coCreators as $user){
                                    echo '@'.$user->user->display_name.',';
                                }
                            }; ?></div>
                        <div>On screen(s): <?php if(isset($info->onScreen)){
                            foreach($info->onScreen as $user){
                                echo '@'.$user->user->display_name.',';
                            }
                        }; ?></div>
                        <div>Organization(s): <?php if(isset($info->groups)){
                                foreach($info->groups as $group){
                                    echo '@'.$group->group->name.',';
                                }
                            }; ?></div>

                    </div>
                </div>
                <div class="row" style="display: block;margin: 25px;">
                    <iframe width="800" height="400" src="<?php echo str_replace( 'watch?v=', 'embed/',$info['url']) ?>" frameborder="0" allowfullscreen></iframe>
                </div>
                {{--<p>onscreen: {{$info['onscreen']}}</p>--}}
                {{--<p>Co Creators: {{$info['co_creators']}}</p>--}}
            </div>
        </div>
    </div>
</div>