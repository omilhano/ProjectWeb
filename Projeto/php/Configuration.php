<?php
$link = mysqli_connect("localhost", "root", "", "travelwebsite2");

//chech connection
if($link == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}