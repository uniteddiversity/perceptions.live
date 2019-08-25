@extends('layouts.app_inside')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Home Slider</h4>
                <div class="table-responsive">
                    @include('partials.admin-notification-partial')
                    <table class="table" id="users_llist">
                        <thead>
                        <tr>
                            <th>
                                Action
                            </th>
                            <th>
                                Side
                            </th>
                            <th>
                                Slider Title
                            </th>
                            <th>
                                Type
                            </th>
                            <th>
                                Original Name
                            </th>
                            <th>
                                Icon
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $d) <?php //dd($user); ?>
                        <tr>
                            <td>
                                <a onclick="return confirm('Are you sure you want to delete?')" href="/user/admin/delete-slider-feed/{{ uid($d['id']) }}" >Delete</a>
                            </td>
                            <td>
                                {{ $d['side'] }}
                            </td>
                            <td>
                                {{ $d['title'] }}
                            </td>
                            <td>
                                {{ $d['fk_title'] }}
                            </td>
                            <td>
                                {{ $d['type'] }}
                            </td>
                            <td>
                                <img src="/storage/{{ $d['icon'] }}" alt="Icon" height="42" width="42">
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