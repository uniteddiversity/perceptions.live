$(document).ready(function(){
    $('#display_name_for_claim').change(function(){
        jQuery.ajax({
            url: '/ajax/associated_videos_by_user_id/'+$(this).val(),
            method: 'GET'
        }).done(function (response) {
            console.log(response);
            $('#claim_video_profile').html('');
            response.forEach(function(element) {
                $('#claim_video_profile').append($('<option>', {
                    value: element.id,
                    text: element.title
                }));
            });
            // Do something with the response
        }).fail(function () {
            // Whoops; show an error.
        });
    })
})


$(document).ready(function() {
    $('.multi-select2').select2();

    $('.multi-select2-with-tags').select2({tags: true});

    $('.multi-select2-max3').select2({maximumSelectionLength: 3});

    $('.multi-select2-with-tags-max3').select2({tags: true, maximumSelectionLength: 3});

    $('.multi-select2-with-tags-max5').select2({tags: true, maximumSelectionLength: 5});

    $('#user-assign-group').change(function(){console.log('vl '+$(this).val());
        document.location.href = '/user/admin/user-to-group-add/'+$(this).val();
    })

    $('#user-assign-group-groupadmin').change(function(){console.log('vl '+$(this).val());
        document.location.href = '/user/group-admin/user-to-group-add/'+$(this).val();
    })

    $("#is_exchange").change(function(){ console.log('changing..');
        if($(this).is(':checked')){console.log('checked..');
            $('#exchange_enabled').css('visibility','visible');
        }else{
            $('#exchange_enabled').css('visibility','hidden');
        }
    })
});


function addr_search() {
    var inp = document.getElementById("leaflet_search_addr");
    $.getJSON('https://nominatim.openstreetmap.org/search?format=json&limit=5&q=' + inp.value, function(data) {
        var items = [];

        $.each(data, function(key, val) {
            bb = val.boundingbox;
            console.log(bb[0]+'     '+bb[2]);
            $('#lat_val').val(bb[0]);
            $('#long_val').val(bb[2]);
        });
        $('#submit_content').submit();
        return true;
    });
}

function addr_search_new() {
    var inp = document.getElementById("leaflet_search_addr");
    $.getJSON('https://nominatim.openstreetmap.org/search?format=json&limit=5&q=' + inp.value, function(data) {
        var items = [];

        $.each(data, function(key, val) {
            bb = val.boundingbox;
            console.log(bb[0]+'     '+bb[2]);
            $('#lat_val').val(bb[0]);
            $('#long_val').val(bb[2]);
        });
        return true;
    });
}


$(window).on('load',function(){
    "use strict";

    $('.page-loading').fadeOut();

});

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
        },
        dataType: 'json'
    });
}

function deleteComment($id){
    let $token = $('#csrf-token').val();
    if(confirm('Are you sure you want to delete?')){
        $.ajax({
            type: "POST",
            url: "/user/admin/delete-comment",
            data: {id : $id, _token: $token},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(){
                $('#comment_'+$id).hide();
                $('#content_reply_'+$id).hide();
            },
            dataType: 'json'
        });
    }

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
    // $('#'+$id)
    // $('#'+$id).hide();
    // $('#'+$id).find('.comment_box').val('');
}