
<?php
//Connect to database
$link = mysqli_connect("localhost", "root", "", "travelwebsite2");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

include '../php/login.php';


//If file upload form is submitted
$status = $statusMsg = ''; #assigns empty string to two variable string system
if(isset($_POST["submit"])){ #checks if form has been submitted 
    $status = 'error'; 


    $username = $_REQUEST["username"];
    $content= $_REQUEST["content"];
    $date = $_REQUEST["date"];
    $country = $_REQUEST["country"];
    $location = $_REQUEST["location"];
    $km = $_REQUEST["km"];
    $cities = $_REQUEST["cities"];
    $days = $_REQUEST["days"];
    $startpoint = $_REQUEST['startpoint'];
    $waypoint = $_REQUEST['waypoint'];
    $endpoint = $_REQUEST['endpoint'];
    
    $uploadDir = 'img_db/';

    if(!empty($_FILES["image"]["name"])) { #in case of a file being uploaded
        
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); #retrieves base name of file
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); #retrieves file extension from the uploaded file
        $targetFilePath = $uploadDir . $fileName; // Destination path of the uploaded image
           
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $imageName = $_FILES['image']['name']; // Get the image name
            $imagePath = $uploadDir . $imageName; // Full path of the image in the destination folder
           
            // Check if every input is filled
            if (empty($username) || empty($content) || empty($date) || empty($country) || empty($location) || empty($km) || empty($cities) || empty($days) || empty($imageName) || empty($startpoint) || empty($endpoint) || empty($waypoint)) {
                echo "Please fill in all the fields.";
            } else {  
                
                // Move the uploaded image to the destination folder
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
                    // Image move successful, proceed with database insertion


                    // Insert content into the guides table
                    $insert = "INSERT INTO guides (id_user, Username, Description, Date, Location, Num_of_Km, Num_of_cities, Num_of_days, Country, starting_point, way_point, end_point, Image) 
                    VALUES ('".$_SESSION['user_id']."','$username', '$content', '$date', '$location', '$km', '$cities', '$days', '$country', '$startpoint', '$waypoint', '$endpoint', '" . $imageName . "')";
                    
                    $ret = mysqli_query($link, $insert);
                    if ($ret) {
                        // $guideId = mysqli_insert_id($link); // Get the ID of the inserted guide record
                        // $startpoint = $_REQUEST['startpoint'];
                        // $waypoint = $_REQUEST['waypoint'];
                        // $endpoint = $_REQUEST['endpoint'];
                        
                        // // Insert the values into the pin_points table
                        // $insertPinPoints = "INSERT INTO pin_points (id_guides, starting_point, way_point, end_point) 
                        //     VALUES ('$guideId', '$startpoint', '$waypoint', '$endpoint')";
        
                        // $retPinPoints = mysqli_query($link, $insertPinPoints);

                        // $status = 'success';
                        // $statusMsg = "File uploaded successfully.";
                    } else {
                        $statusMsg = "File upload failed, please try again.";
                    }
                }
            }
        } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
            }
        } else {
            $statusMsg = 'Please select an image file to upload.';
        }
    }

// Display status message 
//echo $statusMsg;  


 