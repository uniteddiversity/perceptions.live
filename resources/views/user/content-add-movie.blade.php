@extends('layouts.app')

@section('content')
<?php
$data = array();
//dd($step_1_data);
$step_1_data['title'] = isset($step_1_data['title'])? $step_1_data['title']: '';
$step_1_data['location'] = isset($step_1_data['location'])? $step_1_data['location']: '';
$step_1_data['captured_date'] = isset($step_1_data['captured_date'])? $step_1_data['captured_date']: '';
$step_1_data['brief_description'] = isset($step_1_data['brief_description'])? $step_1_data['brief_description']: '';
?>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card" style="box-shadow:none;">
        <div class="card-body">
            <div class="submitprcption">
                <div class="col-lg-4">
                    <div class="box purple" style="padding-top:40px;">
                        <h5>Submit your <b>PRCPTION</b></h5>
                        <p style="margin:0;">Use this page to submit your own content that supports the exposure of cooperative, smiling people endeavors worldwide. We'll review it, get back to you if necessary, and it will become a part of the network!</p>
                        <span class="mobile_show">Read More</span>
                        <div class="more" style="margin-top:20px;">
                            <p>To keep our community thriving, and so there are no misunderstandings should your submission be rejected, we kindly ask that you refresh yourself with our <a href="https://perceptiontravel.tv/user-guidelines">User Guidelines</a> and <a href="https://perceptiontravel.tv/terms-of-service">Terms of Service</a> before using this form.</p>
                            <hr />
                            <p style="color:#4214c7;"><b>Should you encounter any errors we encourage you to <a href="https://perceptiontravel.tv/community-feedback">let us know</a>. Thanks!</b></p>
                        </div>

                    </div>
                </div>

                <div class="pagedesc col-lg-8" style="float:right;">

                    <div class="breadcrumbs">
                        <div class="line"></div>
                        <ul>
                            <li class="active" id="st1">

                                <span style="left:55px;"><i class="far fa-file-video"></i><b>1</b></span>
                            </li>
                            <li id="st2">
                                <span style="left:192px;"><i class="fas fa-video"></i><b>2</b></span>
                            </li>
                            {{--<li id="st3">--}}

                                {{--<span style="left:72px;"><i class="fas fa-users"></i><b>3</b></span>--}}
                            {{--</li>--}}
                            <li id="st3">
                                <span style="left:100%; margin-left:127px;"><i class="fas fa-filter"></i><b>4</b></span>
                            </li>
                        </ul>
                    </div>

                    <div class="table-responsive">

                        @if ($errors->any())
                        <div style="padding:20px;background:rgb(248,248,248); border-bottom:2px solid #e6defc;">
                            <div class="alert alert-danger">
                                <ul>
                                    <?php //dd($errors) ?>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <form action="/content-post-public" method="post" id="submit_content" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                            <?php if($step == 'step1'){ ?>
                            <div class="step" id="st1">
                                <!-- top text -->
                                <div class="text_top">
                                    <span><i class="far fa-file-video"></i><b>2</b></span>
                                    <h4>Media Info</h4>
                                    <p>In this section, please fill in the basic details about your PRCPTION submission.</p>
                                </div>
                                <div class="form-group">
                                    <label>Title of this PRCPTION</label>
                                    <input type="text" class="form-control" aria-describedby="nameHelp" name="title" placeholder="Title" value="{{ old('title', $step_1_data['title']) }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea">Location (City, Country)</label>
                                    <input type="text" class="form-control" id="leaflet_search_addr" aria-describedby="nameHelp" name="location" placeholder="Location" value="{{ old('location', $step_1_data['location']) }}">
                                </div>
                                <div class="form-group">
                                    <label for="video_id">Date of PRCPTION</label>
                                    <input type="text" autocomplete="off" class="form-control datepicker" aria-describedby="nameHelp" name="captured_date" placeholder="Captured Date" value="{{ old('captured_date', $step_1_data['captured_date']) }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleTextarea">Brief Description</label>
                                    <textarea name="brief_description" class="form-control" id="exampleTextarea" rows="3">{{ old('brief_description', $step_1_data['brief_description']) }}</textarea>
                                </div>
                                <input type="hidden" value="step2" name="next_step" />
                                <!-- btns -->
                                <div class="btn_outer">
                                    {{--<a href="#" class="btn"><i class="fas fa-long-arrow-alt-left"></i> Back</a>--}}
                                    <button type="submit" class="btn click" onclick="form.submit();">Next Step <i class="fas fa-long-arrow-alt-right"></i></button>
                                </div>
                                <!-- btns -->
                            </div>
                            <?php } ?>

                            <!-- step -->
                            <?php if($step == 'step2'){ ?>
                            <?php foreach($step_1_data as $key => $val){
                                echo '<input type="hidden" value="'.$val.'" name="'.$key.'" />';
                            }?>
                            <div class="step" id="st2">
                                <?php /*
                                <div>
                                    <form class="loginform" id="login-form" action="/user/login">
                                        <input type="hidden" name="_token" value="{{ Session::token() }}" />
                                        <div class="text_top">
                                            <span><i class="far fa-file-video"></i><b>2</b></span>
                                            <h4>Media Info</h4>
                                            <p>Login or register.</p>
                                        </div>

                                        <div id="messages"></div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Username or Email Address *</label>
                                            <input type="text" class="form-control" aria-describedby="nameHelp" name="email" placeholder="Email" value="{{ old('email') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="Password">Password</label>
                                            <input class="form-control" type="password" placeholder="Password" name="password" />
                                        </div>
                                        <div class="btn_outer">
                                            <button type="button" onclick="userLogin()">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                                <div>
                                    <form id="register-form" action="/user/register">
                                        <div id="messages"></div>
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <div class="form-group">
                                            <label>Email *</label>
                                            <input type="text" id="email" name="email" placeholder="Email" />
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="form-group">
                                            <label>Display Name *</label>
                                            <input type="text" id="display_name" name="display_name" placeholder="Display Name" />
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="form-group">
                                            <label>Location</label>
                                            <input type="text" id="location" name="location" placeholder="Location">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" id="password" name="password" placeholder="Password" />
                                            <i class="fas fa-unlock-alt"></i>
                                        </div>
                                        <div class="form-group">
                                            <label>Retype Password</label>
                                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Retype Password" />
                                            <i class="fas fa-unlock-alt"></i>
                                        </div>

                                        <p class="terms-label">
                                            <input name="accept_tos" value="1" id="cb6" type="checkbox"><label for="cb6" style="color:black;">I’ve read and accept the terms &amp; conditions *</label>
                                        </p>
                                        <div class="btn_outer">
                                            <button type="button" onclick="userRegister()">Sign Up</button>
                                        </div>

                                    </form>
                                </div>
                                */ ?>
                                <div class="container package_list">
                                    <div class="row">
                                        <div class="text_top">
                                            <span><i class="fas fa-address-book"></i></span>
                                            <h4>Package List</h4>
                                            <p>These are the packages involve.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 package pak1">
                                            <div>
                                                <h3>Free</h3>
                                                <span>$10 per row minute</span>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>720p/1080p</li>
                                                    <li><=3 minutes final video</li>
                                                    <li>7 minute raw footage</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 package pak1">
                                            <div>
                                                <h3>Basic</h3>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>720p/1080p</li>
                                                    <li><=5 minutes final video</li>
                                                    <li>20 minute raw footage</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 package pak1">
                                            <div>
                                                <h3>Plus</h3>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>720p/1080p</li>
                                                    <li><=15 minutes final video</li>
                                                    <li>45 minute raw footage</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 package pak1">
                                            <div>
                                                <h3>Pro</h3>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <input type="hidden" value="step3" name="next_step" />
                                <input type="hidden" id="redirect_to" value="/content-add-public?step=step1" />
                                <!-- btns -->
                                <div class="btn_outer">
                                    <a href="/content-add-public?step=step1" class="btn"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                                    <?php if($user_id == 0){ ?>
                                    <a href="#" id="login-or-register" onclick="openLoginRegister()" class="btn click" style="float:right;">I understand. Continue <i class="fas fa-long-arrow-alt-right"></i></a>
                                    <?php }else{ ?>
                                    <button type="submit" class="btn click" onclick="form.submit();">I understand. Continue <i class="fas fa-long-arrow-alt-right"></i></button>
                                    <?php } ?>

                                </div>
                            </div>
                            <?php } ?>

                            <!-- step -->

                        <?php if($user_id > 0){ ?>
                            <?php if($step == 'step3'){ ?>

                            <?php foreach($step_1_data as $key => $val){
                                echo '<input type="hidden" value="'.$val.'" name="'.$key.'" />';
                            }?>

                            <div class="step" id="st3">
                                <!-- top text -->
                                <div class="text_top">
                                    <span><i class="fas fa-users"></i><b>1</b></span>
                                    <h4>Continue with movie editor</h4>
                                    <p>In this section, please choose the individuals and groups who have been a part of this PRCPTION. If no name appears, press 'enter' to add them as a shadow profile--don't worry, you can let them know and they can <a href="/claim-profile">claim their empty profile</a> whenever they want.</p>
                                </div>

                                <!-- btns -->
                                <div class="btn_outer">
                                    <input type="hidden" value="submit" name="next_step" />
                                    <a href="/content-add-public?step=step2" class="btn"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                                    <button href="#" class="btn click" onclick="form.submit();">Go to Movie Editor <i class="fas fa-long-arrow-alt-right"></i></button>
                                </div>
                                <!-- btns -->
                            </div>
                            <?php } ?>
                        <?php } ?>


                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
        $('.drag input').change(function() {
            $('.drag p').text(this.files.length + " file(s) selected");
        });
    });
