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


// Get the modal
var modal = document.getElementById("file_modal");

// Get the button that opens the modal
var btn = document.getElementById("login-button");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function () {
modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
   modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
   if (event.target == modal) {
       modal.style.display = "none";
   }
   }
// Checks if password corresponds to the user
function checkPassword() {
var username = document.getElementById("username").value;
var password = document.getElementById("password").value;
if (password === "mypassword") {
   // correct password, do something
} else {
   // incorrect password, update error message
   var errorElement = document.getElementById("password-error");
   errorElement.textContent = "Incorrect password. Please try again.";
}
}
// This part removes the text from the modal when it gets closed
$('#password-error').text('');

$(".close").click(function() {
$('#password-error').text('');
$("#file_modal").css("display", "none");
});
document.getElementById("close-modal").addEventListener("click", function() {
document.getElementById("username").value = "";
document.getElementById("password").value = "";
});