<div class="row" style="display: block;">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div style="text-align: center;">{{date('d-m-Y', strtotime($info['created_at']))}} {{$info['location']}}</div>
                <h2 class="card-title">{{$info['title']}}</h2>

                <p>{{$info['brief_description']}}</p>
                <div class="row" style="display: block;">
                    <div class="col-md-8" style="margin:0px;padding: 0px;padding-left: 10px;">
                        Category - <?php if(isset($info->category)){ echo $info->category->name; }; ?>
                        <p>{{$info['description']}}</p>
                    </div>
                    <div class="col-md-4">
                        Submitter: <?php if(isset($info->user)){ echo '@'.$info->user->display_name; }; ?>
                        Producer(s): <?php if(isset($info->videoProducer)){
                            foreach($info->videoProducer as $user){
                                echo '@'.$user->user->display_name.',';
                            }
                        }; ?>
                        On screen(s): <?php if(isset($info->onScreen)){
                            foreach($info->onScreen as $user){
                                echo '@'.$user->user->display_name.',';
                            }
                        }; ?>
                        Producer(s): <?php if(isset($info->coCreators)){
                            foreach($info->coCreators as $user){
                                echo '@'.$user->user->display_name.',';
                            }
                        }; ?>
                    </div>
                </div>
                <div class="row" style="display: block;">
                    <iframe width="500" height="300" src="<?php echo str_replace( 'watch?v=', 'embed/',$info['url']) ?>" frameborder="0" allowfullscreen></iframe>
                </div>
                {{--<p>onscreen: {{$info['onscreen']}}</p>--}}
                {{--<p>Co Creators: {{$info['co_creators']}}</p>--}}
            </div>
        </div>
    </div>
</div>