<?php
/* Developed by Vy Nghia */
session_start();
require '../config.php';

if(isset($_POST['username']) && isset($_POST['password'])){
	$checkUser = mysqli_query($con, "SELECT * FROM `manager` WHERE `username` = '{$_POST['username']}'");
	if(mysqli_fetch_array($checkUser) === false)
		echo (2);
		else {
			$checkUserPass = mysqli_query($con, "SELECT * FROM `manager` WHERE `username` = '{$_POST['username']}' AND `password` = '{$_POST['password']}'");
		if(mysqli_fetch_array($checkUserPass) === false)
			echo (3);
		else {
			echo (1);
			$_SESSION['admin'] = $_POST['username'];
		}
	}
}
