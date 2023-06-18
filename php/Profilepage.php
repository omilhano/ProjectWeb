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