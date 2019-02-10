<?php
/* Developed by Vy Nghia */
if(isset($_SESSION['admin'])){
  $checkAdminUser = mysqli_query($con, "SELECT * FROM `manager` WHERE `username` = '{$_SESSION['admin']}'");

  while($ADMIN = mysqli_fetch_array($checkAdminUser))
  {
  	$Name = $ADMIN['name'];
  	$Level = $ADMIN['roles'];
  }
}
