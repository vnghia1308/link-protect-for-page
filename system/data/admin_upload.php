<?php
session_start();
if(isset($_SESSION['admin'])){
	if (isset($_FILES)) {
		if(is_array($_FILES)) {
			if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
				$Type = str_replace('image/','',$_FILES['userImage']['type']);
				$sourcePath = $_FILES['userImage']['tmp_name'];
				$targetPath = "../../ads/img/".time().'.'.$Type;
				if(move_uploaded_file($sourcePath,$targetPath)) {
				}
			}
		}
	}
}
