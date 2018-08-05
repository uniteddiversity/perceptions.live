@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Users Data</h4>
                    <div class="table-responsive">
                        <table class="table" id="users_llist">
                            <thead>
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    First name
                                </th>
                                <th>
                                    Last name
                                </th>
                                <th>
                                    Role
                                </th>
                                <th>
                                    Active Status
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->first_name }}
                                    </td>
                                    <td>
                                        {{ $user->last_name }}
                                    </td>
                                    <td>
                                        {{ $user->role->name }}
                                    </td>
                                    <td>
                                        {{ $user->status->name }}
                                    </td>
                                    <td>
                                        <a href="/user/admin/user-edit/{{ $user->id }}" >Edit</a>
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