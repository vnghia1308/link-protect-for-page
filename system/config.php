<?php
/* >_ Developed by Vy Nghia */
require 'class/ProtectClass.php';
define('WEBURL', 'https://nghia.org');

$db = new Database;
$db->dbhost('localhost');
$db->dbuser('username');
$db->dbpass('password');
$db->dbname('db_name');

$db->connect(); // mysqli var is $db

include_once 'content.php';
include_once 'data/admin_api.php';
