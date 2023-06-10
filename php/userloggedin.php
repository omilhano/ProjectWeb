<?php
    session_start();
    
    // Check if session is started
    if (isset($_SESSION['username'])) {
        // Session is started
        // Add your code here
        echo "Session is started.";
    } else {
        // Session is not started
        // Add your code here
        echo "Session is not started.";
    }
?>