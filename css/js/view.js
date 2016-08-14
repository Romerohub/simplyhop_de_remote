var map;
var directionsService;
var directionsDisplay;
var geocoder;

$(document).ready(function(){
    geocoder = new google.maps.Geocoder;
    directionsService = new google.maps.DirectionsService;
    directionsDisplay = new google.maps.DirectionsRenderer();
});
$(document).on('lity:open', function(event, lightbox, trigger) {
   // alert(3)
    //drow_rpute()
    setTimeout(function(){
        initMap1()

        setTimeout(function(){
            drow_rpute()

        }, 500)

    },500)

});
function initMap() {}
function initMap1() {
    /*var mapDiv = document.getElementById('map');
     var map = new google.maps.Map(mapDiv, {
     center: {lat: 44.540, lng: -78.546},
     zoom: 8
     });*/
    var latlng = new google.maps.LatLng(51.456, 10.152);
    var myOptions = {
        zoom: 8,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map-canvas"),
        myOptions);
    // console.log(map);
    map.setZoom(6);

}


function drow_rpute(){
    var waypts = [];
    directionsDisplay.setMap(null);
    //console.log("drow")


    $(".city_street_extra_list").each(function (key, val){
         console.log()
        if($(val).val().length > 0) {
            waypts.push({
                location: $(val).val() +", "+$("#t_city").val(),
                stopover: true
            });
        }
    });
//console.log(waypts)

    var start_p = $("#t_start").val()+", "+$("#t_city").val();
    var destination_p = $("#t_end").val()+", "+$("#t_city").val();

    var request = {
        origin: start_p, //точка старта
        destination: destination_p, //точка финиша
        // travelMode: google.maps.DirectionsTravelMode.DRIVING, //режим прокладки маршрута
        optimizeWaypoints: true,
        travelMode: google.maps.TravelMode.DRIVING
        // waypoints: waypts
    };

    if(waypts.length > 0){
        request.waypoints = waypts;
    }

    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        }
    });

    directionsDisplay.setMap(map);


}