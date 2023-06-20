<?php
include "Configuration.php";

// Retrieve form data
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

// Validate form data
if ($password != $confirmPassword) {
    echo "Passwords do not match.";
} elseif (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
    echo "Password must be at least 8 characters long and contain both letters and numbers.";
} else {
    $sql = "INSERT INTO user (username, email, password)
    VALUES ('$username','$email', '$password')";

    $ret = mysqli_query($link, $sql);

    if ($ret) {
        $last_id = mysqli_insert_id($link);
        header("Location: ../html/HomePage.html");
    } else {
        echo "ERROR: Could not execute $sql." . mysqli_error($link);
    }
}
?>