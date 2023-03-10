var model_links = [];
var model_links_current_pos = 0;
var showed_markers = null;

var model_first_url = window.location.href
$('#featureModal').on('hidden.bs.modal', function () {
    console.log('first url ',model_first_url)
    window.history.pushState("object or string", "Title", model_first_url);
})

$('#featureModal').on('shown.bs.modal', function (e) {
    // model_first_url = window.location.href
    // console.log('first url ',model_first_url)
})

if (typeof (L) != "undefined") {
    var southWest = L.latLng(-89.98155760646617, -180),
        northEast = L.latLng(89.99346179538875, 180);
    var bounds = L.latLngBounds(southWest, northEast);
}
$(document).ready(function(){
    var default_zoom = $('#default_zoom').val();
    console.log('zoom 222222222222222 ',default_zoom);
})
if (typeof (L) != "undefined") {

    if ($('#video_id').val() != undefined) {
        var lat = $('#video_lat').val();
        var long = $('#video_long').val();
        lat = parseFloat(lat);
        long = parseFloat(long);
        var map = L.map('map', {
            center: [lat, long],
            minZoom: 4,
            zoom: 4,
            maxBoundsViscosity: 1.0
        });
    } else {
        var default_zoom = $('#default_zoom').val();
        var default_location_lat = $('#default_location_lat').val();
        var default_location_long = $('#default_location_long').val();

        if(default_zoom == ''){
            default_zoom = 5
        }

        if(default_location_lat == '' || default_location_long == ''){
            default_location = [10.0, 5.0]
        }else{
            default_location = [default_location_lat, default_location_long]
        }

        var map = L.map('map', {
            center: default_location,
            minZoom: 3,
            zoom: parseInt(default_zoom),//needs to chanage
            maxBoundsViscosity: 1.0
        });

        // map.panTo(new L.LatLng(default_location_lat, default_location_long));
    }



    // L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    //     subdomains: ['a','b','c']
    // }).addTo( map );

    L.control
        .locate({
            locateOptions: {
                maxZoom: 9,
                enableHighAccuracy: true
            },
            flyTo: true,
            returnToPrevBounds: true,
            showCompass: false,
            drawCircle: false,
            drawMarker: true,
            icon: 'custom'
        })
        .addTo(map);


    L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.{ext}', {
        attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        // attribution: '',
        subdomains: ['a', 'b', 'c'],
        ext: 'png'
    }).addTo(map);


    myURL = '';
    var markerClusters = L.markerClusterGroup({
        showCoverageOnHover: false,
        spiderLegPolylineOptions: {
            weight: 0,
            opacity: 0
        }
    });

    // L.marker([51.5, -0.09]).addTo(map)
    //     .bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup();

    // map.on('click', onMapClick);
    var popup = L.popup();
    // searchVideo();
}

// function onMapClick(e) {
//     popup
//         .setLatLng(e.latlng)
//         .setContent("You clicked the map at " + e.latlng.toString())
//         .openOn(map);
// }

var m;
function updateMarkers(markers) {
    // map.removeLayer(markerClusters);
    markerClusters.clearLayers();

    function onLocationFound(e) {
        searchVideoWithUserLocation();
    }


    map.on("locationfound", onLocationFound)


    // var markerClusters2 = L.markerClusterGroup({
    //     showCoverageOnHover: false,
    //     spiderLegPolylineOptions: {
    //         weight: 0,
    //         opacity: 0
    //     }
    // });
    // map.addLayer(markerClusters2);

    var myIcon = L.icon({
        iconUrl: myURL + '/assets/img/new-pin.png',
        iconRetinaUrl: myURL + '/assets/img/new-pin.png',
        iconSize: [45, 45],
        iconAnchor: [9, 21],
        popupAnchor: [0, -14]
    });

    var all_b = [];
    for (var i = 0; i < markers.length; ++i) {
        var popup = 'abc' + markers[i].name;
        // var m = L.marker( [markers[i].lat, markers[i].lng], {icon: myIcon} )
        //     .bindPopup( popup );
        m = L.marker([markers[i].lat, markers[i].lng], { icon: myIcon, id: markers[i].id });
        m.on('click', onMarkerClick);
        markerClusters.addLayer(m);
        all_b.push(m);
        // console.log(markers[i]);
    }

    let group = new L.featureGroup(all_b);
    // map.fitBounds(group.getBounds());
    if ($('#video_id').val() == undefined) {
        map.fitBounds(group.getBounds());
    }
    // m.clearLayers();

    $("#loading").hide();

    map.addLayer(markerClusters);
    //Disableing map from running out of screen
    map.setMaxBounds(bounds);
    map.on('drag', function () {
        map.panInsideBounds(bounds, { animate: false });
    });

    map.on("zoomend", function () {
        let zoom = map.getZoom();
        console.log(zoom);
        if (zoom <= 12 && zoom >= 9) {
            markerClusters.disableClustering();
        } else {
            markerClusters.enableClustering();
        }
    });
}

