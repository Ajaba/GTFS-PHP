<?php
	if(isset($_GET["tripid"])) {
		$trip_id = $_GET["tripid"];
		$newarray = array();
		$newresult = array();
		//Get information about that one trip_id recieved from the function
		$newquery = mysqli_query($con, "SELECT arrival_time, stop_id FROM stop_times WHERE trip_id='$trip_id';");
		while($newRow = mysqli_fetch_array($newquery)) {
			$new_stop_id = $newRow["stop_id"];
			$newqueryData = mysqli_query($con, "SELECT stop_lat, stop_lon, stop_name FROM stops WHERE stop_id='$new_stop_id';");
			$newRowData = mysqli_fetch_array($newqueryData);
			$newarray["stop_name"] = $newRowData["stop_name"];
			$newarray["stop_lon"] = $newRowData["stop_lon"];
			$newarray["stop_lat"] = $newRowData["stop_lat"];
			$newarray["arrival_time"] = $newRow["arrival_time"];
			array_push($newresult, $newarray);
		}		
		echo json_encode($newresult);
	}
?>