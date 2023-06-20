<?php
session_destroy(); // Destroy all session data
header("Location: ../php/HomePage.php"); // Redirect to the homepage or any other page you want after logout
exit(); // Terminate the script
?>