<?php
//Connect to database
$link = new mysqli("localhost", "root", "", "travelwebsite2");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}