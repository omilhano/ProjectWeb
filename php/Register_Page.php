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
} else {
    // Check if username or email already exists
    $checkQuery = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";
    $checkResult = mysqli_query($link, $checkQuery);
    $rowCount = mysqli_num_rows($checkResult);
    
    if ($rowCount > 0) {
        // Username or email already exists
        echo "Username or email already exists.";
    } else {
        // Insert new user record
        $sql = "INSERT INTO user (username, email, password)
        VALUES ('$username', '$email', '$password')";

        $ret = mysqli_query($link, $sql);

        if($ret){
            $last_id = mysqli_insert_id($link);
            echo "Records added successfully;
            <br>Username: $username
            <br>email: $email
            <br>
            You have the number $last_id, that you should use as a reference. ";
        } else{
            echo "ERROR: Could not execute $sql." . mysqli_error($link);
        }
    }
}
?>
?>