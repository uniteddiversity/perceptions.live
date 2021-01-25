@extends('layouts.app')

@section('content')
<?php
preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $info['url'], $matches);
$video_id = isset($matches[1])?$matches[1]:'';
//dd($info->gciTags);
?>


    @include('partials.nav-bar')
<input type="hidden" id="video_id" value="<?php echo $info['id'] ?>" />
<input type="hidden" id="video_lat" value="<?php echo $info['lat'] ?>" />
<input type="hidden" id="video_long" value="<?php echo $info['long'] ?>" />
<section>
    <div class="block no-padding">
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sl-slider s2" id="makesliderfull">
                        <div class="slg-box"> <img src="https://img.youtube.com/vi/<?php echo $video_id ?>/maxresdefault.jpg" alt="" /> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block no-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slhead overlape">
                        <div class="row">

                            <div class="col-lg-5">
                                <div class="sltitle light">
                                    <div class="slbtns">
                                        <h1 style="float: left;color: white;width: auto;">{{$info['title']}}&nbsp;&nbsp;</h1>
                                        <div style="float: left;" class="watchvideo" onclick="openVideoOnly()" data-videolink="<?php echo str_replace( 'watch?v=', 'embed/',$info['url']) ?>">
                                            <a href="#" title=""><img src="/assets/frontend/images/play2.png" alt="">{{__('backend.watch_video', ['name' => __('video')])}}</a>
                                        </div>
                                    </div>

                                    <span><i class="flaticon-heart"></i>
                                        <?php
                                        $datas = [];
                                        foreach($info->gciTags as $tag){
                                            if(isset($tag->content_tag_id) && isset($tag->tag->tag)){
                                                $datas[] = $tag->tag->tag;
                                            }
                                        }
                                        if(!empty($datas)){
                                            echo implode(' ,', $datas);
                                        }
                                        ?>

                                    </span>
                                    <span><i class="flaticon-eye"></i>
                                        <?php
                                        $datas = [];
                                        foreach($info->sortingTags as $tag){
                                            if(isset($tag->content_tag_id) && isset($tag->tag->tag)){
                                                $datas[] = $tag->tag->tag;
                                            }
                                        }
                                        if(!empty($datas)){
                                            echo implode(' ,', $datas);
                                        }
                                        ?>
                                    </span>
                                    <div class="slbtnsspans">
                                        <span><i class="flaticon-map"></i> {{$info['location']}}</span>
                                        <span><i class="flaticon-avatar"></i>

                                            <?php
                                            if(isset($info->videoProducer)){
                                                $datas = array();
                                                foreach($info->videoProducer as $user){
                                                    $datas[] = '<span class="inactive_link" style="float:left" onclick="openProfile('.$user->user->id.')">'.'@'.$user->user->display_name.'</span>';
                                                }

                                                if(!empty($datas)){
                                                    echo implode(' ', $datas);
                                                }
                                            }
                                            ?>

                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="slbtnsspans light">
                                    <ul class="listmetas">
                                        <li><span class="rated">3.5</span>3 interactions</li>
                                        <li><a href="#" title=""><i class="flaticon-magnifying-glass"></i> {{$info['primary_subject_tag']}}</a></li>
                                        <li><div class="currency gci_dot_container">
                                                <span style="padding-bottom: 6px;float: right;">
                                                    <?php foreach($info->gciTags as $tag){
                                                        if(isset($tag->tag) && isset($tag->tag->tag)){
                                                            echo '<span data-toggle="tooltip" data-original-title="'.$tag->tag->tag.'" style="background-color: '.$tag->tag->tag_color.'" class="dot"></span>';
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div></li>
                                    </ul>
                                    <div class="slbtns">
                                        <div class="sharelisting">
                                            <a href="#" title=""><i class="flaticon-share"></i>{{__('backend.share')}}</a>
                                            <div class="sharebtns">
                                                <a href="#" title=""><i class="fa fa-facebook"></i></a>
                                                <a href="#" title=""><i class="fa fa-twitter"></i></a>
                                                <a href="#" title=""><i class="fa fa-instagram"></i></a>
                                                <a href="#" title=""><i class="fa fa-pinterest"></i></a>
                                                <a href="#" title=""><i class="fa fa-dribbble"></i></a>
                                                <a href="#" title=""><i class="fa fa-google"></i></a>
                                            </div>
                                        </div>
                                        <a href="#" title=""><i class="flaticon-heart"></i>{{__('backend.save')}}</a>
                                        <a href="#" title=""><i class="flaticon-note"></i>{{__('backend.add_comment')}}</a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 column">
                    <div class="bbox" id="sc1">
                        <h3>Description</h3>
                        <div class="ldesc">
                            <p>{{$info['brief_description']}}</p>
                        </div>
                    </div>

                    <div class="bbox" id="sc4">
                        <h3>1 Interaction for Video Title</h3>
                        <div class="reviewssec">
                            <div class="reviewthumb"> <img src="http://placehold.it/60x60" alt="" /> </div>
                            <div class="reviewinfo">
                                <h3>@commenter displayname</h3>
                                <span>December 12, 2017 at 8:18 am</span>
                                <ul class="listmetas justrate"><li><span class="rated">3.5</span>3 Ratings</li></ul>
                                <p>I visited here once and met the community. This video captured the essence of this place and people just great.</p>
                                <div class="rgallery">
                                    <a href="#" title=""><img src="http://placehold.it/180x115" alt="" /></a>
                                    <a href="#" title=""><img src="http://placehold.it/180x115" alt="" /></a>
                                    <a href="#" title=""><img src="http://placehold.it/180x115" alt="" /></a>
                                </div>
                                <div class="wasreview">
                                    <span><strong>Rate this interaction:</strong></span>
                                    <div class="wasreviewbtn">
                                        <a href="#" title="" class="c1"><i class="flaticon-smile"></i>Helpful 85</a>
                                        <a href="#" title="" class="c2"><i class="flaticon-thumb-up"></i>Neutral 45</a>
                                        <a href="#" title="" class="c3"><i class="flaticon-sad"></i>Wasteful :( 87</a>
                                    </div>
                                </div>
                                <div class="reviewaction">
                                    <a href="#" title=""><i class="flaticon-back"></i> Reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="listingcomment">
                        <div class="leavecomment">
                            <h3>Interact With This Video <em>(coming soon!)</em></h3>
                            <div class="upimg">
                                <span>Upload images</span>
                                <a href="#" title=""><img src="images/cloud.png" alt="" /></a>
                                <input type="file" disabled="disabled" />
                            </div>
                            <div class="urrating">
                                <span>Your Rating For This Video</span>
                                <strong>Very Good</strong>
                                <b>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </b>

                            </div>
                            <form>
                                <input disabled="disabled" placeholder="your@mail.com" type="Email">
                                <input disabled="disabled" placeholder="Title" type="text">
                                <textarea disabled="disabled" placeholder="Review"></textarea>
                                <input disabled="disabled" value="Submit Review" type="submit" style="background: #ccc;color: black;border: #2b3d51">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 column">
                    <div class="amenties listing">
                        <h3>Collaborative Networking</h3>
                        <span><i class="fa fa-exchange"> (if exists) Exchange: Service/Opportunity</i></span>
                        <span><i class="flaticon-booked"> User-Submitted ('User Submitted Collaboration' or 'Sponsored')</i></span>
                        <span><i class="flaticon-avatar"> 3 Associated Users </i></span>
                        <span><br></span>
                    </div>

                    <div class="single_map">
                        <div class="ad map" id="map" style="height: 250px">...</div>
                    </div>

                    <div class="cbusiness">
                        <h3>{{__('backend.contact_video_users', ['name1' => __('video')])}}</h3>
                        <form>
                            <label>Your Name *</label>
                            <input type="text" placeholder="Ali TUF..." />
                            <label>Your Email Address*</label>
                            <input type="text" placeholder="demo@demo.com" />
                            <label>Your Message</label>
                            <textarea placeholder="demo@demo.com"></textarea>
                            <button type="submit">Send Message</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="featureModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" id="feature-info"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        searchVideo();
    })

</script>

<?php /*
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
                    <div class="col-lg-5 column" style="margin:0px;padding: 0px;padding-left: 0px;">
                        <div>Category - <?php if(isset($info->category)){ echo $info->category->name; }; ?></div>
                        <div><?php if(!empty($info->learn_more_url)){ echo '<a target="_blank" href="'.$info->learn_more_url.'">Learn more..</a>'; }; ?></div>
                    </div>
                    <div class="col-lg-7 column">
                        <div>Submitter: <?php if(isset($info->user)){ echo '@'.'<span class="inactive_link" onclick="openProfile('.$info->user->id.')">'.$info->user->display_name.'</span>'; }; ?></div>
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


<style>
    .slick-slide{
        overflow: hidden;
        max-height: 500px;
    }

    .modal-content{
        padding: 0px !important;
        position: relative;
    }

    .modal-header{
        position: absolute;
        right: 0px;
    }
</style>
@endsection
