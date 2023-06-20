<?php

$link = mysqli_connect('localhost', 'root', '', 'travelwebsite2') or die("No connection");

session_start(); 

if (@$_REQUEST['logout'] == 1) {
	logout();
}

if (@$_POST['username'] && @$_POST['password']){

	$uuser= mysqli_real_escape_string($link, $_POST['username']);
	$upass= md5($_POST['password']);

	$sql="SELECT id FROM user WHERE password='$upass' AND username='$uuser'";
	$result = mysqli_query($link, $sql);
	$num = mysqli_num_rows($result);

	// print $sql;
	// exit();

	if ($num<1) {
		form_login();
		exit; // after presenting form exits
	} else {
		$_SESSION['username'] = $uuser;  // guarda em sessao
	}
	
} else if (!@isset($_SESSION['username'])) { // nao vem do form 
	form_login();
	exit;   // after presenting form exits
} 


function form_login(){
	header("Location: loginform.php");
}


function logout(){
	unset($_SESSION['username']);
	//session_unset();  
	//session_destroy();  
	
	//after redirect to somewere	
	//form_login();
	header("Location: index.php");
}
?>
