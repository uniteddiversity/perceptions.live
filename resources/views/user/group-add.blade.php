@extends('layouts.app_inside')

@section('content')
<?php
$data['greeting_message_to_community'] = isset($group['greeting_message_to_community']) ? $group['greeting_message_to_community'] : '';
$data['name'] = isset($group['name']) ? $group['name'] : '';
$data['description'] = isset($group['description']) ? $group['description'] : '';
$data['current_mission'] = isset($group['current_mission']) ? $group['current_mission'] : '';
$data['experience_knowledge_interests'] = isset($group['experience_knowledge_interests']) ? $group['experience_knowledge_interests'] : '';
$data['default_location'] = isset($group['default_location']) ? $group['default_location'] : '';
$data['category_id'] = isset($group['category_id']) ? $group['category_id'] : '';
$data['learn_more_url'] = isset($group['learn_more_url']) ? $group['learn_more_url'] : '';

$group['gci_tags'] = isset($group['gci']) ? $group['gci']->toArray() : [];
$data['grater_community_intention_ids'] = isset($group['gci_tags']) ? array_column($group['gci_tags'], 'group_tag_id') : array();
$data['contact_user_id'] = isset($group['contact_user_id']) ? $group['contact_user_id'] : '';
$data['status'] = isset($group['status']) ? $group['status'] : '';
$data['proof_images'] = isset($group['proofOfGroup']) ? $group['proofOfGroup'] : array();
$data['avatar_images'] = isset($group['groupAvatar']) ? $group['groupAvatar'] : array();
$data['id'] = isset($group['id']) ? $group['id'] : '';
$group['experience_kno'] = isset($group['experienceKnowledge']) ? $group['experienceKnowledge']->toArray() : [];
$data['experience_kno'] = isset($group['experience_kno']) ? array_column($group['experience_kno'], 'group_tag_id') : array();
$data['group_acting_roles'] = isset($group['actingRoles']) ? array_column(($group['actingRoles'])->toArray(), 'group_tag_id') : array();

