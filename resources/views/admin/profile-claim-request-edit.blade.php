@extends('layouts.app_inside')

<?php
$data = $data[0];
?>
@section('content')
<?php //dd($data) ?>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Video Edit Packages</h4>
            <div class="table-responsive">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        <?php //dd($errors) ?>
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


                <div class="table-responsive">
                            <form action="/user/admin/edit-profile-claim-request/{{uid($data->id)}}" method="post" enctype='multipart/form-data'>
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                <div class="form-group">
                                    <label for="display_name">Display name to claim: </label>
                                    <?php /* <select class="form-control" id="display_name_for_claim" name="display_name">
                  <option value="">select display name</option>
                  @foreach($user_list as $user)
                      <option value="{{$user->id}}" >{{$user->display_name}}</option>
                  @endforeach
              </select> */ ?>
                                    <select class="display-name-select-ajax form-control" name="display_name">
                                        <option>Search Here</option>
                                        <?php if(isset($data['fk_id'])){  ?>
                                            <option value="{{$data['fk_id']}}" selected="selected">{{$data->needUser->display_name}}</option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="video_profile">Related videos: </label>
                                    <select class="form-control multi-select2" multiple id="claim_video_profile_admin" name="claim_video_profile[]">
                                        <?php foreach($data->associatedContent as $k => $p){  ?>
                                            <option value="{{$p->fk_id}}" selected="selected">{{$p->content->title}}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="accept_tos">Proof of Identity </label>
                                    <input class="form-control" type="file" multiple name="proof_of_work[]" />

                                    <?php
                                    foreach($data->proof as $k => $p){
                                        echo '<img width="100" src="/storage/'.$p->url.'" />';
                                    }
                                    ?>
                                </div>

                                <div class="form-group">
                                    <label for="additional_comments">Additional Information</label>
                                    <textarea class="form-control" placeholder="(Name, location, organization, participation)" rows="5" name="additional_comments">{{ old('additional_comments',$data->comments) }}</textarea>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="email">E-mail Address</label>
                                    <input type="text" class="form-control" name="email" id="email" value="{{$data->email}}" >
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-submit">Submit</button>
                                </div>
                            </form>
                        </div>

            </div>
        </div>
    </div>
</div>


@endsection