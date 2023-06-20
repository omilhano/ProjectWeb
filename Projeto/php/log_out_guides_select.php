<?php
$link = mysqli_connect('localhost', 'root', '', 'travelwebsite2') or die("No connection");
session_start();
//only enter with session logged in
$user_online = $_SESSION['username'];
//creates unique token, used for comment submission
if (!isset($_SESSION['form_token'])) {
    $_SESSION['form_token'] = bin2hex(random_bytes(32));
}
//Cannot access guides whilst logged out
// if (isset($_SESSION['username'])) {
//     $user_online= $_SESSION['username'];
// } else {
//     $user_online = "Anon"
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/guides.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDabHG6aejXWQtt5RnRMJbpWV6RL6a6rcU"></script>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap'
        rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>



    <?php

    include 'guides_config.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Query the guides table for the specific ID
        $sql = "SELECT * FROM guides WHERE id = $id";
        $result = mysqli_query($link, $sql);

        // Check if a row is found
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);

            // Retrieve the data from the row
            $username = $row['Username'];
            $content = $row['Description'];
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

            // Display the retrieved data in your HTML
            echo "
        <div class='guides_flex'>
            <div class='guides_header'>
                <p>$username - $date</p>
            </div>

            <div class='guides_mid'>
                <div class='guides_main'>
                    <div class='main_text'>
                        <p class='country'>$country</p>
                        <p class='location'>$location</p>
                        <div class='text_box'>
                            <p class='content'>$content</p>
                        </div>
                    </div>
                </div>

                <div class='gallery'>
                    <img src='$imageUrl' alt='Image'>
                </div>
            </div>

            <div class='guides_bottom'>
                <div class='map'>";
            include '../php/guides_map.php';
            echo "</div>

                <div class='guides_stats'>
                    <div class='stats_text'>
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
        echo '<div class="comment_section">';
            echo '<h2>Comment Section: </h2>'; 
            $counter_comments = 0; //counter dos comentarios que vai iterar e percorrer comentarios
            $get_comment = "SELECT * FROM comment_section WHERE id_guide = '$id' ORDER BY id_comment DESC LIMIT 5";
            //linha acima seleciona os coments que correspondem a cada guide individualmente por ordem descrescente limite 5 cada post
            $comment_query = mysqli_query($link, $get_comment); // Update do comment query
            if ($comment_query && mysqli_num_rows($comment_query) > 0) { //caso o query de certo e a table n esteja vazia
                while ($counter_comments <= 5 && $comment_table = mysqli_fetch_assoc($comment_query)) { //limite dos 5 comments por post aqui
                    $commenter = $comment_table['username']; //commenter é quem comenta 
                    $comment = $comment_table['comment']; //comentário em si
                    echo '<div class="comment">';//criar o div que dá display dos comentarios

                    echo $commenter . ': '; //nome de quem comenta
                    echo $comment; //comentario em si 
                    echo '</div>'; //fecha div
                    $counter_comments++; //incrementa o numero de comentarios ((ate aos 5))
                }
            } else { //caso o query de errrado ou tabela vazio, mostra no comments
                echo 'No comments.';
            }
        echo '</div>';
        } else {
            // No row found with the specified ID
            echo "Guide not found.";
        }
    } else {
        // No ID provided in the URL
        echo "No guide ID specified.";
    }

    ?>


</body>

</html>