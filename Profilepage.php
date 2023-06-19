<?php
// Start the session
session_start();

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Output the username
    echo $username . "\n\n";

    // Create a new connection
    $link = mysqli_connect('localhost', 'root', '', 'travelwebsite') or die("No connection");

    // Check if the connection was successful
    if (!$link) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Query to retrieve the number of votes for the user
    $query = "SELECT NumVotes, NumFollowers, NumGuides FROM user WHERE Email = '$username'";

    // Execute the query
    $result = mysqli_query($link, $query);

    // Check if the query was successful
    if ($result) {
        // Fetch the vote count value
        $row = mysqli_fetch_assoc($result);
        $voteCount = $row['NumVotes'];
        $FollowCount = $row['NumFollowers'];
        $GuideCount = $row['NumGuides'];

        // Output the number of votes with line breaks
        echo "Number of Votes: " . $voteCount . "\n";
        echo "Number of Followers: " . $FollowCount . "\n";
        echo "Number of Guides: " . $GuideCount;
    } else {
        // Handle the case when the query fails
        echo "Error retrieving vote count: " . mysqli_error($link);
    }

    // Close the database connection
    mysqli_close($link);
} else {
    echo "No user found.";
}
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
    <link rel="stylesheet" href="../css/profilepage.css">
    <link rel="stylesheet" href="../css/footer.css">    
    <link rel = "stylesheet" href="../css/navbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type = "text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet"href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
<style>

/*NEED TO PUT @MEDIA HERE TO OVERWRITE BOOTSTRAP*/

.background-image{
  background-color: rgba(128, 128, 128, 0.644);
  background-image: url('../img/Snow-mountains.jpg');
  background-blend-mode: multiply;
  background-size: cover;
  background-repeat: no-repeat;
  min-height: 100vh;
  overflow-y: auto; 
}

</style>

<!--MENU-->
</head>
<body >
<div class = "background-image">
  <header>
    <a href = "HomePageLogIN.html" class = "nav_logo"><img src = "../img/logo1.png"></a>

    <ul class = "navbar">
        <li><a href = "HomePageLogIN.html" class = "active" >Home</a></li>
        <li><a href = "guides_page.html">List of Guides</a></li>
        <li><a href = "TravelersHub.html">Travelers Hub</a></li>
    </ul>

    <div class = "nav_main">
      <form action="logout.php" method="post">
        <button type="submit" name="logout">Logout</button>
      </form>
      <div class="bx bx-menu" id = "menu-icon"></div>
    </div>
  </header>
<!--Main-->
<div class="wrapper">
 <div class="content">
  <div class="main-content">
    <div class="left-content">
      <div>
        <h1>My Guides</h1>

      </div>
    </div>
    <div class="right-content">
      <img src="../img/stockprofile.jpg" id="profile_pic"><br><br>
      <div><?= $name ?><br> Number of Votes: <?= $Votes ?><br>Number of Followers: <?= $Followers ?><br>Number of Guides: <?= $Guides ?></div>
    </div>
  </div>
 </div>
</div>
<!--Footer--> 
    <div class = "clearfix">
      <footer class = "footer">
        <div class = "container-footer">
          <div class = "row-footer">
            <div id = "footer-logo" class = "footer-col" >
                <ol >
                  <div id = "logo">
                    <a class = "a" href = "HomePageLogIN.html"><img id = "logo1" src = "logo1.png" style="width: 40%;"></a>
                    <div class = "copyright"><i></i>Copyright © 2023 "Web Project" All rights reserved.</div>
                  </div>
                </ol>
            </div>
            <div id = "footer-mid" class = "footer-col" >
              <h4>company</h4>
              <ol>
                <div class = "f"><a href = "Introduction.html">our team</a></div>
                <div class = "f"><a href = "https://www.youtube.com/watch?v=xvFZjo5PgG0">contact us</a></div>
                <div class = "f"><a href = "#">privacy policy</a></div>
                <div class = "f"><a href = "#">terms of services</a></div>
              </ol>
          </div>
          <div id = "footer-mid" class = "footer-col">
            <h4>menu</h4>
            <ol>
              <div class = "f"><a href = "guides_page.html">list of guides</a></div>
              <div class = "f"><a href = "#">social features</a></div>
            </ol>
        </div>
        <div id = "footer-mid" class = "footer-col">
          <h4>follow us</h4>
          <div class = "social-links">
            <a href = "#"><i class = "fab fa-facebook-f"></i></a>
            <a href = "#"><i class = "fab fa-twitter"></i></a>
            <a href = "#"><i class = "fab fa-instagram"></i></a>
            <a href = "#"><i class = "fab fa-linkedin-in"></i></a>
          </div>
      </div>
          </div>
        </div>
        
      </footer>
    </div>
    <script src = "Introduction.js"></script>
  <script src = "navbar.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js" integrity="sha512-lvcHFfj/075LnEasZKOkj1MF6aLlWtmpFEyd/Kc+waRnlulG5er/2fEBA5DBff4BZrcwfvnft0PiAv4cIpkjpw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI1eO1w2j3bWV_m0D4TwP9zw8TzcmVgCc"></script>

  <script> //Due to bootstrap, the java needs to stay in the same file
  
//Nav bar Dropdown activation   
  $(document).ready(function() {
      let $menu = $('#menu-icon'); // Select menu-icon element
      let $navbar = $('.navbar'); // Select navbar element
    
      $menu.on('click', function() { // When menu-icon is clicked function() {...} activated
        $menu.toggleClass('bx-x'); //adiciona class ".bx-x" q é um "X"
        $navbar.toggleClass('open');//adiciona class ".open" q va ativar o css q traz o dropddown da direita
      });
    });
    //Quando voltamos a clicar no menu-item ambas as classes são removidas

/*Effect fade-in for text*/
    document.addEventListener('DOMContentLoaded', function() {
        var element = document.querySelector('.row1');
        element.classList.add('active');
    });
  

  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>