var onMarkerClick = function (e) {
    // $("#feature-info").html('loading...');
    //     // console.log(this);//this.options.id
    //     // jQuery.ajax({
    //     //     url: '/home/ajax-video-info/'+this.options.id,
    //     //     method: 'GET'
    //     // }).done(function (content) {
    //     //     $("#feature-title").html("Info:");
    //     //     $("#feature-info").html(content);
    //     //     $("#featureModal").modal("show");
    //     // }).fail(function () {
    //     //     $("#feature-title").html("Error:");
    //     //     $("#feature-info").html("Fail to load info");
    //     //     $("#featureModal").modal("show");
    //     // });

    $("#feature-info").html('loading...');
    console.log(this);//this.options.id
    jQuery.ajax({
        url: '/home/ajax-video-info-small/' + this.options.id,
        method: 'GET'
    }).done(function (content) {
        popup
            .setLatLng(e.latlng)
            .setContent(content)
            .openOn(map);
    }).fail(function () {
        popup
            .setLatLng(e.latlng)
            .setContent("Error with loading...")
            .openOn(map);
    });
    // popup
    //     .setLatLng(e.latlng)
    //     .setContent("You clicked the map atxxxxxxxxxx " + e.latlng.toString())
    //     .openOn(map);
}

function claimProfile(no_history) {
    // if(no_history !== true)
    //     updateModelFunction('claimProfile', id);

    $("#feature-info").html('loading...');
    console.log(this);//this.options.id
    jQuery.ajax({
        url: '/claim-profile-clean',
        method: 'GET'
    }).done(function (content) {
        $("#feature-title").html("Info:");
        $("#feature-info").html(content);
        $("#featureModal").modal("show");
        $('[data-toggle="tooltip"]').tooltip();
    }).fail(function () {
        $("#feature-title").html("Error:");
        $("#feature-info").html("Fail to load info");
        $("#featureModal").modal("show");
    });
}

function openVideo(id, no_history) {
    if (no_history !== true)
        updateModelFunction('openVideo', id);

    $("#feature-info").html('loading...');
    console.log(this);//this.options.id
    jQuery.ajax({
        url: '/home/ajax-video-info/' + id,
        method: 'GET'
    }).done(function (content) {
        $("#feature-title").html("Info:");
        $("#feature-info").html(content);
        $("#featureModal").modal("show");
        $('[data-toggle="tooltip"]').tooltip();
        $('.uploadBtnWrap').css('display', 'none');
    }).fail(function () {
        $("#feature-title").html("Error:");
        $("#feature-info").html("Fail to load info");
        $("#featureModal").modal("show");
    });
}

jQuery(document).ready(function() {
    jQuery("time.timeago").timeago();
    
});

