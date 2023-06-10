<?php

include "Configuration.php";

// Retrieve form data
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

// Validate form data
if ($password != $confirmPassword) {
    echo "Passwords do not match.";
} else {
    $sql = "INSERT INTO register (email, password)
    VALUES ('$email', '$password')"; // tem de ser ' e não "

    $ret = mysqli_query($link, $sql);

    if($ret){
        $last_id = mysqli_insert_id($link);
        echo "Records added successfully;
        <br>email: $email
        <br>password: $password
        <br>
        You have the number $last_id, that you should use as a reference. ";
    } else{
        echo "ERROR: Could not execute $sql." . mysqli_error($link);
    }
}
?>