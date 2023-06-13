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
}

// Check if the search query parameter is set
if (isset($_GET['search'])) {
    // Get the search query from the URL parameter
    $searchQuery = $_GET['search'];

    // Fetch the content from the database
    $query = "SELECT email FROM Register WHERE LOWER(email) LIKE LOWER('%$searchQuery%')"; // Replace 'Register' with the actual table name and 'email' with the appropriate column name
    $result = mysqli_query($link, $query);

    if ($result) {
        // Check if any matching emails found
        if (mysqli_num_rows($result) > 0) {
            echo "<h2>Search Results:</h2>";
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>" . $row['email'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "No results found.";
        }
    } else {
        echo "Error retrieving content from the database.";
    }
}
?>