<?php
$WebST = mysqli_query($db, "SELECT * FROM `web`");
$web = mysqli_fetch_array($WebST);

//content
$title 			= $web['title'];
$description 	= $web['description'];
$copyright 		= $web['copyright'];

//APi
$FacebookAppID 		= $web['fbappid'];
$FacebookAppSecret 	= $web['fbappsc'];
$GoogleApiKey 		= $web['ggapi'];