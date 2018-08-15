var map = L.map( 'map', {
    center: [10.0, 5.0],
    minZoom: 3,
    zoom: 2
});

// L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
//     subdomains: ['a','b','c']
// }).addTo( map );

L.tileLayer( 'https://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.{ext}', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    subdomains: ['a','b','c'],
    ext: 'png'
}).addTo( map );

// var myURL = jQuery( 'script[src$="leaf-demo.js"]' ).attr( 'src' ).replace( 'leaf-demo.js', '' );
myURL = '';



var markerClusters = L.markerClusterGroup();

function updateMap($id){
    $.getJSON("/ajax-available-videos/"+$id, function (markers) {
        var myIcon = L.icon({
            iconUrl: myURL + '/assets/img/museum.png',
            iconRetinaUrl: myURL + '/assets/img/museum.png',
            iconSize: [29, 24],
            iconAnchor: [9, 21],
            popupAnchor: [0, -14]
        });

        var all_b = [];
        for ( var i = 0; i < markers.length; ++i )
        {
            var popup = 'abc'+markers[i].name;
            // var m = L.marker( [markers[i].lat, markers[i].lng], {icon: myIcon} )
            //     .bindPopup( popup );
            var m = L.marker( [markers[i].lat, markers[i].lng], {icon: myIcon, id: markers[i].id} );
            m.on('click', onMarkerClick);
            markerClusters.addLayer( m );
            all_b.push(m);
            console.log(markers[i]);
        }

        var group = new L.featureGroup(all_b);
        map.fitBounds(group.getBounds());

        $("#loading").hide();
    });
}

$.getJSON("/ajax-available-videos", function (markers) {
    updateMarkers(markers);
});

function updateMarkers(markers){
    var myIcon = L.icon({
        iconUrl: myURL + '/assets/img/museum.png',
        iconRetinaUrl: myURL + '/assets/img/museum.png',
        iconSize: [29, 24],
        iconAnchor: [9, 21],
        popupAnchor: [0, -14]
    });

    var all_b = [];
    for ( var i = 0; i < markers.length; ++i )
    {
        var popup = 'abc'+markers[i].name;
        // var m = L.marker( [markers[i].lat, markers[i].lng], {icon: myIcon} )
        //     .bindPopup( popup );
        var m = L.marker( [markers[i].lat, markers[i].lng], {icon: myIcon, id: markers[i].id} );
        m.on('click', onMarkerClick);
        markerClusters.addLayer( m );
        all_b.push(m);
        console.log(markers[i]);
    }

    var group = new L.featureGroup(all_b);
    map.fitBounds(group.getBounds());

    $("#loading").hide();
}

var onMarkerClick = function(e){
    $("#feature-info").html('test');
    console.log(this);//this.options.id
    jQuery.ajax({
        url: '/home/ajax-video-info/'+this.options.id,
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
    $.get( "/home/ajax/video-search/?keyword="+$('#search_text').val()+"&category_id="+$('#content_search_cat').val(), function( data ) {
        console.log(data.json.original);
        updateMarkers(data.json.original);
        $('#video_search_res').html(data.content);
        if(data == '')
            $('#video_search_res').html('No result!');
    });
}

$(document).ready(function(){
    $("#content_search_cat").change(function(){
        console.log('searching');
        searchVideo();
    });

    if($('#_location_id').val() !== ''){
        updateMap($('#_location_id').val());
    }

    searchVideo();
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
