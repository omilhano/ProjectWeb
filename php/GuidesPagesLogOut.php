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
    $query = "SELECT id, Country, Location, Image, id_user, Votes, Control FROM guides";
    $result = mysqli_query($link, $query);

    // Store the users in an array
    $users = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
          
        }
    }

//Search bar
    if (isset($_GET['search'])) {
      // Fetch users from the database
      $query = "SELECT id, Username, Country, Image, Location, Votes, Control FROM guides";
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
          $usernameMatch = strpos(strtolower($user['Username']), $searchQuery) !== false;
          $locationMatch = strpos(strtolower($user['Location']), $searchQuery) !== false;
          $countryMatch = strpos(strtolower($user['Country']), $searchQuery) !== false;
          return $usernameMatch || $locationMatch || $countryMatch;
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
      <link rel="stylesheet" href="../css/HomePage.css">
      <link rel="stylesheet" href="../css/GuidesPage.css">  
      <link rel="stylesheet" href="../css/footer.css">    
      <link rel = "stylesheet" href="../css/navbar.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link rel="stylesheet" type = "text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
      <link rel="stylesheet"href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <style>

  /*NEED TO PUT @MEDIA HERE TO OVERWRITE BOOTSTRAP*/

  body{
    overflow-x: hidden;
  }

  *{
        padding: 0;   
        margin: 0;
    }

    .background-image{
        background-color: rgba(128, 128, 128, 0.644);
        background-image: url('../img/forest-bg.jpg');
        background-blend-mode: multiply;
        background-size: cover;
        background-repeat: no-repeat;
        height: auto;
        min-height: 100vh;
        /*Se height tiver apenas 100vh, a imagem limita-se só ao tamanho do ecrã (sem scroll)*/
      }

  .navbar li a, .nav_main a{text-decoration: none;} /*removes bootstrap underline under the links*/



  @media (max-width: 1280px){ /*resize para manter espaço entre logo - navbar - main*/
    header{
        padding: 14px 2%;
        transition: 0.2s;
    }

    .navbar a{
        padding: 5px 0;
        margin: 0px 20px;
    }
  }

  @media (max-width: 1000px){ /*Substituição por dropdown*/
    #menu-icon{
        display: block; /*enable dropdown*/
    }

    .navbar{ /*transição de navbar para dropdown box*/
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

    .navbar a{ /*espaço entre elementos e entre box + transição*/
        display: block;
        margin: 12px 0;
        padding: 0px 25px;
        transition: all 0.3 ease;
        
    }

    .navbar a:hover{
        color: var(--text-color);
        transform: translateY(10px); /*moves 10 px down when hovered*/
    }

    .navbar {
      display: none;/*Trigger para fazer navbar box sair ao clicar no "menu-icon"*/
    }

    .navbar a.active{
        color: var(--text-color)
    }

    .navbar.open{ /*CSS que traz dropdown da direita com JQuery*/
        display: block;
    }
  }

  @media only screen and (max-width: 534px){
    .nav_main{
      width: 1rem
    }

  }

  @media (max-width: 385px) {
  .nav_main a{
    font-size: 1.5rem;
  }
  }

  </style>

  <!--MENU-->
  </head>
  <body >
  <div class = "background-image">
    <header>
      <a href = "../html/HomePage.html" class = "nav_logo"><img src = "../img/logo1.png"></a>

      <ul class = "navbar">
          <li><a href = "../html/HomePage.html" class = "active" >Home</a></li>
          <li><a href = "../php/GuidesPagesLogOut.php">List of Guides</a></li>

      </ul>

      <li>
        <form class="search-form" action="" method="GET"> <!-- Updated the form action to empty value -->
            <input type="text" name="search" id="searchInput" placeholder="Search..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"> <!-- Added value attribute to retain the search query -->
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
      </li>

      <div class = "nav_main">
      <a href="#" class = "user"><i class="ri-user-fill"></i>
        <button id="login-button" name="logbutton" class="nav-link">Login</button>
        <div id="file_modal" class="modal">
            <div class="modal-content">
                <div class="modal_header" style="padding-bottom: 10px;">
                    <span id="close-modal" class="close">&times;</span>  
                    <span>Access your Account</span>
                </div>
                <form class="modal_body" action="../php/login.php" method="POST">

                  <label for="username">Email:</label>
                  <input type="text" name="username" id="username" required>
              
                  <label for="password">Password:</label>
                  <input type="password" name="password" id="password" required>
              
                  <button type="submit">Submit</button>

                </form>
            </div>
        </div>
      </a>
      <a href="../html/Register_Page.html" class = "register">Register</a>
      <div class="bx bx-menu" id = "menu-icon"></div>
    </div>
    </header>


  <!--Main-->
    
  <div class="wrapper">
        <div class="content">
            <div class="main-content">
                <div class="box-container">
                    <!-- Your PHP loop to generate the divs -->
                    <?php if (!empty($users)) { ?>
    <div class="box-container">
        <?php $counter = 0; ?>
        <?php foreach ($users as $user) { ?>
            <?php if ($user['Control'] == 1) { ?> <!-- Add this condition to check the Control variable -->
                <div class="box">
                    <a href="guides_table.php?id=<?= $user['id'] ?>">
                        <img class="link_img" src="img_db/<?= $user['Image'] ?>">
                    </a><br>
                    <p class="guide_title"><?= $user['Country'] ?><br></p>
                    <p class="guide_subtitle"><?= $user['Location'] ?><br></p>

                    <!-- Add the buttons for upvoting and downvoting -->
                    <div class="vote-buttons">
                        <div class="vote-count"><?= $user['Votes'] ?> votes</div>
                    </div>
                </div>
                <?php $counter++; ?>
                <?php if ($counter % 3 == 0) { ?>
                    </div><div class="box-container">
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
<?php } else { ?>
    <p>No results found.</p>
<?php } ?>
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
                      <a class = "a" href = "../html/HomePageAdmin.html"><img id = "logo1" src = "../img/logo1.png" style = "width: 40%"></a>
                      <div class = "copyright"><i></i>Copyright © 2023 "Web Project" All rights reserved.</div>
                    </div>
                  </ol>
              </div>
              <div id = "footer-mid" class = "footer-col" >
                <h4>company</h4>
                <ol>
                  <div class = "f"><a href = "../html/Introduction.html">our team</a></div>
                  <div class = "f"><a href = "https://www.youtube.com/watch?v=xvFZjo5PgG0">contact us</a></div>
                  <div class = "f"><a href = "https://www.youtube.com/watch?v=xvFZjo5PgG0"">privacy policy</a></div>
                  <div class = "f"><a href = "https://www.youtube.com/watch?v=xvFZjo5PgG0"">terms of services</a></div>
                </ol>
            </div>
            <div id = "footer-mid" class = "footer-col">
              <h4>menu</h4>
              <ol>
                <div class = "f"><a href = "../html/Homepage.html">HomePage</a></div>
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
    <script src = "../js/Introduction.js"></script>
    <script src = "../js/navbar.js"></script>
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

//Log in
    // Get the modal
    var modal = document.getElementById("file_modal");

    // Get the button that opens the modal
    var btn = document.getElementById("login-button");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
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
    // Checks if password corresponds to the user
    function checkPassword() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        if (password === "mypassword") {
            // correct password, do something
        } else {
            // incorrect password, update error message
            var errorElement = document.getElementById("password-error");
            errorElement.textContent = "Incorrect password. Please try again.";
        }
    }
    // This part removes the text from the modal when it gets closed
    $('#password-error').text('');

    $(".close").click(function() {
        $('#password-error').text('');
        $("#file_modal").css("display", "none");
    });
    document.getElementById("close-modal").addEventListener("click", function() {
        document.getElementById("username").value = "";
        document.getElementById("password").value = "";
    });
    </script>
    
  </body>
</html>