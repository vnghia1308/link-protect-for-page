<?php
/* Developed by Vy Nghia */
session_start();
require '../config.php';
require 'admin_info.php';

if(isset($_SESSION['admin']) && $Level == 1 && isset($_POST))
{
	if(!empty($_POST["page"]))
	{
		$p = explode("|", $_POST["page"]);
		mysqli_query($con, "UPDATE settings SET page_id='{$p[0]}', page_access_token='{$p[1]}'");
	}
	else
		echo false;
}