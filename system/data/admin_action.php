<?php
/* >_ Developed by Vy Nghia */
session_start();
require '../config.php';
require 'admin_info.php';

if(isset($_GET['action'])){
  switch ($_GET['action']) {
    case 'add':
      if(isset($_SESSION['admin']) && isset($_POST['role']) && isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']))
	  {
      $checkUser = mysqli_query($db, "SELECT * FROM `manager` WHERE `username` = '{$_POST['username']}'"); //Check user exists in SQL
          if(mysqli_fetch_array($checkUser) == false)
		  {
			  $q = mysqli_query($db, "SHOW TABLE STATUS LIKE 'manager'");
			  $r = mysqli_fetch_assoc($q);

			  echo json_encode(array("code" => 1, "id" => $r["Auto_increment"]));
			  
			  mysqli_query($db, "INSERT INTO `manager`(`id`, `username`, `password`, `name`, `roles`, `session_key`) VALUES ('', '{$_POST['username']}', '{$_POST['password']}', '{$_POST['name']}', '{$_POST['role']}', '')");
          } 
		  else
			echo json_encode(array("code" => 2));
      }
    break;

    case 'delete':
    if(isset($_SESSION['admin']))
	{
      if(isset($_POST['user']))
	  {
        if ($Level == 1)
		{
			mysqli_query($db, "DELETE FROM `manager` WHERE `username` = '{$_POST['user']}'");
        }
      }
    }
    break;
  }
}
