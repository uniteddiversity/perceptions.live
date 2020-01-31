@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Comments</h4>
                    <div class="table-responsive">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <div class="comments_outer admin_comments">
                            <div class="comments_inner">
                                @include('partials.commentsDisplayAdmin', ['comments' => $comments, 'fk_id' => $fk_id])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection