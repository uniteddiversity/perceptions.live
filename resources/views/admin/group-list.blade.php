@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Group List</h4>
                    <div class="table-responsive">
                        <table class="table" id="users_llist">
                            <thead>
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Default Location
                                </th>
                                <th>
                                    Category
                                </th>
                                <th>
                                    Active Status
                                </th>
                                <th>
                                    Users in Group
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($groups as $group)
                                <tr>
                                    <td>
                                        {{ $group->id }}
                                    </td>
                                    <td>
                                        {{ $group->name }}
                                    </td>
                                    <td>
                                        {{ $group->category }}
                                    </td>
                                    <td>
                                        {{ $group->location }}
                                    </td>
                                    <td>
                                        {{ $group->groupStatus->name }}
                                    </td>
                                    <td>
                                        {{ (empty($group->users_count))? 0:$group->users_count }}
                                    </td>
                                    <td>
                                        <a href="/user/admin/group-edit/{{ uid($group->id) }}" >Edit</a>
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