//    dd($data);
?>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card form-card">
    <div class="card-body">
      <div class="submitprcption">
        <h4 class="card-title" style="margin-bottom: 10px; text-align: center;">{{__('backend.group_profile_settings', ['name', __('group')])}}
        </h4>
        <div class="pagedesc" align="center">
          <p>Present your community to the world.
          </p>
          <p>
            <em>Should you encounter any errors we encourage you to
              <a href="/contact-us">let us know</a>. Thanks!
            </em>
          </p>
      <div class="table-responsive">
        <?php /*
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
                        */ ?>
        @include('partials.admin-notification-partial')
       {{-- <div class="form-header">
          <h4 class="card-title m-0">Create a Group</h4>
      </div> --}}

        <form action="/user/post-group-add" method="post" enctype='multipart/form-data'>
          <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
          <?php if (!empty($data['id'])) { ?>
            <input type="hidden" name="id" id="id" value="{{ uid($data['id']) }}" />
          <?php } ?>
            <div class="formdesctext">
                <strong>Community Information</strong>
                Painting a brief picture of what your group offers the network.
            </div>
            <div class="form-content">
          <div class="form-group">
            <label for="exampleInputEmail1">Greeting Message to PRCPTION community</label>
            <input type="text" class="form-control" aria-describedby="nameHelp" name="greeting_message_to_community" placeholder="Greeting Message to PRCPTION community" value="{{ old('greeting_message_to_community',$data['greeting_message_to_community']) }}">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" aria-describedby="nameHelp" name="name" placeholder="Name" value="{{ old('name',$data['name']) }}">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <textarea class="form-control" placeholder="Description" rows="5" name="description">{{ old('description',$data['description']) }}</textarea>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Default Location</label>
            <input type="text" class="form-control" placeholder="Default Location" aria-describedby="nameHelp" name="default_location" placeholder="First Name" value="{{ old('default_location',$data['default_location']) }}">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">URL to Your Project</label>
            <input type="text" class="form-control" placeholder="Learn More Url" aria-describedby="nameHelp" name="learn_more_url" placeholder="Learn More Url" value="{{ old('learn_more_url',$data['learn_more_url']) }}">
          </div>
            <div class="form-group">
                <label for="accept_tos">{{__('backend.group_avatar', ['name', __('group')])}}</label>
                <input class="form-control" type="file" name="group_avatar" />
            </div>

            <?php foreach ($data['avatar_images'] as $img) { ?>
            <li><a target="_blank" href="/storage/<?php echo $img->url ?>"><?php echo $img->name ?></a> </li>
            <?php } ?>


            <div class="formdesctext">
                <strong>Connections and Collaborations
                </strong>
                What is your group all about? What does it offer?
            </div>
            <div class="form-content">
            <div class="form-group">
                <label for="exampleInputEmail1">Current Mission</label>
                <textarea class="form-control" placeholder="Current Mission" rows="5" name="current_mission">{{ old('current_mission',$data['current_mission']) }}</textarea>
            </div>
            {{--<div class="form-group">--}}
            {{--<label for="exampleInputEmail1">Experience Knowledge Interests</label>--}}
            {{--<textarea class="form-control" placeholder="Experience Knowledge Interests" rows="5" name="experience_knowledge_interests">{{ old('experience_knowledge_interests',$data['experience_knowledge_interests']) }}</textarea>--}}
            {{--</div>--}}


            <div class="form-group">
                <label for="skills">Experience knowledge interests (add if not exist)</label>
                <select class="form-control multi-select2-with-tags-max5" id="experience_kno" multiple name="experience_kno[]">
                    @foreach($experience_knowledge_tags as $m)
                        <option value="{{base64_encode($m['id'])}}" <?php if (in_array($m['id'], old('experience_kno', $data['experience_kno']))) {
                            echo 'selected';
                        } ?>>{{$m['tag']}}</option>
                    @endforeach
                </select>
            </div>
          <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control  multi-select2" id="category_id" name="category_id">
              <option value="">Select</option>
              @foreach($categories as $category)
              <option value="{{$category->id}}" <?php if (old('category_id', $data['category_id']) == $category->id) {
                                                  echo 'selected';
                                                } ?>>{{$category->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="exampleSelect1">Greater Community Intention</label>
            <select class="form-control multi-select2-max3" id="grater_community_intention_id" multiple name="grater_community_intention_ids[]">
              @foreach($gci_tags as $m)
              <option value="{{base64_encode($m['id'])}}" <?php if (in_array(base64_encode($m['id']), old('grater_community_intention_ids', [])) || in_array($m['id'], old('grater_community_intention_ids', $data['grater_community_intention_ids']))) {
                                                            echo 'selected';
                                                          } ?>>{{$m['tag']}}</option>
              @endforeach
            </select>

          </div>


              <div class="formdesctext">
                <strong>Proof & Verification
                </strong>
                When applicable, the documentation you provide here will help the community determine your group's authenticity.
              </div>


              <div class="form-group">
            <label for="accept_tos">Proof of Group Involvement</label>
            <input class="form-control" type="file" name="proof_of_group[]" />
            <input class="form-control" type="file" name="proof_of_group[]" />
            <input class="form-control" type="file" name="proof_of_group[]" />

            <?php foreach ($data['proof_images'] as $img) { ?>
              <li><a target="_blank" href="/storage/<?php echo $img->url ?>"><?php echo $img->name ?></a> </li>
            <?php } ?>
          </div>

              <div class="form-group">
                <label for="exampleSelect1">Contact User</label>
                <select class="form-control  multi-select2" id="exampleSelect1" name="contact_user_id">
                  <option value="">Select</option>
                  @foreach($user_list as $user)
                    <option value="{{$user->id}}" <?php if (old('contact_user_id', $data['contact_user_id']) == $user->id) {
                      echo 'selected';
                    } ?>>{{$user->first_name}} ({{$user->email}})</option>
                  @endforeach
                </select>
              </div>

          <?php if (!empty($data['id'])) { ?>
              <div class="form-group">
                <label for="accept_tos">By checking this box, I confirm that I have read and I agree to the <a href="https://docs.perceptiontravel.tv/legal-docs/terms-of-service" target="_blank">Terms of Service</a>:  </label>
                &nbsp;&nbsp;<input style="height:22px; margin-left:5px;" type="checkbox" name="accept_tos" id="accept_tos" value="1"/>
              </div>
          <?php } ?>


          <div class="form-group">
            <?php if (Auth::user()->is('admin')) { ?>
              <label for="status">Change Status</label>
              <select class="form-control" id="status" name="status">
                @foreach($status as $st)
                <option value="{{$st->id}}" <?php if (old('status', $data['status']) == $st->id) {
                                                echo 'selected';
                                              } ?>>{{$st->name}}</option>
                @endforeach
              </select>
            <?php } ?>
          </div>

          <div class="form-group">
            @if(config('app.g_recaptcha_key'))
            <div class="g-recaptcha" data-sitekey="{{config('app.g_recaptcha_key')}}">
            </div>
            @endif
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary">{{__('backend.submit')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
    <style>
      .table-responsive .card-title {
        padding: 20px 40px;
        margin-bottom: 30px;
        border-bottom: 2px solid #e6defc;
      }
      form {
        margin-bottom: 0;
      }
      .table-responsive .form-group {
        float: none !important;
      }

      .form-footer {
        padding: 20px 40px;
        background: #e6defc;
        text-align: left;
      }

      .form-footer button {
        margin: 0 !important;
        float: none
      }
      .pagedesc {
        font-size: 20px;
        font-family: 'Open Sans', sans-serif;
        line-height: 1em;
        padding-bottom: 20px;
      }

      div.formdesctext {
        font-size: 14.4px !important;;
        line-height: 20px !important;;
        font-family: 'Open Sans', sans-serif !important;
        font-style: normal !important;;
        text-align: left;
        color: #797979;
        margin-bottom: 20px;
        padding: 20px 40px;
        border-bottom: 2px solid #e6defc;
      }

      div.formdesctext strong {
        margin: auto;
        font-family: 'Open Sans', sans-serif;
        font-size: 26px;
        font-weight: 600;
        line-height: 1.1;
        color: #4214c7;
        display: block;
        margin-bottom: 10px
      }

      div.submitprcption {
        width: 50%;
        margin: auto;
      }

      form {
        margin-bottom: 0
      }

      .form-content {
        padding-bottom: 20px;
        border-bottom: 2px solid #e6defc;
      }

      .form-content .form-group {
        float: none;
      }

      .form-footer {
        padding: 20px 40px;
        background: #e6defc;
        text-align: left;
      }

      .form-footer button {
        margin: 0 !important;
        float: none
      }

      .form-group .custom_select {
        height: auto;
        float: none;
      }

      .form-group .custom_select::before {
        bottom: 18px;
        top: auto
      }

      a {
        color: #2B0D82 !important;
      }

      a:hover {
        color: #2b0bae !important;
      }
      @media only screen and (max-width: 576px) {
        .main-body .card {
          width: 100%;
        }
      }
    </style>

@endsection
@section('scripts')
  <script>
      var el = document.getElementById('loading');
      el.remove(); // Removes the div with the 'div-02' id
  </script>
@endsection