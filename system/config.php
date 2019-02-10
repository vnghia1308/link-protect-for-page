<?php
/* >_ Developed by Vy Nghia */
require 'class/ProtectClass.php';
define('WEBURL', 'https://cloud.nghia.org');

$db = new Database;
$db->dbhost('localhost');
$db->dbuser('db_user');
$db->dbpass('db_pass');
$db->dbname('db_name');

$con = $db->connect(); // mysqli var is $con

include_once 'content.php';
include_once 'data/admin_api.php';
