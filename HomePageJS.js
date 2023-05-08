 $(".slideshow").cycle({fx:"scrollHorz"}); //adiciona efeito de scroll horizontal para a esquerda

     $(document).ready(function() {
          $(".slideshow").cycle();
     });
     var directionsDisplay;
 var directionsService = new google.maps.DirectionsService();

 function initMap() {
 directionsDisplay = new google.maps.DirectionsRenderer();
 var lisbon = new google.maps.LatLng(38.736946, -9.142685);
 var mapOptions = {
     zoom: 7,
     center: lisbon
 }
 var map = new google.maps.Map(document.getElementById('map'), mapOptions);
 directionsDisplay.setMap(map);
 calcRoute(map);
 }

 function calcRoute(map) {
 var start = new google.maps.LatLng(38.736946, -9.142685);
 var waypoint = new google.maps.LatLng( 40.416775,  -3.703790);
 var end = new google.maps.LatLng(41.390205, 2.154007)
 
 var startMark = new google.maps.Marker({
     position: start,
     map: map,
     title: "start"
 });
 /*var waypointMark = new google.maps.Marker({
     position: waypoint,
     map: map,
     title: "waypoint"
     });*/

 
 var waypoints = [
 {
   location: waypoint,
   stopover: true,
 },
 ];
 var endMark = new google.maps.Marker({
     position: end,
     map: map,
     title: "end"
 });
 var request = {
     origin: start,
     waypoints : waypoints,
     destination: end,
     travelMode: 'DRIVING'
 };

 directionsService.route(request, function(response, status) {
     if (status == 'OK') {
     directionsDisplay.setDirections(response);
     } else {
     alert("directions request failed, status=" + status)
     }
     });
     }
     google.maps.event.addDomListener(window, "load", initMap);
