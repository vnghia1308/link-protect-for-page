<?php
/* >_ Developed by Vy Nghia */
require 'class/ProtectClass.php';
define('WEBURL', 'https://nghia.org');

$db = new Database;
$db->dbhost('localhost');
$db->dbuser('ctjoppmqhosting_vnghia');
$db->dbpass('1151985611');
$db->dbname('ctjoppmqhosting_nghia');

$db->connect(); // mysqli var is $db

include_once 'content.php';
include_once 'data/admin_api.php';
