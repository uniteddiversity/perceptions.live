var default_zoom = $('#default_zoom').val();
var default_lat = parseFloat($('#default_lat').val());
var default_long = parseFloat($('#default_long').val());
var map = L.map( 'map', {
    center: [default_lat, default_long],
    minZoom: 2,
    zoom: parseFloat(default_zoom)
});

var popup = L.popup();
// L.tileLayer( 'https://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.{ext}', {
//     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
//     subdomains: ['a','b','c'],
//     ext: 'png'
// }).addTo( map );

// L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.{ext}', {
//     attribution: '',
//     subdomains: ['a', 'b', 'c'],
//     ext: 'png'
// }).addTo(map);
L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.{ext}', {
    attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    // attribution: '',
    subdomains: ['a', 'b', 'c'],
    ext: 'png'
}).addTo(map);


myURL = '';

var markerClusters = L.markerClusterGroup();

searchVideo();

var m;
function updateMarkers(markers){
    map.removeLayer(markerClusters);

    markerClusters = L.markerClusterGroup();
    map.addLayer( markerClusters );

    var myIcon = L.icon({
        iconUrl: myURL + '/assets/img/new-pin.png',
        iconRetinaUrl: myURL + '/assets/img/new-pin.png',
        iconSize: [45, 45],
        iconAnchor: [9, 21],
        popupAnchor: [0, -14]
    });

    var all_b = [];
    for ( var i = 0; i < markers.length; ++i )
    {
        var popup = markers[i].name;
        m = L.marker( [markers[i].lat, markers[i].lng], {icon: myIcon, id: markers[i].id} );
        m.on('click', onMarkerClick);
        markerClusters.addLayer( m );
        all_b.push(m);
        // console.log(markers[i]);
    }

    var group = new L.featureGroup(all_b);
    // map.fitBounds(group.getBounds());
    $("#loading").hide();
}

var onMarkerClick = function(e){
    $("#feature-info").html('loading...');
    console.log(e.latlng);//this.options.id
    jQuery.ajax({
        url: '/home/ajax-video-info-shared-small/'+this.options.id,
        method: 'GET'
    }).done(function (content) {
        // $("#feature-title").html("Info:");
        // $("#feature-info").html(content);
        // $("#featureModal").modal("show");
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
}

function openVideo(id, lat, long){
    // $("#feature-info").html('loading...');
    // console.log(this);//this.options.id
    jQuery.ajax({
        url: '/home/ajax-video-info-shared-small/'+id,
        method: 'GET'
    }).done(function (content) {
        // console.log(content)
        popup
            .setLatLng({lat: lat, lng: long})
            .setContent(content)
            .openOn(map);
    }).fail(function () {
        popup
            // .setLatLng(e.latlng)
            .setContent("Error with loading...")
            .openOn(map);
    });
}

// function openVideo(id){
//     $("#feature-info").html('loading...');
//     // console.log(this);//this.options.id
//     jQuery.ajax({
//         url: '/home/ajax-video-info/'+id,
//         method: 'GET'
//     }).done(function (content) {
//         $("#feature-title").html("Info:");
//         $("#feature-info").html(content);
//         $("#featureModal").modal("show");
//     }).fail(function () {
//         $("#feature-title").html("Error:");
//         $("#feature-info").html("Fail to load info");
//         $("#featureModal").modal("show");
//     });
// }

function openGroupProfile(id){
    $("#feature-info").html('loading...');
    // console.log(this);//this.options.id
    jQuery.ajax({
        url: '/home/ajax-group-info/'+id,
        method: 'GET'
    }).done(function (content) {
        $("#feature-title").html("Info:");
        $("#feature-info").html(content);
        $("#featureModal").modal("show");
    }).fail(function () {
        $("#feature-title").html("Error:");
        $("#feature-info").html("Fail to load info");
        $("#featureModal").modal("show");
    });
}

function openProfile(id){
    $("#feature-info").html('loading...');
    // console.log(this);//this.options.id
    jQuery.ajax({
        url: '/home/ajax-user-info/'+id,
        method: 'GET'
    }).done(function (content) {
        $("#feature-title").html("Info:");
        $("#feature-info").html(content);
        $("#featureModal").modal("show");
    }).fail(function () {
        $("#feature-title").html("Error:");
        $("#feature-info").html("Fail to load info");
        $("#featureModal").modal("show");
    });
}

map.addLayer( markerClusters );


/////////////////////////////////////////////////////////
function searchVideo(){
    $('#video_search_res').html('<i class="fa fa-spinner"></i> loading.....');
    $.get('/ajax/home/shared/group/'+$('#_token').val(), function( data ) {
        // console.log(data.json.original);
        if(data.content == '')
            $('#video_search_res').html('No result!');

        updateMarkers(data.json.original);
        $('#video_search_res').html(decode(data.content));

    });
}

function shareSearchVideo(){
    var $categories = $('#categories').val();
    var $primary_sub_tag = $('#primary_sub_tag').val();
    var $s_o_p = $('#s_o_p').val();
    var $gci = $('#gci').val();
    var $user_id = $('#associated_users').val();

    if($categories == 'undefined' || $categories == null){
        $categories = '';
    }

    if($primary_sub_tag == 'undefined' || $primary_sub_tag == null){
        $primary_sub_tag = '';
    }

    if($s_o_p == 'undefined' || $s_o_p == null){
        $s_o_p = '';
    }

    if($gci == 'undefined' || $gci == null){
        $gci = '';
    }

    if($user_id == 'undefined' || $user_id == null){
        $user_id = '';
    }

    $('#video_search_res').html('<i class="fa fa-spinner"></i> loading.....');
    $.get('/ajax/home/shared/group/'+$('#_token').val()+'?categories='+$categories+'&primary_sub_tag='+$primary_sub_tag+'&s_o_p='+$s_o_p+'&gci='+$gci+'&user_id='+$user_id, function( data ) {
        // console.log('new content');
        // console.log(data.json.original);
        if(data.content == '')
            $('#video_search_res').html('No result!');

        updateMarkers(data.json.original);
        $('#video_search_res').html(decode(data.content));

    });
}

$('#categories').change(function(){
    shareSearchVideo();
});

$('#primary_sub_tag').change(function(){
    shareSearchVideo();
});

$('#s_o_p').change(function(){
    shareSearchVideo();
});

$('#gci').change(function(){
    shareSearchVideo();
});

$('#associated_users').change(function(){
    shareSearchVideo();
});

function shareResetSearch(){
    $('#categories').val('');
    $('#primary_sub_tag').val('');
    $('#s_o_p').val('');
    $('#gci').val('');
    $('#associated_users').val('');
    shareSearchVideo();
}

function searchByTag(id){
    // console.log('search gcs '+id);
    $('#video_search_res').html('<i class="fa fa-spinner"></i> loading.....');
    $.get( "/home/ajax/video-search/?gcs="+id, function( data ) {
        // console.log(data.json.original);
        if(data.content == '')
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

$(document).ready(function(){
    $("#content_search_cat").change(function(){
        // console.log('searching');
        searchVideo();
    });

    if($('#_location_id').val() !== ''){
        // updateMap($('#_location_id').val());
    }

    searchVideo();

})