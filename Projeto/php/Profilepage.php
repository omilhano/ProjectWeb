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

  // Query to retrieve the number of votes for the user
  $query = "SELECT ID, username, NumVotes, NumFollowers FROM user WHERE Email = '$username'";

  // Execute the query
  $result = mysqli_query($link, $query);

  // Check if the query was successful
  if ($result) {
    // Fetch the vote count value
    $row = mysqli_fetch_assoc($result);
    $name = $row['username'];
    $Votes = $row['NumVotes'];
    $Followers = $row['NumFollowers'];
    $Userid = $row['ID'];
  } else {
    // Handle the case when the query fails
    echo "Error retrieving vote count: " . mysqli_error($link);
  }

  // Query to count the number of rows in the "guides" table where the column 'username' matches $name
  $guidesCountQuery = "SELECT COUNT(*) AS count FROM guides WHERE Username = '$name'";

  // Execute the count query
  $guidesCountResult = mysqli_query($link, $guidesCountQuery);

  // Check if the count query was successful
  if ($guidesCountResult) {
    // Fetch the guide count value
    $guideCountRow = mysqli_fetch_assoc($guidesCountResult);
    $Guides = $guideCountRow['count'];
  } else {
    // Handle the case when the count query fails
    echo "Error retrieving guide count: " . mysqli_error($link);
  }

  // Query to calculate the sum of 'Votes' column values for the given username
  $votesSumQuery = "SELECT SUM(Votes) AS sum FROM guides WHERE Username = '$name'";

  // Execute the sum query
  $votesSumResult = mysqli_query($link, $votesSumQuery);

  // Check if the sum query was successful
  if ($votesSumResult) {
    // Fetch the sum value
    $votesSumRow = mysqli_fetch_assoc($votesSumResult);
    $Votes = $votesSumRow['sum'];
  } else {
    // Handle the case when the sum query fails
    echo "Error retrieving votes sum: " . mysqli_error($link);
  }

  $sql = "SELECT * FROM follow WHERE follower_username = '$username'";
  $result = mysqli_query($link, $sql);
  $all_follow_string = "You don't follow anyone";
  if ($result && mysqli_num_rows($result) > 0) {
  $all_follow = array();

    while ($follow_connection = mysqli_fetch_assoc($result)) {
      $following = $follow_connection['following_username'];
      $mutual = "SELECT * FROM follow WHERE following_username = '$username' AND 
          follower_username = '$following'";
      $is_mutual = mysqli_query($link, $mutual);
      array_push($all_follow, $following);
    }
    $all_follow_string = implode(" <br>", $all_follow);
  }

  // Close the database connection
  mysqli_close($link);
}else{
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
  <link rel="stylesheet" href="../css/navbar.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <style>
    /*NEED TO PUT @MEDIA HERE TO OVERWRITE BOOTSTRAP*/

    .background-image {
      background-color: rgba(128, 128, 128, 0.644);
      background-image: url('../img/sakura-bg.jpg');
      background-blend-mode: multiply;
      background-size: cover;
      background-repeat: no-repeat;
      min-height: 100vh;
      overflow-y: auto;
    }

    #modal_text{
      color: black;
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
        <li><a href="../php/TravelersHubnew.php">Travelers Hub</a></li>
      </ul>

      <div class="nav_main">
        <form action="logout.php" method="post">
          <a href="#" class = "user"><i class="ri-logout-box-r-line"></i>
          <button id="login-button" name="logbutton" class="nav-link">Logout</button></a>
        </form>
        <div class="bx bx-menu" id="menu-icon"></div>
      </div>
    </header>
    <!--Main-->
    <div class="wrapper">
      <div class="content">
        <div class="main-content">
          <div class="left-content">
            <div>
              <h1>My Guides</h1>
              <label for="myComboBox">Edit or Delete a Guide:</label>
              <select id="myComboBox">
                <option value="">Guides</option>

                <?php
                // Create a new connection
                $link = mysqli_connect('localhost', 'root', '', 'travelwebsite2') or die("No connection");

                // Check if the connection was successful
                if (!$link) {
                  die("Database connection failed: " . mysqli_connect_error());
                }

                // Fetch data from the database
                $sql = "SELECT id, Location, id_user FROM guides WHERE id_user = $Userid";
                $result = mysqli_query($link, $sql);

                if (mysqli_num_rows($result) > 0) {
                  // Output options as combo box options
                  while ($row = mysqli_fetch_assoc($result)) {
                    $guideId = $row["id"];
                    $location = $row["Location"];
                    $editLink = "edit_guide.php?id=$guideId";
                    $deleteLink = "delete_guide.php?id=$guideId";
                    echo '<option value="' . $guideId . '">' . $location . '</option>';
                    // echo '<button class="edit-button" onclick="window.location.href=\'' . $editLink . '\'">Edit</button>';
                    // echo '<button class="delete-button" onclick="window.location.href=\'' . $deleteLink . '\'">Delete</button>';
                
                  }
                }

                // Close the database connection
                mysqli_close($link);

                ?>

              </select>

              <button class="edit-button" onclick="edit_guide();">Edit</button>
              <button class="delete-button" onclick="delete_guide();">Delete</button>
              <script>
                function edit_guide() {
                  var comboBox = document.getElementById('myComboBox');
                  //retun comboBox.value;
                  if (String(comboBox.value).length > 0)
                    window.location.href = "guides_edit.php?guide_id=" + comboBox.value;
                  else
                    return false;
                }

                function delete_guide() {

                  var comboBox = document.getElementById('myComboBox');
                  //retun comboBox.value;
                  if (String(comboBox.value).length > 0) {
                    var result = confirm("Are you sure you want to delete Guide" + comboBox.options[comboBox.selectedIndex].textContent + "?");

                    // Check the result
                    if (result) {
                      // User clicked "OK"
                      // Perform the desired action
                      console.log("Action confirmed");
                      window.location.href = "guides_delete.php?guide_id=" + comboBox.value;

                    } else {
                      // User clicked "Cancel" or closed the dialog
                      // Perform an alternative action or do nothing
                      console.log("Action canceled");
                    }
                  }
                }

              </script>
            </div>
          </div>
          <div class="right-content">
            <img src="../img/stockprofile.jpg" id="profile_pic"><br><br>
            <!-- Trigger/Open The Modal -->
            <button id="myBtn">Open Modal</button>

            <!-- The Modal -->
            <div id="myModal" class="modal">

              <!-- Modal content -->
              <div class="modal-content">
                <span class="close">&times;</span>
                <h4 id="modal_text">You follow: <br>
                </h4>
                <p id="modal_text"><?= $all_follow_string ?></p>
              </div>
            </div>
            <div>
              <?= $name ?><br> Number of Votes:
              <?= $Votes ?><br>Number of Followers:
              <?= $Followers ?><br>Number of Guides:
              <?= $Guides ?>
            </div>
            <a class="button" href="../php/guides_form.php">Click Me</a>
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
                <div class="f"><a href="../php/GuidesPage.php">Guides Page</a></div>
                <div class="f"><a href="../php/TravelersHubnew.php">Travelers Hub</a></div>
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

    <script>
      // Handle change event of the combo box
      document.getElementById('myComboBox').addEventListener('change', function () {
        var selectedValue = this.value;
        console.log('Selected value:', selectedValue);
        // Perform any additional actions based on the selected value
      });

      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks the button, open the modal 
      btn.onclick = function () {
        modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function () {
        modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function (event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
