<?php
include 'guides_config.php';

// if (isset($_GET['id'])) {
//     $id = $_GET['id'];



if(isset($_POST["submit"])){ #checks if form has been submitted 
        $status = 'error'; 
        
        //Request the updated values from the forms
        $g_id= $_GET['guide_id'];// Get the value of the "name" parameter
        
        $newContent= $_REQUEST["newContent"];
        $newDate = $_REQUEST["newDate"];
        $newCountry = $_REQUEST["newCountry"];
        $newLocation = $_REQUEST["newLocation"];
        $newKm = $_REQUEST["newKm"];
        $newCities = $_REQUEST["newCities"];
        $newDays = $_REQUEST["newDays"];
        $newStartpoint = $_REQUEST['newStartpoint'];
        $newWaypoint = $_REQUEST['newWaypoint'];
        $newEndpoint = $_REQUEST['newEndpoint'];
        
    
        //Update the record in database
        $sql = "UPDATE guides SET Description = '$newContent', Date = '$newDate', Country = '$newCountry', Location = '$newLocation', Num_of_Km = '$newKm', Num_of_cities = '$newCities', Num_of_days = '$newDays', starting_point = '$newStartpoint', way_point = '$newWaypoint', end_point = '$newEndpoint' WHERE id = $g_id"; 
        $result = mysqli_query($link, $sql);

        // Check if the query was successful
        if ($result) {
            echo "Record updated successfully.";
        } else {
            echo "Error updating record: " . mysqli_error($connection);
        }
 
    }

//Fetch records from the database
$g_id = $_GET['guide_id'];// Get the value of the "name" parameter
$sql = "SELECT * FROM guides WHERE id = $g_id";
$result = mysqli_query($link, $sql);

// Check if the record exists
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $content = $row['Description'];
    $date = $row['Date'];
    $country = $row['Country'];
    $location = $row['Location'];
    $km = $row['Num_of_Km'];
    $cities = $row['Num_of_cities'];
    $days = $row['Num_of_days'];
    $startpoint = $row['starting_point'];
    $waypoint = $row['way_point'];
    $endpoint = $row['end_point'];
    ?>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="newContent">Content:</label>
        <textarea name="newContent"><?php echo $content; ?></textarea><br>

        <label for="newDate">Date:</label>
        <input type="text" name="newDate" value="<?php echo $date; ?>"><br>

        <label for="newCountry">Country:</label>
        <input type="text" name="newCountry" value="<?php echo $country; ?>"><br>

        <label for="newLocation">Location:</label>
        <input type="text" name="newLocation" value="<?php echo $location; ?>"><br>

        <label for="newKm">Num of Km:</label>
        <input type="text" name="newKm" value="<?php echo $km; ?>"><br>

        <label for="newCities">Num of Cities:</label>
        <input type="text" name="newCities" value="<?php echo $cities; ?>"><br>

        <label for="newDays">Num of Days:</label>
        <input type="text" name="newDays" value="<?php echo $days; ?>"><br>

        <label for="newStartpoint">Starting Point:</label>
        <input type="text" name="newStartpoint" value="<?php echo $startpoint; ?>"><br>

        <label for="newWaypoint">Way Point:</label>
        <input type="text" name="newWaypoint" value="<?php echo $waypoint; ?>"><br>

        <label for="newEndpoint">End Point:</label>
        <input type="text" name="newEndpoint" value="<?php echo $endpoint; ?>"><br>

        <input type="submit" name="submit" value="Update">
    </form>
<?php
} else {
    echo "Record not found.";
}
?>