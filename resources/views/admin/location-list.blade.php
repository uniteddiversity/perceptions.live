@extends('layouts.app_inside')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{__('backend.location_list')}}</h4>
                    <div class="table-responsive">
                        <table class="table" id="users_llist">
                            <thead>
                            <tr>
                                <th>
                                    {{__('backend.location')}}
                                </th>
                                <th>
                                    {{__('backend.active_users', ['name' => __('user')])}}
                                </th>
                                <th>
                                    {{__('backend.videos_open', ['name' => __('video')])}}
                                </th>
                                <th>
                                    {{__('backend.associated_users', ['name' => __('user')])}}
                                </th>
                                <th>
                                    {{__('backend.associated_groups', ['name' => __('group')])}}
                                </th>
                                <th>
                                    {{__('backend.moderator')}}
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
                                        <?php
                                        $display_names = explode(',', $location['display_names']);
                                        $links = array();
                                        foreach($display_names as $name){
                                            $display_names_p = explode('-', $name);
                                            $display_name = isset($display_names_p[1])? $display_names_p[1] : '';
                                            $user_id = isset($display_names_p[0])? $display_names_p[0] : 0;
                                            $links[] = '<span onclick="openProfile('.$user_id.')" class="inactive_link">'.$display_name.'</span>';
                                        }
                                        ?>
                                        <?php echo implode(', ', $links); ?>
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
                                        <?php
                                        $display_names = explode(',', $location['moderators']);
                                        $links = array();
                                        foreach($display_names as $name){
                                            $display_names_p = explode('-', $name);
                                            $display_name = isset($display_names_p[1])? $display_names_p[1] : '';
                                            $user_id = isset($display_names_p[0])? $display_names_p[0] : 0;
                                            $links[] = '<span onclick="openProfile('.$user_id.')" class="inactive_link">'.$display_name.'</span>';
                                        }
                                        ?>
                                        <?php echo implode(', ', $links); ?>
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