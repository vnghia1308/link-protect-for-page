<?php
/* Developed by Vy Nghia */
session_start();
require '../config.php';

if(isset($_SESSION['admin'])){
	if($_POST['name']  !== "" && $_POST["pass"] !== ""){
		mysqli_query($db, "UPDATE `manager` SET `password`='{$_POST["pass"]}',`name`='{$_POST["name"]}' WHERE `username`='{$_SESSION["admin"]}'");
		mysqli_close($db);
	}
}