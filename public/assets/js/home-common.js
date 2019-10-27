//user info popup
$('body').on('click', '#user_group_paging a', function(){
    let $user_id = $('#popup_user_id').val();
    let $page_id = $(this).data("page");
    $.ajax({
        url: "/home/ajax-user-info-groups/"+ $user_id +'?page='+ $page_id,
        context: document.body
    }).done(function(data) {
        $('#user-info-popup_group').html(data);
    });
})

$('body').on('click', '#user_video_paging a', function(){
    let $user_id = $('#popup_user_id').val();
    let $page_id = $(this).data("page");
    $.ajax({
        url: "/home/ajax-user-info-video/"+ $user_id +'?page='+ $page_id,
        context: document.body
    }).done(function(data) {
        $('#user-info-popup_video').html(data);
    });
})

//group info popup
$('body').on('click', '#group_user_paging a', function(){
    let $user_id = $('#popup_group_id').val();
    let $page_id = $(this).data("page");
    $.ajax({
        url: "/home/ajax-group-info-users/"+ $user_id +'?page='+ $page_id,
        context: document.body
    }).done(function(data) {
        $('#group-info-popup_user').html(data);
    });
})

$('body').on('click', '#group_video_paging a', function(){
    let $user_id = $('#popup_group_id').val();
    let $page_id = $(this).data("page");
    $.ajax({
        url: "/home/ajax-group-info-video/"+ $user_id +'?page='+ $page_id,
        context: document.body
    }).done(function(data) {
        $('#group-info-popup_video').html(data);
    });
})


function advance_search(){
    $('#video_search_res').html('<i class="fa fa-spinner"></i> loading.....');

    let $location_text = $('#ads_location').val();
    let $search_cat = $('#ads_category').val();
    let $date_from = $('#docalendar').val();
    let $date_to = $('#docalendar2').val();
    let $search_text = $('#ads_keyword').val();
    let $gci = $('#ads_intentions').val();
    let $sorting_tag = $('#ads_sorting_tag').val();
    let $exchange_for = [];
    $('.exchange_for:checked').each(function($i){
        $exchange_for.push($(this).attr('value'));
    })
    let $video_id = '';

    if($search_text == undefined)
        $search_text = '';
    if($search_cat == undefined)
        $search_cat = '';
    if($video_id == undefined)
        $video_id = '';

    $.get( "/home/ajax/video-search/?text="+$search_text+"&category_id="+$search_cat+"&gcs="+$gci+"&date_from="+$date_from+"&date_to="+$date_to
        +"&sorting_tag="+$sorting_tag+"&location_text="+$location_text+"&exchange_for="+$exchange_for, function( data ) {
        console.log(data.json.original);
        if(data.content == '')
            $('#video_search_res').html('No result!');

        updateMarkers(data.json.original);
        $('#video_search_res').html(decode(data.content));

    });

    $('.openfilters').removeClass("active");
    $('.mlfilter-sec').removeClass('active');
    $('.ml-listings').removeClass('active');
}

function loadFilters(id, type){
    console.log('id and cat ',id, type)
    let $search_cat = '';
    let $gci = '';
    let $group_id = '';
    let $search_text = '';

    if(type == 'gci'){
        $gci = id;
    }else if(type == 'category'){
        $search_cat = id;
    }else if (type == 'group'){
        $group_id = id;
    }

    $.get( "/home/ajax/video-search/?text="+$search_text+"&category_id="+$search_cat+"&gcs="+$gci+"&group_id="+$group_id, function( data ) {
        console.log(data.json.original);
        if(data.content == '')
            $('#video_search_res').html('No result!');

        updateMarkers(data.json.original);
        $('#video_search_res').html(decode(data.content));

    });
}

function showTextbox($id){
    $('.reply_comment').hide();
    $('#'+$id).show();
}

function hideTextbox($id){
    $('.reply_comment').hide();
    $('#'+$id)
    $('#'+$id).hide();
    $('#'+$id).find('.comment_box').val('');
}

function postComments($fk_id, $table, $parent, $text_field){
    let text = $('#'+$text_field).val();
    let $token = $('#csrf-token').val();
    $('#forcomment_'+$parent).show();
    $('#comment_text_0').val('')
    $.ajax({
        type: "POST",
        url: "/user/home/post-comment",
        data: {parent:$parent, comment:text, fk_id: $fk_id, table: $table, _token: $token},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function($data){
            if($data.data.parent_id != '0'){
                $('#content_reply_'+$data.data.parent_id).append($data.view);
                hideTextbox('forcomment_'+$data.data.parent_id);
            }else{
                $('.comments_inner').append($data.view);
                hideTextbox('forcomment_'+$data.data.parent_id);
            }
            jQuery("time.timeago").timeago();
            $('.no-comment-yet-'+$fk_id).hide();
            console.log('$fk_id',$fk_id)
        },
        dataType: 'json'
    });
}


function collapseComments($id, obj){
    $('#'+$id).toggle('slow');
    if($(obj).find('i').hasClass('fa-arrow-up')){
        $(obj).find('i').removeClass('fa-arrow-up');
        $(obj).find('i').addClass('fa-arrow-down');
    }else{
        $(obj).find('i').removeClass('fa-arrow-down');
        $(obj).find('i').addClass('fa-arrow-up');
    }
    console.log('collopsing', $id)
}
