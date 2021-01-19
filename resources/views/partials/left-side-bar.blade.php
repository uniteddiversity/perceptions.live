<div id="sidebar" class="xxcol-md-5">
    <div class="sidebar-wrapper">
        <div class="panel panel-default" id="features">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('backend.uploaded_videos', ['name'=>__('video')])}}
                {{--<button type="button" class="btn btn-xs btn-default pull-right" id="sidebar-hide-btn"><i class="fa fa-chevron-left"></i></button></h3>--}}
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-8 col-md-8">
                        <input type="text" class="form-control search" placeholder="Filter" />
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <button type="button" class="btn btn-primary pull-right sort" data-sort="feature-name" id="sort-btn"><i class="fa fa-sort"></i>&nbsp;&nbsp;{{__('backend.sort')}}</button>
                    </div>
                </div>
            </div>
            <div class="sidebar-table">
                <table class="table table-hover" id="feature-list">
                    <thead class="hidden">
                    <tr>
                        <th>{{__('backend.icon')}}</th>
                    <tr>
                    <tr>
                        <th>{{__('backend.name')}}</th>
                    <tr>
                    <tr>
                        <th>{{__('backend.chevron')}}</th>
                    <tr>
                    </thead>
                    <tbody class="list"></tbody>
                </table>

                <table class="table table-hover" id="feature-list">
                    <?php if(isset($uploaded_list)){ ?>
                        @foreach ($uploaded_list as $upload)
                            <div><iframe width="230" height="200" src="<?php echo ( $upload['video']) ?>" frameborder="0" allowfullscreen></iframe></div>
                        <hr/>
                        @endforeach
                    <?php } ?>

                </table>

            </div>
        </div>
    </div>
</div>