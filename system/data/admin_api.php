<?php
/* >_ Developed by Vy Nghia */
$WebCotent = mysqli_query($con, "SELECT * FROM `web`");
$api = mysqli_fetch_array($WebCotent);
$GoogleApiKey = $api["ggapi"];
