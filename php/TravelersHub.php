<?php
// Start the session
session_start();

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // Create a new connection
    $link = mysqli_connect('localhost', 'root', '', 'phpmyadmin') or die("No connection");

    // Check if the connection was successful
    if (!$link) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Fetch users from the database
    $query = "SELECT id, email, NumVotes, NumFollowers, NumGuides FROM Register";
    $result = mysqli_query($link, $query);

    // Check if there are any users
    if (mysqli_num_rows($result) > 0) {
        // Loop through the users and create a box for each one
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['email'];
            $Votes = $row['NumVotes'];
            $Followers = $row['NumFollowers'];
            $Guides = $row['NumGuides'];

            echo '<div class="box-container">';
            echo '<div class="box">';
            echo '<a href="UserProfile.html?name=' . urlencode($name) . '">' . $name . '</a>';
            echo '<div>Number of Votes: ' . $Votes . '</div>';
            echo '<div>Number of Followers: ' . $Followers . '</div>';
            echo '<div>Number of Guides: ' . $Guides . '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "No users found.";
    }

    // Close the connection
    mysqli_close($link);
}
?>