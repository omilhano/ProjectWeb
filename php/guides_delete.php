<?php
include 'guides_config.php';

$g_id= $_GET['guide_id'];

$sql = "DELETE FROM guides WHERE id = $g_id";

$result = mysqli_query($link, $sql);

header('location:Profilepage.php');
