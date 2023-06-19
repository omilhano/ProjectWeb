<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="guides.css">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDabHG6aejXWQtt5RnRMJbpWV6RL6a6rcU"></script>
  <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
  


<?php

include 'guides_config.php';

$sql = "SELECT * FROM guides ORDER BY id DESC LIMIT 1";

        $result = mysqli_query($link, $sql);
        
        while ($row = mysqli_fetch_array($result)) {
            
            $id = $row['id'];
            $username = $row['Username'];
            $content= $row['Description'];
            $date = $row['Date'];
            $country = $row['Country'];
            $location = $row['Location'];
            $km = $row['Num_of_Km'];
            $cities = $row['Num_of_cities'];
            $days = $row['Num_of_days'];          
            $imageName = $row['Image'];
            $imageUrl = "img_db/" . $imageName;
            $startpoint = $row['starting_point'];
            $waypoint = $row['way_point'];
            $endpoint = $row['end_point'];
            $last_id = mysqli_insert_id($link);

            echo
            "
              <div class = 'guides_flex'>
              
                  <div class = 'guides_header'>
                    <p> $username - $date</p>
                  </div>
                
                <div class = 'guides_mid'>
                    <div class = 'guides_main'>
                        <div class = 'main_text'> 
                            <p class = 'country'> $country </p>
                            <p class = 'location'> $location </p>
                            <div class = 'text_box'><p class = 'content'> $content </p></div>
                        </div>
                    </div>
                  

                    <div class='gallery'>
                      <img src = '$imageUrl' alt='Image'>
                    </div>
                </div> 
               
                <div class = 'guides_bottom'>
                 
                  <div class='map'>";
                  include '../php/guides_map.php'; 
            echo "</div> 
                 
                  <div class = 'guides_stats'>
                    <div class = 'stats_text'>
                        <div class='city-container'>
                            <i class='ri-map-pin-2-line'></i>
                            <p class='cities'>$cities Cities</p>
                        </div>

                        <div class='days-container'>
                            <i class='ri-time-line'></i>
                            <p class='days'>$days Days</p>
                        </div>
                        <div class='footprint-container'>
                            <i class='ri-footprint-line'></i>
                            <p class='footprint'>$km KM</p>
                        </div>

                    </div>
                  </div>

                </div>
              </div>";
             
          
          }
?>

</body>
</html>