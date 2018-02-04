<?php
	ob_start();
	session_start();
	$timeszone = date_default_timezone_set("Africa/Addis_Ababa");

	$con = mysqli_connect("#", "#", "#", "#");
	if(mysqli_connect_errno()) {
		echo "Failed to connect: " . mysqli_connect_errno();
		die();
	}
?>