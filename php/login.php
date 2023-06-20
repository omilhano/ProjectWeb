<?php

$link = mysqli_connect('localhost', 'root', '', 'travelwebsite2') or die("No connection");

session_start();

if (@$_REQUEST['logout'] == 1) {
    logout();
}
if (@$_POST['username'] && @$_POST['password']) {
    $uuser = mysqli_real_escape_string($link, $_POST['username']);
    $inputPassword = md5($_POST['password']);
    
    $sql = "SELECT Password, Admin, Email, Username FROM user WHERE email='$uuser'";
    $result = mysqli_query($link, $sql);
    

    if (!$result || mysqli_num_rows($result) < 1) {
        exit;
    } else {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['Password'];
        $isAdmin = $row['Admin'];
        
        if ($inputPassword != $storedPassword) {
            print('hello');
            exit;
        }

        $_SESSION['username'] = $uuser;
        //After validate the password, get the user_id
        $sql = "SELECT id FROM user WHERE email='$uuser'";
        $result = mysqli_query($link, $sql);
        
        if (!$result || mysqli_num_rows($result) < 1) {
            exit;
        } else {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['id']; 
            } 
        
        if ($isAdmin == 1) {
            // Redirect to the admin page
            header("Location: ../html/HomePageAdmin.html");
        } else {
            // Redirect to the regular user page
            header("Location: ../html/HomePageLogIN.html");
        }

        exit;
    }
}
?>