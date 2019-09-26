@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">My Claim Requests</h4>
                    @include('partials.admin-notification-partial')
                    <div class="table-responsive">
                        <table class="table" id="users_llist">
                            <thead>
                            <tr>
                                <th>
                                    Action
                                </th>
                                <th>
                                    Requester Email
                                </th>
                                <th>
                                    Requesting Profile
                                </th>
                                <th>
                                    Display name
                                </th>
                                <th>
                                    Status
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>
                                        @if($d->status == 3)
                                        <a href="/user/user/delete-profile-claim-request/{{ uid($d->id) }}" onclick="return confirm('Are you sure you want to delete the request?')" >Delete</a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $d->email }}
                                    </td>
                                    <td>
                                        <?php if(isset($d->needUser)){
                                            echo $d->needUser->email;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if(isset($d->needUser)){
                                            echo $d->needUser->display_name;
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        @if($d->status == 1)
                                            Approved
                                        @elseif($d->status == 3)
                                            Pending
                                        @elseif($d->status == 4)
                                            Deleted
                                        @endif
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection