@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Location List</h4>
                    <div class="table-responsive">
                        <table class="table" id="users_llist">
                            <thead>
                            <tr>
                                <th>
                                    Location
                                </th>
                                <th>
                                    Active Users
                                </th>
                                <th>
                                    Videos (open)
                                </th>
                                <th>
                                    Associated Users
                                </th>
                                <th>
                                    Associated Groups
                                </th>
                                <th>
                                    Moderator
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($location_list as $location)
                                <tr>
                                    <td>
                                        {{ $location['location'] }}
                                    </td>
                                    <td>
                                        {{ $location['display_names'] }}
                                    </td>
                                    <td>
                                        {{ $location['active_videos'] }}
                                    </td>
                                    <td>
                                        {{ $location['associate_users'] }}
                                    </td>
                                    <td>
                                        {{ $location['associate_groups'] }}
                                    </td>
                                    <td>
                                        {{ $location['moderators'] }}
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