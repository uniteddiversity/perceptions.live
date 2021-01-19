<?php
$data = array();
$data['proof_images'] = array();

?>

<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{__('backend.claim_info')}}</h4>
                <div class="table-responsive">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <form action="/claim-profile-post" method="post" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="form-group">
                                <label for="display_name">{{__('backend.display_name')}}</label>
                                <?php /*<select class="form-control" id="display_name_for_claim" name="display_name">
                                    <option value="">Select Display Name</option>
                                    @foreach($user_list as $user)
                                        <option value="{{$user->id}}" >{{$user->display_name}}</option>
                                    @endforeach
                                </select>*/ ?>
                                <select class="display-name-select-ajax form-control" name="display_name">
                                    <option>{{__('backend.search_here')}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="video_profile">{{__('backend.select_video_profile_for_selected_user', ['name' => __('video')])}}</label>
                                <select class="form-control multi-select2" multiple id="claim_video_profile" name="claim_video_profile[]">

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="confirm_selected_content">{{__('backend.confirm_involvement_in_video', ['name' => __('video')])}}:</label>
                                <input type="checkbox" name="confirm_selected_content" id="confirm_selected_content" value="1" />
                            </div>

                            <div class="form-group">
                                <label for="additional_comments">{{__('backend.additional_comments_on_lost_videos', ['name' => __('video')])}}</label>
                                <textarea class="form-control" placeholder="Additional comments, (lost videos, requests, etc)" rows="5" name="additional_comments">{{ old('additional_comments') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('backend.email')}}</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                            </div>

                            <div class="form-group">
                                <label for="accept_tos">{{__('backend.proof_of_identity_of_video', ['name' => __('video')] )}}</label>
                                <input class="form-control" type="file" multiple name="proof_of_work[]" />

                                <?php foreach($data['proof_images'] as $img){ ?>
                                <li><a target="_blank" href="/storage/<?php echo $img->url ?>"><?php echo $img->name ?></a> </li>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label for="password">{{__('backend.terms_of_service')}}:</label>
                                <input type="checkbox" name="accept_tos" id="accept_tos" value="1" />
                            </div>


                            <button type="submit" class="btn btn-primary">{{__('backend.submit')}}</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
<div style="clear: both"></div>