function openProfile(id, no_history) {
    if (no_history !== true)
        updateModelFunction('openProfile', id);

    $("#feature-info").html('loading...');
    console.log(this);//this.options.id
    jQuery.ajax({
        url: '/home/ajax-user-info/' + id,
        method: 'GET'
    }).done(function (content) {
        $("#feature-title").html("Info:");
        $("#feature-info").html(content);
        $("#featureModal").modal("show");

        $('[data-toggle="tooltip"]').tooltip();
    }).fail(function () {
        $("#feature-title").html("Error:");
        $("#feature-info").html("Fail to load info");
        $("#featureModal").modal("show");
    });
}

function openGroupProfile(id, no_history) {
    if (no_history !== true)
        updateModelFunction('openGroupProfile', id);

    console.log('group loading');
    $("#feature-info").html('loading...');
    console.log(this);//this.options.id
    jQuery.ajax({
        url: '/home/ajax-group-info/' + id,
        method: 'GET'
    }).done(function (content) {
        $("#feature-title").html("Info:");
        $("#feature-info").html(content);
        $("#featureModal").modal("show");
        $('[data-toggle="tooltip"]').tooltip();
    }).fail(function () {
        $("#feature-title").html("Error:");
        $("#feature-info").html("Fail to load info");
        $("#featureModal").modal("show");
    });
}


function navigateOnMap(lat, long) {
    console.log("lat " + lat + "   Long  " + long);
    map.panTo(new L.LatLng(parseFloat(lat), parseFloat(long)));
}

/////////////////////////////////////////////////////////
function searchVideo() {
    $('#video_search_res').html('<i class="fa fa-spinner"></i> loading.....');

    var $search_text = $('#search_text').val();
    var $search_cat = $('#content_search_cat').val();
    var $content_sorting = $('#content_sorting').val();
    var $video_id = $('#video_id').val();
    if ($search_text == undefined)
        $search_text = '';
    if ($search_cat == undefined)
        $search_cat = '';
    if ($video_id == undefined)
        $video_id = '';
    if ($content_sorting == undefined)
        $content_sorting = '';

    $.get("/home/ajax/video-search/?keyword=" + $search_text + "&category_id=" + $search_cat+ "&sorting=" + $content_sorting
        + "&video_id=" + $video_id, function (data) {
            // console.log(data.json.original);
            if (data.content == '')
                $('#video_search_res').html('No result!');
            showed_markers = data.json.original;
            updateMarkers(data.json.original);
            // console.log(data.content);
            $('#video_search_res').html(decode(data.content));

        });
}

/////////////////////////////////////////////////////////
function searchVideoWithUserLocation() {
    $('#video_search_res').html('<i class="fa fa-spinner"></i> loading.....');

    var $search_text = $('#search_text').val();
    var $search_cat = $('#content_search_cat').val();
    var $video_id = $('#video_id').val();
    if ($search_text == undefined)
        $search_text = '';
    if ($search_cat == undefined)
        $search_cat = '';
    if ($video_id == undefined)
        $video_id = '';


    if (showed_markers) {
        let markers = showed_markers.filter((marker) => {
            return map.getBounds().contains([marker.lat, marker.lng]);
        });
        let ids = markers.map(marker => marker.id).join();

        $.get("/home/ajax/show-current-feed/?keyword=" + $search_text + "&category_id=" + $search_cat
            + "&video_id=" + $video_id + "&ids=" + ids, function (data) {
                if (data.content == '')
                    $('#video_search_res').html('No result!');
                console.log(123);
                // let new_data = data.json.original;
                // new_data = new_data.filter((marker) => {
                //     return map.getBounds().contains([marker.lat, marker.lng]);
                // });

                $('#video_search_res').html(decode(data.content));
            });
    }

}

function searchByTag(id) {
    console.log('search gcs ' + id);
    $('#video_search_res').html('<i class="fa fa-spinner"></i> loading.....');
    $.get("/home/ajax/video-search/?gcs=" + id, function (data) {
        console.log(data.json.original);
        if (data.content == '')
            $('#video_search_res').html('No result!');

        updateMarkers(data.json.original);
        $('#video_search_res').html(decode(data.content));

    });
}

function resetSearch() {
    $('#search_text').val('');
    $('#content_search_cat').val('');
    searchVideo();
}

