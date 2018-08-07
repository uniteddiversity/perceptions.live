@extends('layouts.app_inside')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add User</h4>
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
                        <form action="/user/admin/post-group-add" method="post" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="form-group">
                                <label for="exampleInputEmail1">Greeting Message to PRCPTION community</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="greeting_message_to_community" placeholder="Greeting Message to PRCPTION community" value="{{ old('greeting_message_to_community') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="name" placeholder="Name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea class="form-control" placeholder="Description" rows="5" name="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Current Mission</label>
                                <textarea class="form-control" placeholder="Current Mission" rows="5" name="current_mission">{{ old('current_mission') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Experience Knowledge Interests</label>
                                <textarea class="form-control" placeholder="Experience Knowledge Interests" rows="5" name="experience_knowledge_interests">{{ old('experience_knowledge_interests') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Default Location</label>
                                <input type="text" class="form-control" placeholder="Default Location" aria-describedby="nameHelp" name="default_location" placeholder="First Name" value="{{ old('default_location') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Learn More Url</label>
                                <input type="text" class="form-control" placeholder="Learn More Url" aria-describedby="nameHelp" name="learn_more_url" placeholder="Learn More Url" value="{{ old('learn_more_url') }}">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control  multi-select2" id="category_id" name="category_id">
                                    <option value="">Select</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect1">Contact User</label>
                                <select class="form-control  multi-select2" id="exampleSelect1" name="contact_user_id">
                                    <option value="">Select</option>
                                    @foreach($user_list as $user)
                                    <option value="{{$user->id}}">{{$user->first_name}} ({{$user->email}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="accept_tos">Proof of Group Involvement</label>
                                <input class="form-control" type="file" name="proof_of_group[]" />
                                <input class="form-control" type="file" name="proof_of_group[]" />
                                <input class="form-control" type="file" name="proof_of_group[]" />
                            </div>
                            <div class="form-group">
                                <label for="accept_tos">Group Avatar</label>
                                <input class="form-control" type="file" name="group_avatar" />
                            </div>
                            <div class="form-group">
                                <label for="accept_tos">Accept Terms of Service?</label>
                                &nbsp;&nbsp;<input type="checkbox" name="accept_tos" id="accept_tos" value="1" checked />
                            </div>



                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>



    @endsection
    <script>
        var el = document.getElementById('loading');
        el.remove(); // Removes the div with the 'div-02' id
    </script>