<?php
// Start the session
session_start();

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  // Create a new connection
  $link = mysqli_connect('localhost', 'root', '', 'travelwebsite2') or die("No connection");

  // Check if the connection was successful
  if (!$link) {
    die("Database connection failed: " . mysqli_connect_error());
  }

  // Fetch users from the database
  $query = "SELECT id, username, email, NumVotes, NumFollowers, NumGuides FROM user";
  $result = mysqli_query($link, $query);

  // Store the users in an array
  $users = array();
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $users[] = $row;
    }
  }

  // Filter users based on search query
  if (isset($_GET['search'])) {
    // Fetch users from the database
    $query = "SELECT id, username, email, NumVotes, NumFollowers, NumGuides FROM user";
    $result = mysqli_query($link, $query);

    // Store the users in an array
    $users = array();
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
      }
    }

    // Filter users based on search query
    $searchQuery = strtolower($_GET['search']);
    $filteredUsers = array_filter($users, function ($user) use ($searchQuery) {
      return strpos(strtolower($user['username']), $searchQuery) !== false;
    });

    // Update the users array with the filtered results
    $users = $filteredUsers;
  }
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
  <link rel="stylesheet" href="../css/TravelersHub.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <style>
    /*NEED TO PUT @MEDIA HERE TO OVERWRITE BOOTSTRAP*/

    .background-image {
      background-color: rgba(128, 128, 128, 0.644);
      background-image: url('../img/aurora-bg.jpg');
      background-blend-mode: multiply;
      background-size: cover;
      background-repeat: no-repeat;
      min-height: 100vh;
      overflow-y: auto;
    }
  </style>
  <!--MENU-->
</head>

<body>
  <div class="background-image">
    <header>
      <a href="../php/HomePageLogIN.php" class="nav_logo"><img src="../img/logo1.png"></a>

      <ul class="navbar">
        <li><a href="../php/HomePageLogIN.php" class="active">Home</a></li>
        <li><a href="../php/GuidesPage.php">List of Guides</a></li>
        <li><a href="../php/Profilepage.php">Profile Page</a></li>
      </ul>

      <li>
        <form class="search-form" action="" method="GET"> <!-- Updated the form action to empty value -->
          <input type="text" name="search" id="searchInput" placeholder="Search..."
            value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
          <!-- Added value attribute to retain the search query -->
          <button type="submit"><i class="fas fa-search"></i></button>
        </form>
      </li>

      <div class="nav_main">
        <form action="logout.php" method="post">
          <a href="#" class="user"><i class="ri-logout-box-r-line"></i>
            <button id="login-button" name="logbutton" class="nav-link">Logout</button></a>
        </form>
        <div class="bx bx-menu" id="menu-icon"></div>
      </div>
    </header>
    <!--Main-->
    <div class="wrapper">
      <div class="content">
        <div class="main-content">
          <div class="box-container">
            <?php if (!empty($users)) { ?>
              <?php foreach ($users as $user) { ?>
                <div class="box">
                  <div>
                    <a href="Userprofile.php?username=<?= $user['username'] ?>">
                      <?= $user['username'] ?>
                    </a><br>
                    Number of Votes:
                    <?= $user['NumVotes'] ?><br>
                    Number of Followers:
                    <?= $user['NumFollowers'] ?><br>
                    Number of Guides:
                    <?= $user['NumGuides'] ?>
                  </div>
                </div>
              <?php } ?>
            <?php } else { ?>
              <p>No results found.</p>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Footer-->
  <div class="clearfix">
    <footer class="footer">
      <div class="container-footer">
        <div class="row-footer">
          <div id="footer-logo" class="footer-col">
            <ol>
              <div id="logo">
                <a class="a" href="../php/HomePageLogIN.php"><img id="logo1" src="../img/logo1.png"
                    style="width: 40%;"></a>
                <div class="copyright"><i></i>Copyright © 2023 "Web Project" All rights reserved.</div>
              </div>
            </ol>
          </div>
          <div id="footer-mid" class="footer-col">
            <h4>company</h4>
            <ol>
              <div class="f"><a href="../html/Introduction.html">our team</a></div>
              <div class="f"><a href="https://www.youtube.com/watch?v=xvFZjo5PgG0">contact us</a></div>
              <div class="f"><a href="https://www.youtube.com/watch?v=xvFZjo5PgG0">privacy policy</a></div>
              <div class="f"><a href="https://www.youtube.com/watch?v=xvFZjo5PgG0">terms of services</a></div>
            </ol>
          </div>
          <div id="footer-mid" class="footer-col">
            <h4>menu</h4>
            <ol>
              <div class="f"><a href="../php/GuidesPage.php">list of guides</a></div>
              <div class="f"><a href="../php/TravelersHubnew.php">Travelers Hub</a></div>
              <div class="f"><a href="../php/Profilepage.php">Profile Page</a></div>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"
    integrity="sha512-lvcHFfj/075LnEasZKOkj1MF6aLlWtmpFEyd/Kc+waRnlulG5er/2fEBA5DBff4BZrcwfvnft0PiAv4cIpkjpw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI1eO1w2j3bWV_m0D4TwP9zw8TzcmVgCc"></script>

  <script> //Due to bootstrap, the java needs to stay in the same file

    //Nav bar Dropdown activation   
    $(document).ready(function () {
      let $menu = $('#menu-icon'); // Select menu-icon element
      let $navbar = $('.navbar'); // Select navbar element

      $menu.on('click', function () { // When menu-icon is clicked function() {...} activated
        $menu.toggleClass('bx-x'); //adiciona class ".bx-x" q é um "X"
        $navbar.toggleClass('open');//adiciona class ".open" q va ativar o css q traz o dropddown da direita
      });
    });
    //Quando voltamos a clicar no menu-item ambas as classes são removidas

    /*Effect fade-in for text*/
    document.addEventListener('DOMContentLoaded', function () {
      var element = document.querySelector('.row1');
      element.classList.add('active');
    });


  </script>
</body>

</html>