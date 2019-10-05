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

