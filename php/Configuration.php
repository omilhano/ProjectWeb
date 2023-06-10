<?php
$link = mysqli_connect("localhost", "root", "", "phpmyadmin");

//chech connection
if($link == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}