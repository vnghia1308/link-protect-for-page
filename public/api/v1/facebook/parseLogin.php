<?php
/* Developed by Vy Nghia */
if(!empty($_POST))
{
	$ar = array();
	
	if($_POST["j"])
	{
		$j = json_decode($_POST["j"], true);
		
		if(isset($j["error_code"]))
			$ar = array("error" => true, "message" => "Đăng nhập thất bại, đã xảy ra lỗi trong mã đăng nhập!");
		else
			if(isset($j["access_token"]))
				$ar = array("error" => false, "message" => $j["access_token"]);
			else
				$ar = array("error" => true, "message" => "Không thể xác định access_token");
	}
	else
		$ar = array("error" => true, "message" => "post is null");
	
	echo json_encode($ar);
}