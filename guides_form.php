<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="guides_submit.php" method="POST" enctype="multipart/form-data">
        <p>
            <label for="username">Username</label>
            <input type="text" name="username">
        </p>
        <p>
            <label for="date">Date</label>
            <input type="date" name="date">
        </p>
        <p>
            <label for="country">Title</label>
            <input type="text" name="country" placeholder="Country(s)">
        </p>
        <p>
            <label for="location">Subtitle</label>
            <input type="text" name="location" placeholder="Specific Location(s)">
        </p>
        <p>
            <label style = "position: relative; bottom: 50px"  for="content">Description</label>
            <textarea style = "width: 33%; height: 100px; resize: vertical; padding: 10px;" type="text" name="content" maxlength="400"></textarea>
        </p>
        <p>
            <label for="days">Nº of Days</label>
            <input type="number" name="days">
        </p>
        <p>
            <label for="km">Nº of Kilometers</label>
            <input type="number" name="km">
        </p>
        <p>
            <label for="cities">Nº of Cities</label>
            <input type="number" name="cities">
        </p>
        <p>
            <label for="image">Select Image File:</label>
            <input type="file" name="image">
        </p>

        <h3>Map Section:</h3>

        <p>
            <label for="startpoint">Start Point:</label>
            <input type="text" name="startpoint" placeholder="First Destination">
        </p>
        <p>
            <!-- <div id="waypointContainer">
                <div class="waypoint-input"> -->
                <label for="waypoint">Way Point:</label>    
                <input type="text" name="waypoint" placeholder="Mid Destination">
                <!-- </div>
            </div> -->
            <!-- <button type="button" onclick="addWaypoint()">Add Waypoint</button> -->
        </p>
        
        <p>
            <label for="endpoint">End Point:</label>
            <input type="text" name="endpoint" placeholder="Last Destination">
        </p>
        <p>
            <input type="submit" name = "submit" value="submit guide">
        </p>
    
    <!-- <script>
        var waypointCount = 1;
        var waypointContainer = document.getElementById("waypointContainer");

        function addWaypoint() {
        waypointCount++;

        var waypointInput = document.createElement("div");
        waypointInput.classList.add("waypoint-input");
        waypointInput.innerHTML = `<input type="text" name="waypoint" placeholder="Waypoint ${waypointCount}">`;

        waypointContainer.appendChild(waypointInput);
        }
  </script> -->
    </form>
</body>
</html>