function decode(str) {
    var e = document.createElement('div');
    e.innerHTML = str;
    return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
}

$(document).ready(function () {
    $("#content_search_cat").change(function () {
        console.log('searching');
        searchVideo();
    });

    if ($('#_location_id').val() !== '') {
        // updateMap($('#_location_id').val());
    }

    if (typeof (L) != "undefined") {
        searchVideo();
    }
    $('#featureModal').on('hidden.bs.modal', function (e) {
        $('.uploadBtnWrap').css('display', 'block');
    })
})

$("#login-btn").click(function () {
    $("#loginModal").modal("show");
    $(".navbar-collapse.in").collapse("hide");
    return false;
});

function openLoginRegister() {
    $('.popupsec').fadeIn();
    $('html').addClass('no-scroll');
};

$("#register-btn").click(function () {
    $("#registerModal").modal("show");
    $(".navbar-collapse.in").collapse("hide");
    return false;
});

function testFunction(id) {
    if (confirm('Are you sure you want to approve this?')) {
        $('#approve_' + id).html('updating...');
        jQuery.ajax({
            url: "/user/admin/ajax/approve-content/" + id,
            method: 'GET'
        }).done(function (content) {
            $('#approve_' + id).html('Activated!');
        }).fail(function () {
        });
        ///  /user/admin/ajax/approve-content/"+id
    }
}

function userLogin() {
    jQuery.ajax({
        url: '/user/login',
        method: 'POST',
        data: $('#login-form').serialize()
    }).done(function (response) {
        $.each(response, function (key, val) {
            if (key == 'error') {
                $.each(val, function (key2, val2) {
                    $('#login-form #messages').html('<div class="alert alert-danger" role="alert">' + val2 + '</div>');
                })
            } else {
                $('#login-form #messages').html('<div class="alert alert-success" role="alert">' + val + '</div>');
                let $redirect_to = $('#redirect_to').val();
                if ($redirect_to == '' || typeof $redirect_to === "undefined") {
                    window.location.href = "/user/user-profile";
                } else {
                    window.location.href = $redirect_to;
                }

            }
        })
        // Do something with the response
    }).fail(function () {
        // Whoops; show an error.
    });
}

function userRegister() {
    $('.disable_loading').css('display', 'block');
    $('.register_button').attr("disabled", true);
    jQuery.ajax({
        url: '/user/register',
        method: 'POST',
        data: $('#register-form').serialize()
    }).done(function (response) {
        $('.disable_loading').css('display', 'none');
        $('.register_button').attr("disabled", false);
        $.each(response, function (key, val) {
            if (key == 'error') {
                $.each(val, function (key2, val2) {
                    $('#register-form #messages').html('<div class="alert alert-danger" role="alert">' + val2 + '</div>');
                })
            } else {
                $('.popupsec').hide();
                $.alert({
                    title: 'Email has sent!',
                    content: val,
                });
            }
        })

        // Do something with the response
    }).fail(function () {
        // Whoops; show an error.
    });
}

function openVideoOnly() {
    var video_id = $('.watchvideo').data("videolink");
    console.log('working:' + video_id);
    $("#feature-info").html('loading...');
    var content = '<iframe style="width: 100%;height: 600px" frameborder="0" allowfullscreen src="' + video_id + '"></iframe>';
    $("#feature-info").html(content);
    $("#featureModal").modal("show");
}

setInterval(updateLastActive, 10000); // Time in milliseconds

function updateLastActive() {
    jQuery.ajax({
        url: '/user/user-last-active',
        method: 'GET',
    }).done(function (response) {
    }).fail(function () {
        // Whoops; show an error.
    });
}


//bootrap model back and foward buttons
$("body").on('hidden.bs.modal', function (e) {
    console.log('close working');
    model_links = [];
    model_links_current_pos = 0;
    var $videoEl = $('.modal-body').find('iframe');
    $videoEl.attr('src', $videoEl.attr('src'));
    // put your default event here
});

