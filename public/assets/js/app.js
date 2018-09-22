if(typeof(L) != "undefined"){
    if($('#video_id').val() != undefined){
        var lat = $('#video_lat').val();
        var long = $('#video_long').val();
        lat = parseFloat(lat);
        long = parseFloat(long);
        var map = L.map( 'map', {
            center: [lat, long],
            minZoom: 4,
            zoom: 4
        });
    }else{
        var map = L.map( 'map', {
            center: [10.0, 5.0],
            minZoom: 3,
            zoom: 2
        });
    }



// L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
//     subdomains: ['a','b','c']
// }).addTo( map );

    L.tileLayer( 'https://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.{ext}', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        subdomains: ['a','b','c'],
        ext: 'png'
    }).addTo( map );

    myURL = '';
    var markerClusters = L.markerClusterGroup();

    // L.marker([51.5, -0.09]).addTo(map)
    //     .bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup();

    // map.on('click', onMapClick);
    var popup = L.popup();
    searchVideo();
}

// function onMapClick(e) {
//     popup
//         .setLatLng(e.latlng)
//         .setContent("You clicked the map at " + e.latlng.toString())
//         .openOn(map);
// }

var m;
function updateMarkers(markers){
    map.removeLayer(markerClusters);

    var markerClusters2 = L.markerClusterGroup();
    map.addLayer( markerClusters2 );

    var myIcon = L.icon({
        iconUrl: myURL + '/assets/img/globe_new.png',
        iconRetinaUrl: myURL + '/assets/img/globe_new.png',
        iconSize: [29, 29],
        iconAnchor: [9, 21],
        popupAnchor: [0, -14]
    });

    var all_b = [];
    for ( var i = 0; i < markers.length; ++i )
    {
        var popup = 'abc'+markers[i].name;
        // var m = L.marker( [markers[i].lat, markers[i].lng], {icon: myIcon} )
        //     .bindPopup( popup );
        m = L.marker( [markers[i].lat, markers[i].lng], {icon: myIcon, id: markers[i].id} );
        m.on('click', onMarkerClick);
        markerClusters2.addLayer( m );
        all_b.push(m);
        console.log(markers[i]);
    }

    var group = new L.featureGroup(all_b);
    // map.fitBounds(group.getBounds());
    if($('#video_id').val() == undefined){
        map.fitBounds(group.getBounds());
    }
    // m.clearLayers();

    $("#loading").hide();

    map.addLayer( markerClusters );
}

var onMarkerClick = function(e){
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
            url: '/home/ajax-video-info/'+this.options.id,
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

function openVideo(id){
    $("#feature-info").html('loading...');
    console.log(this);//this.options.id
    jQuery.ajax({
        url: '/home/ajax-video-info/'+id,
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
    console.log(this);//this.options.id
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

function openGroupProfile(id){
    console.log('group loading');
    $("#feature-info").html('loading...');
    console.log(this);//this.options.id
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




/////////////////////////////////////////////////////////
function searchVideo(){
    $('#video_search_res').html('<i class="fa fa-spinner"></i> loading.....');

    var $search_text = $('#search_text').val();
    var $search_cat = $('#content_search_cat').val();
    var $video_id = $('#video_id').val();
    if($search_text == undefined)
        $search_text = '';
    if($search_cat == undefined)
        $search_cat = '';
    if($video_id == undefined)
        $video_id = '';

    $.get( "/home/ajax/video-search/?keyword="+$search_text+"&category_id="+$search_cat
        +"&video_id="+$video_id, function( data ) {
        console.log(data.json.original);
        if(data.content == '')
            $('#video_search_res').html('No result!');

        updateMarkers(data.json.original);
        $('#video_search_res').html(decode(data.content));

    });
}

function searchByTag(id){
    console.log('search gcs '+id);
    $('#video_search_res').html('<i class="fa fa-spinner"></i> loading.....');
    $.get( "/home/ajax/video-search/?gcs="+id, function( data ) {
        console.log(data.json.original);
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
        console.log('searching');
        searchVideo();
    });

    if($('#_location_id').val() !== ''){
        // updateMap($('#_location_id').val());
    }

    if(typeof(L) != "undefined"){
        searchVideo();
    }
})

$("#login-btn").click(function() {
    $("#loginModal").modal("show");
    $(".navbar-collapse.in").collapse("hide");
    return false;
});

$("#register-btn").click(function() {
    $("#registerModal").modal("show");
    $(".navbar-collapse.in").collapse("hide");
    return false;
});

function testFunction(id){
    if(confirm('Are you sure you want to approve this?')){
        $('#approve_'+id).html('updating...');
        jQuery.ajax({
            url: "/user/admin/ajax/approve-content/"+id,
            method: 'GET'
        }).done(function (content) {
            $('#approve_'+id).html('Activated!');
        }).fail(function () {
        });
///  /user/admin/ajax/approve-content/"+id
    }
}

function userLogin(){
    jQuery.ajax({
        url: 'user/login',
        method: 'POST',
        data: $('#login-form').serialize()
    }).done(function (response) {
        $.each(response, function(key, val){
            if(key == 'error'){
                $.each(val, function(key2, val2){
                    $('#login-form #messages').html('<div class="alert alert-danger" role="alert">'+val2+'</div>');
                })
            }else{
                $('#login-form #messages').html('<div class="alert alert-success" role="alert">'+val+'</div>');
                window.location.href = "/user/profile";
            }
        })
        // Do something with the response
    }).fail(function () {
        // Whoops; show an error.
    });
}

function userRegister(){
    jQuery.ajax({
        url: '/user/register',
        method: 'POST',
        data: $('#register-form').serialize()
    }).done(function (response) {
        $.each(response, function(key, val){
            if(key == 'error'){
                $.each(val, function(key2, val2){
                    $('#register-form #messages').html('<div class="alert alert-danger" role="alert">'+val2+'</div>');
                })
            }else{
                $('#register-form #messages').html('<div class="alert alert-success" role="alert">'+val+'</div>');
                window.location.href = "/user/profile";
            }
        })

        // Do something with the response
    }).fail(function () {
        // Whoops; show an error.
    });
}

function openVideoOnly(){
    var video_id = $('.watchvideo').data("videolink");
    console.log('working:'+video_id);
    $("#feature-info").html('loading...');
    var content = '<iframe style="width: 100%;height: 600px" frameborder="0" allowfullscreen src="'+video_id+'"></iframe>';
    $("#feature-info").html(content);
    $("#featureModal").modal("show");
}
