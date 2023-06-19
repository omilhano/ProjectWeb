<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $link = mysqli_connect('localhost', 'root', '', 'travelwebsite2') or die("No connection");

    if (!$link) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add'])) {
            $guide_id = $_POST['guide_id'];
            // Increase the Votes column by 1
            $query = "UPDATE guides SET Control = Control + 1 WHERE id = $guide_id";
            mysqli_query($link, $query);
        } elseif (isset($_POST['delete'])) {
            $guide_id = $_POST['guide_id'];
            // Decrease the Votes column by 1
            $query = "UPDATE guides SET Control = Control + 2 WHERE id = $guide_id";
            mysqli_query($link, $query);
        }
    }
}
// Redirect back to the guides table page
header("Location: BackOffice.php");
exit();
?>