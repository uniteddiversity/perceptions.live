@extends('layouts.app_inside')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card" id="user_content_add">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Organization and contact</h4>
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
                        <form action="/user/admin/setting/organization-contact" method="post" id="submit_content" enctype='multipart/form-data'>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="form-group">
                                <label for="exampleInputEmail1">About Us(text)</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="about_us" placeholder="Text" value="{{$about_us}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">About Us(URL)</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="about_us_url" placeholder="URL" value="{{$about_us_url}}">
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Community guidelines(text)</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="community_guidelines" placeholder="Text" value="{{$community_guidelines}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Community guidelines(URL)</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="community_guidelines_url" placeholder="URL" value="{{$community_guidelines_url}}">
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Terms of service(text)</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="terms_of_service" placeholder="Text" value="{{$terms_of_service}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Terms of service(URL)</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="terms_of_service_url" placeholder="URL" value="{{$terms_of_service_url}}">
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Privacy policy(text)</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="privacy_policy" placeholder="Title" value="{{$privacy_policy}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Privacy policy(URL)</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="privacy_policy_url" placeholder="URL" value="{{$privacy_policy_url}}">
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contribute(text)</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="contribute" placeholder="Title" value="{{$contribute}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contribute(URL)</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="contribute_url" placeholder="URL" value="{{$contribute_url}}">
                            </div>

                            <hr/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact(text)</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="contact" placeholder="Title" value="{{$contact}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact(URL)</label>
                                <input type="text" class="form-control" aria-describedby="nameHelp" name="contact_url" placeholder="URL" value="{{$contact_url}}">
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('backend.submit')}}</button>
                        </form>
                </div>
            </div>
        </div>
    </div>


    @endsection