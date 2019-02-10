<?php
/* Developed by Vy Nghia */
session_start();
require '../config.php';

if(isset($_SESSION['admin']) && isset($_POST))
{
  mysqli_query($con, "UPDATE `web` SET `title`= '{$_POST['title']}',`description`='{$_POST['description']}',`ggapi`='{$_POST['ggapikey']}',`fbappid`='{$_POST['fbappid']}',`fbappsc`='{$_POST['fbappsecret']}',`copyright`='{$_POST['copyright']}' WHERE 1");
  mysqli_close($con);
}