<?php
/* Developed by Vy Nghia */
session_start();
require '../config.php';
require 'admin_info.php';

if(isset($_SESSION['admin']) && $Level == 1 && isset($_POST))
{
	if(!empty($_POST["token"]))
		mysqli_query($db, "UPDATE settings SET access_token='{$_POST["token"]}'");
	else
		echo false;
}