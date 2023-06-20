<?php
$link = mysqli_connect('localhost', 'root', '', 'travelwebsite2') or die("No connection");

// Check if the connection was successful
if (!$link) {
    die("Database connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];

$query = "SELECT Admin FROM user WHERE Username = '$username'";
$result = mysqli_query($link, $query);

// Check if the query was executed successfully
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $admin = intval($row['Admin']);

        if ($admin == 1) {
            header("Location: ../php/GuidesPageAdmin.php");
        } else {
            header("Location: ../php/GuidesPage.php");
        }
    } else {
        echo "No user found with the provided username.";
        // Handle the case when no user is found with the provided username
    }
} else {
    echo "ERROR: Could not execute $query." . mysqli_error($link);
    // Handle the error accordingly
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body> 
    <?php include '../php/guides_insert.php'?>
</body>
</html>