</script>
<script>
    $('#submitted_footage').change(function() {
        if ($("option#2:selected").length) {
            // do something here
            $('.url').addClass('hidden');
        } else {

            $('.url').removeClass('hidden');
        }
    })

</script>
<!-- script for mobile "show more" text -->
<script>
    $('.card .box .mobile_show').on('click', function(e) {
        $('.more').toggleClass("active"); //you can list several class names 
        $(this).toggleClass("hidden"); //you can list several class names 
        e.preventDefault();
    });

</script>
<!-- script for steps to toggle them hide/activate -->
<!-- maybe add script to verify if input fields are completed before going to next step -->
<script>
    $('.table-responsive .btn_outer .btn.click').on('click', function(e) {
        $(this).parent().parent().toggleClass("hidden"); //you can list several class names 
        var num = $(this).attr('rel');
        $('.step' + '#' + num).removeClass("hidden");
        $('.breadcrumbs ul li').removeClass("active");
        $('.breadcrumbs ul li' + '#' + num).addClass("active");
        e.preventDefault();
    });
    $('.table-responsive .btn_outer button').on('click', function(e) {
        $(this).parent().parent().toggleClass("hidden"); //you can list several class names 
        var num = $(this).attr('rel');
        $('.step' + '#' + num).removeClass("hidden");
        $('.breadcrumbs ul li').removeClass("active");
        $('.breadcrumbs ul li' + '#' + num).addClass("active");
        e.preventDefault();
    });

</script>


<style>
    .pagedesc {
        font-size: 20px;
        font-family: questrial;
        line-height: 1em;
        padding-bottom: 20px;
    }

    div.formdesctext {
        color: slategray;
        font-size: 14px;
        font-style: italic;
        font-family: questrial;
        line-height: 1em;
        padding-bottom: 20px;
    }

    hr {
        padding-top: 15px;
        padding-bottom: 10px;
    }

    div.formdesctext strong {
        font-weight: 800;
        color: #2B0D82;
        font-size: 20px;
        margin: auto;
        display: block;
        padding-bottom: 10px;
    }

    div.submitprcption {
        width: 50%;
        margin: auto;
    }

    .form-group {
        padding-top: 10px;
    }

    a {
        color: #2B0D82 !important;
    }

    a:hover {
        color: #2b0bae !important;
    }

</style>
@endsection
<script>
    //        var el = document.getElementById('loading');
    //        el.remove(); // Removes the div with the 'div-02' id

</script>