function modalBack() {
    model_links_current_pos -= 1;
    invokeModelAction(model_links[model_links_current_pos - 1]);
    updateModelButtons();
}

function modalFoward() {
    model_links_current_pos += 1;
    invokeModelAction(model_links[model_links_current_pos - 1]);
    updateModelButtons();
}

function updateModelFunction(action, value) {
    model_links.push([action, value]);
    model_links_current_pos++;
    updateModelButtons();
}

function updateModelButtons() {
    if (model_links.length > model_links_current_pos)
        $('.model-foward').show();
    else
        $('.model-foward').hide();


    if (model_links_current_pos > 1) {
        $('.model-back').show();
        // $('.model-foward').hide();
    } else {
        $('.model-back').hide();
    }

    console.log('current pos ' + model_links_current_pos + '   model length ' + model_links.length)
    if (model_links_current_pos < 2 && model_links.length < 2) {
        $('.model-back').hide();
        $('.model-foward').hide();
    }
}

function invokeModelAction(actions) {
    window[actions[0]](actions[1], true);
    console.log(actions[0] + '   ' + actions[1]);

    updateModelButtons();
}
//bootstrap model back and foward buttons


//lazy loaded table
$(document).ready(function () {
    // $('#lazy-loaded-table').DataTable( {
    //     // serverSide: true,
    //     // ordering: false,
    //     // searching: false,
    //     ajax: '/user/admin/group-content-list-ajax/19',
    //     scrollY: 300,
    //     deferRender:true,
    //     paging: true,
    //     // scroller:true,
    //     scroller: {
    //         loadingIndicator: true
    //     }
    // } );
    var data_list_id = $('#data_list_id').val();
    $("#lazy-loaded-table").dataTable({
        "scrollCollapse": true,
        "serverSide": true,
        // "ordering": true,
        // "searching": true,
        "lengthChange": true,
        "ajax": {
            "url": '/user/admin/group-content-list-ajax/' + data_list_id,
            "type": "GET",
        },
        "scroller": {
            "loadingIndicator": true
        },
        "deferRender": true,
        "dom": "rtiS",
        "scrollY": "600px",
        "length": 10,
        "columns": [
            { "data": "action" },
            { "data": "title" },
            { "data": 'submitted_by' },
            { "data": 'status' },
            { "data": 'url' },
            { "data": 'email' },
            { "data": 'location' },
            { "data": 'updated_at' }
        ]
    });
});

function displayVideoContentUpload() {
    if ($("#submitted_footage").val() == 'yes') {
        $('#submit_footage_form').show();
    } else {
        $('#submit_footage_form').hide();
    }
}
// if (select2)
    $('.content-type-select-ajax').select2({
        ajax: {
            // url: '/user/admin/search-content-type/ajax/',
            url: function(){
                return '/user/admin/search-content-type/ajax/type/'+  $('#slider_type').val()
            },
            dataType: 'json',

            // data: function() {
            //     var myValue = $(this).val();
            //     return JSON.stringify({variable: myValue})
            // },
            data: function (term, page) {
                // page is the one-based page number tracked by Select2
                return {
                    "type":$('#slider_type').val(),
                    //search term
                    "q": term,
                    // page size
                    "_per_page": 30,
                    // page number
                    "_page": page,
                };
            },
            initSelection: function (data) {
                console.log('selected option ', data);
            },
            templateResult: function (data) {
                // console.log('selected option ', data);
                //     var $result = $("<span></span>");
                //     $result.text(data.text);
                //     if (data.newOption) {
                //         $result.append(" <em>(new)</em>");
                //     }
                //     return $result;
            },
            processResults: function (response) {
                // return {
                //     results: response
                // };

                let results = [];
                $.each(response, function (index, data) {
                    results.push({
                        id: data.type +'-'+ data.id,
                        text: data.text + ' (' + data.type + ')',
                        type: data.type
                    });
                });

                return {
                    results: results
                };
            }
        }
    });

