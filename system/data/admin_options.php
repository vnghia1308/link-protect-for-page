<?php
/* Developed by Vy Nghia */
session_start();
require "../config.php";
require "admin_info.php";
if(isset($_SESSION["admin"]) && $Level == 1)
{
		if($_GET["opt"] == "google_short_link" && $_POST["v"] == 0 ||  $_POST["v"] == 1)
		{
			mysqli_query($db, "UPDATE `options` SET `google_short_link`='{$_POST["v"]}' WHERE 1");
		}
		
	mysqli_close($db);
}