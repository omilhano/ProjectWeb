<?php
$link = mysqli_connect('localhost', 'root', '', 'db_test') or die("No connection");
session_start();
$user_online = $_SESSION['username'];

// Check if the guide ID is provided in the query parameter
?>
<!DOCTYPE html>
<html>

<head>
    <title>Guide Details</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI1eO1w2j3bWV_m0D4TwP9zw8TzcmVgCc"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <?php
    echo '<div class="container">';
    echo '<h1>Guide Details</h1>';
    // Retrieve all guides from the guide_table
    $sql = "SELECT * FROM guides_table";
    $result = mysqli_query($link, $sql);
    
    $check_comments = "SELECT * FROM comment_section";///esta parte vai buscar tudo da table dos comments
    $comment_query = mysqli_query($link, $check_comments); ///query normal
    $rowCount = mysqli_num_rows($comment_query); //conta os rows de comentários



    if ($result && mysqli_num_rows($result) > 0) {
        echo '<div class="row">';

        $guideCount = 0;
    
        $already_posted = false;
        while ($guide = mysqli_fetch_assoc($result)) {
            $username = $guide['username'];
            $titles = $guide['titles'];
            $description = $guide['description'];
            $startingPoint = $guide['starting_point'];
            $endingPoint = $guide['ending_point'];
            $guide_id = $guide['id_guide'];

            // Output the guide details with Bootstrap grid classes
            echo '<div class="col-lg-4 col-md-6 mb-4">';
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $titles . '</h5>';
            echo '<p class="card-text">' . $description . '</p>';
            echo '<p class="card-text">' . $username . '</p>';
            // echo '<p class="card-text">' . $guide_id . '</p>';
            echo '<div id="map-' . $guideCount . '" style="height: 200px; width: 100%;"></div>';
            echo '<div class="card footer">';
            echo '<p class="card-text">Comments</p>';
            echo '<div class="comment-section">';
            $counter_comments = 0; //counter dos comentarios que vai iterar e percorrer comentarios
            $get_comment = "SELECT * FROM comment_section WHERE id_guide = '$guide_id' ORDER BY id_action DESC LIMIT 5";
            //linha acima seleciona os coments que correspondem a cada guide individualmente por ordem descrescente limite 5 cada post
            $comment_query = mysqli_query($link, $get_comment); // Update do comment query
            if ($comment_query && mysqli_num_rows($comment_query) > 0) { //caso o query de certo e a table n esteja vazia
                while ($counter_comments <= 5 && $comment_table = mysqli_fetch_assoc($comment_query)) { //limite dos 5 comments por post aqui
                    $commenter = $comment_table['username']; //commenter é quem comenta 
                    $comment = $comment_table['comment']; //comentário em si
                    echo '<div class="comment">'; //criar o div que dá display dos comentarios
                    echo $commenter . ': '; //nome de quem comenta
                    echo $comment; //comentario em si 
                    echo '</div>'; //fecha div
                    $counter_comments++; //incrementa o numero de comentarios ((ate aos 5))
                }
            } else { //caso o query de errrado ou tabela vazio, mostra no comments
                echo 'No comments.';
            }

            // este form está dentro da mesma pagina, pode estar fora mas prefiro assim 
            echo '<form method="POST" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">'; //para correr na mesma pagina
            echo '<input type="hidden" name="guide_id" value="' . $guide_id . '">'; // hidden é um campo que preenche automaticamente para o form saber qual o id do guide
            echo '<label for="comment">Comment:</label>'; //o que o user vai comentar
            echo '<textarea id="comment" name="comment" required></textarea><br>';
            echo '<input type="submit" value="Submit Comment">';
            echo '</form>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            if (!$already_posted && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guide_id'])) {
                $user_commenting = $user_online; //ir buscar o nome da pessoa que tem sessao iniciada, a variavel da sessao
                $comment = $_POST['comment']; //vai buscar o comment do form
                $comment_guide_id = $_POST['guide_id']; // tira o id do guide daquele input que preenche automaticamante
    
                if ($link) {
                    $insert_comment = "INSERT INTO comment_section (username, id_guide, comment) VALUES ('$user_commenting', '$comment_guide_id', '$comment')"; //insere os valores, sql base
                    mysqli_query($link, $insert_comment);
                    $already_posted = true;
                }
            }

            $guideCount++;

            // Check if the current row has three guides
            if ($guideCount % 3 == 0) {
                echo '</div>'; // Close the current row
                echo '<div class="row">'; // Open a new row
            }
        }
        // Close the last row if it's not already closed
        if ($guideCount % 3 != 0) {
            echo '</div>';
        }
    } else {
        echo "No guides found.";
    }
    echo '</div>';
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var directionsService = new google.maps.DirectionsService();
        var geocoder = new google.maps.Geocoder();

        function initMap() {
            <?php
            $result = mysqli_query($link, $sql);
            $guideCount = 0;

            while ($guide = mysqli_fetch_assoc($result)) {
                $startingPoint = $guide['starting_point'];
                $endingPoint = $guide['ending_point'];
                $mapId = "map-" . $guideCount;
                // concatenate number to the guide count on the $mapId to
                // display the map corresponding to the guide number
                echo 'var map' . $guideCount . ' = new google.maps.Map(document.getElementById("' . $mapId . '"), {';
                echo 'zoom: 7,';
                echo 'center: { lat: 38.736946, lng: -9.142685 }';
                echo '});';

                echo 'calcRoute(map' . $guideCount . ', "' . $startingPoint . '", "' . $endingPoint . '");';

                $guideCount++;
            }
            ?>
        }


            function calcRoute(map, startAddress, endAddress) {
                geocodeAddress(startAddress, function (startLocation) {
                    geocodeAddress(endAddress, function (endLocation) {
                        var startMark = new google.maps.Marker({
                            position: startLocation,
                            map: map,
                            title: "start"
                        });
                        var endMark = new google.maps.Marker({
                            position: endLocation,
                            map: map,
                            title: "end"
                        });

                        var request = {
                            origin: startLocation,
                            destination: endLocation,
                            travelMode: 'DRIVING'
                        };

                        directionsService.route(request, function (response, status) {
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
            }

            function geocodeAddress(address, callback) {
                geocoder.geocode({
                    'address': address
                }, function (results, status) {
                    if (status === 'OK') {
                        callback(results[0].geometry.location);
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            }

            google.maps.event.addDomListener(window, "load", initMap);

            $(document).ready(function () {
                // Like button click event
                $('.like-btn').click(function () {
                    console.log('Like button clicked');
                    var guideId = $(this).data('guide-id');
                    updateLikeStatus(guideId, true);
                });

                // Dislike button click event
                $('.dislike-btn').click(function () {
                    console.log('Dislike button clicked');
                    var guideId = $(this).data('guide-id');
                    updateLikeStatus(guideId, false);
                });

                // Function to update the like/dislike status via AJAX
                function updateLikeStatus(guideId, isLike) {
                    $.ajax({
                        url: 'update_likes.php',
                        method: 'POST',
                        data: {
                            guideId: guideId,
                            isLike: isLike
                        },
                        success: function (response) {
                            // Handle the response if needed
                        },
                        error: function (xhr, status, error) {
                            // Handle the error if needed
                        }
                    });
                }
            });
    </script>
</body>

</html>