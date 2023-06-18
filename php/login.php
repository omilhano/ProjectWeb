<?php

$link = mysqli_connect('localhost', 'root', '', 'travelwebsite') or die("No connection");

session_start();

if (@$_REQUEST['logout'] == 1) {
    logout();
}

if (@$_POST['username'] && @$_POST['password']) {
    $uuser = mysqli_real_escape_string($link, $_POST['username']);
    $inputPassword = ($_POST['password']);

    $sql = "SELECT password, admin FROM user WHERE email='$uuser'";
    $result = mysqli_query($link, $sql);

    if (!$result || mysqli_num_rows($result) < 1) {
        exit;
    } else {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];
        $isAdmin = $row['admin'];

        if ($inputPassword != $storedPassword) {
            print('hello');
            exit;
        }

        $_SESSION['username'] = $uuser;

        if ($isAdmin == 1) {
            // Redirect to the admin page
            header("Location: HomePageAdmin.html");
        } else {
            // Redirect to the regular user page
            header("Location: HomePageLogIN.html");
        }

        exit;
    }
}
?>
