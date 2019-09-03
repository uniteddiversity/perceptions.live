//user info popup
$('body').on('click', '#user_group_paging a', function(){
    let $user_id = $('#popup_user_id').val();
    let $page_id = $(this).data("page");
    $.ajax({
        url: "/home/ajax-user-info-group/"+ $user_id +'?page='+ $page_id,
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