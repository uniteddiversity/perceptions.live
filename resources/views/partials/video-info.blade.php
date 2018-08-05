<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{$info['title']}}</h4>
                <div><iframe width="500" height="300" src="<?php echo str_replace( 'watch?v=', 'embed/',$info['url']) ?>" frameborder="0" allowfullscreen></iframe></div>
                <p>{{$info['brief_description']}}</p>
                <p>{{$info['description']}}</p>
                <p>Producer: {{$info['video_producer']}}</p>
                <p>onscreen: {{$info['onscreen']}}</p>
                <p>Co Creators: {{$info['co_creators']}}</p>
            </div>
        </div>
    </div>
</div>