$('.map-sharing-ajax-users').select2({
    ajax: {
        url: function(){
            return '/home/ajax/user-search-list/groups/'+  $('.select2-ajax-groups').val()
        },
        dataType: 'json',

        // data: function() {
        //     var myValue = $(this).val();
        //     return JSON.stringify({variable: myValue})
        // },
        data: function (term, page) {
            // page is the one-based page number tracked by Select2
            return {
                "type":$('#slider_type').val(),
                //search term
                "q": term,
                // page size
                "_per_page": 30,
                // page number
                "_page": page,
            };
        },
        initSelection: function (data) {
            console.log('selected option ', data);
        },
        templateResult: function (data) {
            // console.log('selected option ', data);
            //     var $result = $("<span></span>");
            //     $result.text(data.text);
            //     if (data.newOption) {
            //         $result.append(" <em>(new)</em>");
            //     }
            //     return $result;
        },
        processResults: function (response) {
            // return {
            //     results: response
            // };

            let results = [];
            // console.log('responce is ',response);
            $.each(response.results, function (index, data) {
                results.push({
                    id: data.id,
                    text: data.text,
                    // type: data.type
                });
            });

            return {
                results: results
            };
        }
    }
});

$('.content-type-select-ajax').on('select2:select', function (e) {
    let data = e.params.data;
    $('#fk_id').val(data.id);
    $('#type').val(data.type);
});

/*ZOHEB FUNCTION*/
function openSideBarMenu(btn) {
    $('#arrowMapWrapper').addClass('active');
    $('body').addClass('openSideBar_ml-filterslide');
}
function closeSideBarMenu(btn) {
    $('#arrowMapWrapper').removeClass('active');
    $('body').removeClass('openSideBar_ml-filterslide');
}



$('.display-name-select-ajax').select2({
    ajax: {
        url: '/home/list-display-names/ajax',
        dataType: 'json',
        data: function (term, page) {
            // page is the one-based page number tracked by Select2
            return {
                "q": term,
                "_per_page": 30,
                "_page": page,
            };
        },
        initSelection: function (data) {
            console.log('selected option ', data);
        },
        templateResult: function (data) {
        },
        processResults: function (response) {
            let results = [];
            $.each(response, function (index, data) {
                results.push({
                    id: data.id,
                    text: data.text,
                    // text: data.text + ' ('+data.email+')',
                    type: data.type
                });
            });

            return {
                results: results
            };
        },
    }
});

$('.display-name-select-ajax').on('select2:select', function (e) {
    let data = e.params.data;
    videosForUser(data.id)
});

$('.select2-ajax-content').select2({
    ajax: {
        url: '/home/ajax/video-search-list',
        dataType: 'json'
        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
    }
});

// if($('.display-name-select-ajax').val() != ''){
//     // videosForUser($('.display-name-select-ajax').val())
// }

$('#claim_video_profile_admin').select2({
    ajax: {
        url: function(){
            return '/ajax/associated_videos_by_user_id/' +$('.display-name-select-ajax').val()
        },
        dataType: 'json',
        data: function (term, page) {
            // page is the one-based page number tracked by Select2
            return {
                "q": term,
                "_per_page": 30,
                "_page": page,
            };
        },
        initSelection: function (data) {
            console.log('selected option ', data);
        },
        templateResult: function (data) {
        },
        processResults: function (response) {
            let results = [];
            $.each(response, function (index, data) {
                results.push({
                    id: data.id,
                    text: data.text,
                    // text: data.text + ' ('+data.email+')',
                    type: data.type
                });
            });

            return {
                results: results
            };
        },
    }
})

function videosForUser(user_id) {
    jQuery.ajax({
        url: '/ajax/associated_videos_by_user_id/' + user_id,
        method: 'GET'
    }).done(function (response) {
        console.log(response);
        $('#claim_video_profile').html('');
        response.forEach(function (element) {
            $('#claim_video_profile').append($('<option>', {
                value: element.id,
                text: element.title
            }));
        });
        // Do something with the response
    }).fail(function () {
        // Whoops; show an error.
    });
}
