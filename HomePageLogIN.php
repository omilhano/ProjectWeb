<?php
include 'db2.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="favicon.ico">
  <title>Turistic</title>
  <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap' rel='stylesheet'>
  <link rel="stylesheet" href="Introduction.css">
  <link rel="stylesheet" href="HomePage.css">
  <link rel="stylesheet" href="footer.css">
  <link rel="stylesheet" href="navbar.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <style>
    /*NEED TO PUT @MEDIA HERE TO OVERWRITE BOOTSTRAP*/

    body {
      overflow-x: hidden;
    }

    * {
      padding: 0;
      margin: 0;
    }

    .background-image {
      background-color: rgba(128, 128, 128, 0.644);
      background-image: url('bg-image.jpg');
      background-blend-mode: multiply;
      background-size: cover;
      background-repeat: no-repeat;
      height: auto;
      min-height: 100vh;
      /*Se height tiver apenas 100vh, a imagem limita-se só ao tamanho do ecrã (sem scroll)*/
    }

    .navbar li a,
    .nav_main a {
      text-decoration: none;
    }

    /*removes bootstrap underline under the links*/



    @media (max-width: 1280px) {

      /*resize para manter espaço entre logo - navbar - main*/
      header {
        padding: 14px 2%;
        transition: 0.2s;
      }

      .navbar a {
        padding: 5px 0;
        margin: 0px 20px;
      }
    }

    @media (max-width: 1000px) {

      /*Substituição por dropdown*/
      #menu-icon {
        display: block;
        /*enable dropdown*/
      }

      .navbar {
        /*tansição de navbar para dropdown box*/
        /*mudar posição navbar*/
        position: absolute;
        top: 100%;
        right: 2%;
        /*"criar" box*/
        width: 270px;
        background: var(--main-color);
        /*Organizar posição dos elementos*/
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        /*custom box*/
        border-radius: 10px;
        transition: all 0.3s ease;
      }

      .navbar a {
        /*espaço entre elementos e entre box + transição*/
        display: block;
        margin: 12px 0;
        padding: 0px 25px;
        transition: all 0.3 ease;
      }

      .navbar a:hover {
        color: var(--text-color);
        transform: translateY(10px);
        /*moves 10 px down when hovered*/
      }

      .navbar {
        display: none;
        /*Trigger para fazer navbar box sair ao clicar no "menu-icon"*/
      }

      .navbar a.active {
        color: var(--text-color)
      }

      .navbar.open {
        /*CSS que traz dropdown da direita com JQuery*/
        display: block;
      }
    }

    @media only screen and (max-width: 534px) {
      .nav_main {
        width: 1rem
      }

    }

    @media (max-width: 385px) {
      .nav_main a {
        font-size: 1.5rem;
      }
    }
  </style>

  <!--MENU-->
</head>

