@extends('layouts.app_inside')

<?php
$data = $data[0];
?>
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Claim request info</h4>
                    <div class="table-responsive">
                        <table>
                            <tr class="table">
                                <th>Email</th>
                                <td>{{$data->email}}</td>
                            </tr>
                            <tr class="table">
                                <th>Claiming Profile</th>
                                <td>
                                    <table class="table">
                                        <tr>
                                            <th>Name</th>
                                            <td>{{$data->needUser->first_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Display Name</th>
                                            <td>{{$data->needUser->display_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{$data->needUser->email}}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="table">
                                <th>Proof</th>
                                <td>
                                    <div class="col-4">
                                        <?php
                                        foreach($data->proof as $k => $p){
                                            echo '<img width="500" src="/storage/'.$p->url.'" />';
                                        }
                                        ?>
                                    </div>


                                </td>
                            </tr>
                            <tr class="table">
                                <th>Related Work</th>
                                <td>
                                    <div class="col-4">
                                        <?php
                                        foreach($data->associatedContent as $k => $p){?>
                                        <a href="/user/admin/video-edit/{{uid($p->claim_profile_request_id)}}" target="_blank">{{$p->content->title}}</a><br/>
                                        <?php }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="table">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>


<!--                        <div class="form-group">-->
<!--                            <button type="button" class="btn btn-primary" name="approve">Approve</button>-->
<!--                            <button type="button" class="btn btn-primary" name="delete">Delete</button>-->
<!--                        </div>-->
                        <div class="row">
                            <div class="col-1">
                                <button type="button" class="btn btn-primary" name="approve">Approve</button>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-primary" name="delete">Delete</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection