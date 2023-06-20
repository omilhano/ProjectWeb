<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    
<?php
include '../php/guides_config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the guide information using the ID from the database
    $query = "SELECT starting_point, way_point, end_point FROM guides WHERE id = $id";
    $result = mysqli_query($link, $query);

    $guideCount = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $startpoint = $row['starting_point'];
        $waypoint = $row['way_point'];
        $endpoint = $row['end_point'];

        echo '<div id="map-' . $guideCount . '" style="height: 400px; width: 100%; border-radius: 25px;"></div>'; // Display of the map
        $guideCount++;
    }
}
?>

<script>
var directionsService;
var geocoder;

function initMap() {
    directionsService = new google.maps.DirectionsService();
    geocoder = new google.maps.Geocoder();

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch the guide information using the ID from the database
        $query = "SELECT starting_point, way_point, end_point FROM guides WHERE id = $id";
        $result = mysqli_query($link, $query);

        $guideCount = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $startpoint = $row['starting_point'];
            $waypoint = $row['way_point'];
            $endpoint = $row['end_point'];
            $mapId = "map-" . $guideCount;

            echo 'var map' . $guideCount . ' = new google.maps.Map(document.getElementById("' . $mapId . '"), {';
            echo 'zoom: 7,';
            echo 'center: { lat: 38.736946, lng: -9.142685 }';
            echo '});';
            echo 'calcRoute(map' . $guideCount . ', "' . $startpoint . '", "' . $waypoint . '", "' . $endpoint . '");';

            $guideCount++;
        }
    }
    ?>
}

function calcRoute(map, startAddress, waypointAddress, endAddress) {
    geocodeAddress(startAddress, function(startLocation) {
        geocodeAddress(waypointAddress, function(waypointLocation) {
            geocodeAddress(endAddress, function(endLocation) {
                var startMarker = new google.maps.Marker({
                    position: startLocation,
                    map: map,
                    title: "Start"
                });

                var waypointMarker = new google.maps.Marker({
                    position: waypointLocation,
                    map: map,
                    title: "Waypoint"
                });

                var endMarker = new google.maps.Marker({
                    position: endLocation,
                    map: map,
                    title: "End"
                });

                var request = {
                    origin: startLocation,
                    destination: endLocation,
                    waypoints: [
                        {
                            location: waypointLocation,
                            stopover: true
                        }
                    ],
                    travelMode: 'DRIVING'
                };

                directionsService.route(request, function(response, status) {
                    if (status == 'OK') {
                        var directionsDisplay = new google.maps.DirectionsRenderer();
                        directionsDisplay.setMap(map);
                        directionsDisplay.setDirections(response);
                    } else {
                        alert("Directions request failed, status=" + status);
                    }
                });
            });
        });
    });
}

function geocodeAddress(address, callback) {
    geocoder.geocode({
        'address': address
    }, function(results, status) {
        if (status === 'OK') {
            callback(results[0].geometry.location);
        }
    });
}

initMap(); // Call the function to initialize the map
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI1eO1w2j3bWV_m0D4TwP9zw8TzcmVgCc&callback=initMap"
    async defer></script>



</body>
</html>