<body>
  <div class="background-image">
    <header>
      <a href="HomePageLogIN.html" class="nav_logo"><img src="logo1.png"></a>

      <ul class="navbar">
        <li><a href="HomePageLogIN.html" class="active">Home</a></li>
        <li><a href="guides_page.html">List of Guides</a></li>
        <li><a href="#">Social Features</a></li>
        <li><a href="profilepage.html">Profile Page</a></li>
      </ul>

      <div class="nav_main">
        <form action="logout.php" method="post">
          <button type="submit" name="logout">Logout</button>
        </form>
        <div class="bx bx-menu" id="menu-icon"></div>
      </div>
    </header>
    <!--Main-->

    <div class="container-fluid" style="width: 90%">


      <div class="row row1">
        <div class="col-lg-1 col-md-1 col-sm-1">
          <div class="home_header">The Unreal Mountains Peaking Out the Ocean</div>
          <div class="home_main">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. </div>
          <div class="guides">Guides</div>
        </div>
      </div>

      <?php
      // Retrieve all guides from the guide_table
      $sql = "SELECT id_guide, username, description, starting_point, ending_point, titles
        FROM guide_table
        ORDER BY id_guide DESC
        LIMIT 3";

      $result = $link->query($sql);


      if ($result->num_rows > 0) {
        echo '<div class="row">'; // Start of the row div

        // Display the data for each guide
        $counter = 0; // Counter to determine the position of the guide div

        while ($row = $result->fetch_assoc()) {
          $position = $counter % 3; // Calculate the position based on the counter
          $positionClass = ""; // Class for the position div

          // Determine the position class
          if ($position === 0) {
            $positionId = "left";
          } elseif ($position === 1) {
            $positionId = "center";
          } else {
            $positionId = "right";
          }
          echo '<div id="box" class="col-lg-4 col-md-12 col-sm-12">';
          echo '<div id="' . $positionId . '">'; // Start of the individual guide div with position class
          echo '<div class="slideshow-container" style="width: 100%; height: 100%;">';
          echo '<div class="slideshow" data-cycle-slides=">div" style="width: 100%; height: 100%;">';
          echo '<div id="first_slide" style="width: 100%; height: 100%;">';
          echo '<span class="guide_title">Title: ' . $row["titles"] . '</span><br>';
          echo "<span class='description'>Description: " . $row["description"] . "</span><br>";
          echo "<span class='starting-point'>Starting Point: " . $row["starting_point"] . "</span><br>";
          echo "<span class='ending-point'>Ending Point: " . $row["ending_point"] . "</span><br>";
          echo '</div>';
          echo '<div class="map-container" style="width: 100%; height: 100%;">';
          echo '<div id="map' . $row["id_guide"] . '" style="width: 100%; height: 100%;"></div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';

          $counter++; // Increment the counter
        }
        echo '</div>'; // End of the row div
      } else {
        echo "No guides found.";
      }


      ?>
      <!--Footer-->
      <div class="clearfix">
        <footer class="footer">
          <div class="container-footer">
            <div class="row-footer">
              <div id="footer-logo" class="footer-col">
                <ol>
                  <div id="logo">
                    <a class="a" href="HomePageLogIN.html"><img id="logo1" src="logo1.png"></a>
                    <div class="copyright"><i></i>Copyright © 2023 "Web Project" All rights reserved.</div>
                  </div>
                </ol>
              </div>
              <div id="footer-mid" class="footer-col">
                <h4>company</h4>
                <ol>
                  <div class="f"><a href="Introduction.html">our team</a></div>
                  <div class="f"><a href="https://www.youtube.com/watch?v=xvFZjo5PgG0">contact us</a></div>
                  <div class="f"><a href="#">privacy policy</a></div>
                  <div class="f"><a href="#">terms of services</a></div>
                </ol>
              </div>
              <div id="footer-mid" class="footer-col">
                <h4>menu</h4>
                <ol>
                  <div class="f"><a href="guides_page.html">list of guides</a></div>
                  <div class="f"><a href="#">social features</a></div>
                  <div class="f"><a href="profilepage.html">profile page</a></div>
                </ol>
              </div>
              <div id="footer-mid" class="footer-col">
                <h4>follow us</h4>
                <div class="social-links">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                  <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
              </div>
            </div>
          </div>

        </footer>
      </div>
      <script src="Introduction.js"></script>
      <script src="navbar.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js" integrity="sha512-lvcHFfj/075LnEasZKOkj1MF6aLlWtmpFEyd/Kc+waRnlulG5er/2fEBA5DBff4BZrcwfvnft0PiAv4cIpkjpw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI1eO1w2j3bWV_m0D4TwP9zw8TzcmVgCc"></script>

      <script>
        //Due to bootstrap, the java needs to stay in the same file

        //Nav bar Dropdown activation   
        $(document).ready(function() {
          let $menu = $('#menu-icon'); // Select menu-icon element
          let $navbar = $('.navbar'); // Select navbar element

          $menu.on('click', function() { // When menu-icon is clicked function() {...} activated
            $menu.toggleClass('bx-x'); //adiciona class ".bx-x" q é um "X"
            $navbar.toggleClass('open'); //adiciona class ".open" q va ativar o css q traz o dropddown da direita
          });
        });
        //Quando voltamos a clicar no menu-item ambas as classes são removidas

        //Slideshow + map
        $(".slideshow").cycle({
          fx: "scrollHorz"
        }); //adiciona efeito de scroll horizontal para a esquerda

        $(document).ready(function() {
          $(".slideshow").cycle();
        });

        var directionsService = new google.maps.DirectionsService();
        var geocoder = new google.maps.Geocoder();

        function initMap() {
          <?php
          $result = $link->query($sql);
          $guideCount = 0;

          while ($guide = $result->fetch_assoc()) {
            $startingPoint = $guide['starting_point'];
            $endingPoint = $guide['ending_point'];
            $mapId = "map" . $guide['id_guide'];

            echo 'var map' . $guide['id_guide'] . ' = new google.maps.Map(document.getElementById("' . $mapId . '"), {';
            echo 'zoom: 6,';
            echo 'center: { lat: 38.736946, lng: -9.142685 }';
            echo '});';

            echo 'calcRoute(map' . $guide['id_guide'] . ', "' . $startingPoint . '", "' . $endingPoint . '");';

            $guideCount++;
          }
          ?>
        }

        function calcRoute(map, startAddress, endAddress) {
          geocodeAddress(startAddress, function(startLocation) {
            geocodeAddress(endAddress, function(endLocation) {
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
        }

        function geocodeAddress(address, callback) {
          geocoder.geocode({
            'address': address
          }, function(results, status) {
            if (status === 'OK') {
              callback(results[0].geometry.location);
            } else {
              alert('Geocode was not successful for the following reason: ' + status);
            }
          });
        }

        google.maps.event.addDomListener(window, "load", initMap);

        /*Effect fade-in for text*/
        document.addEventListener('DOMContentLoaded', function() {
          var element = document.querySelector('.row1');
          element.classList.add('active');
        });
      </script>

</body>

</html>