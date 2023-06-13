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

    // Retrieve the email from the URL parameter
    if (isset($_GET['name'])) {
        $name = $_GET['name'];

        // Prepare the SQL query
        $query = "SELECT email, NumVotes, NumFollowers, NumGuides FROM Register WHERE email = '$name'";

        // Execute the query
        $result = mysqli_query($link, $query);

        // Check if the query was successful
        if ($result) {
            // Fetch the row from the result
            $row = mysqli_fetch_assoc($result);

            // Retrieve the profile-stats
            $email = $row['email'];
            $Votes = $row['NumVotes'];
            $Followers = $row['NumFollowers'];
            $Guides = $row['NumGuides'];

            // Use the retrieved profile-stats as needed
            // For example, you can echo it or assign it to a variable for further use
            echo '<div>Email: ' . $email . '</div>';
            echo '<div>Number of Votes: ' . $Votes . '</div>';
            echo '<div>Number of Followers: ' . $Followers . '</div>';
            echo '<div>Number of Guides: ' . $Guides . '</div>';
            
        } else {
            echo "Error: " . mysqli_error($link);
        }

        // Free the result and close the connection
        mysqli_free_result($result);
    }

    // Close the connection
    mysqli_close($link);
}
?>