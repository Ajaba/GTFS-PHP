<?php
	if(isset($_GET["selectedDest"]) && isset($_GET["goTown"])) {
		$selectedDest = $_GET["selectedDest"];
		$going_to_town = $_GET["goTown"];
		$route_id;
		$trip_id;
		$return_array = array();
		$sarray = array();
		//Getting the route id of the selected bus long name
		$query = mysqli_query($con, "SELECT route_id FROM routes WHERE route_long_name='$selectedDest';");
		$row = mysqli_fetch_array($query);
		$route_id = $row["route_id"];
		
		//Getting the trip id of the specific travel
		$queryf = mysqli_query($con, "SELECT trip_id FROM trips WHERE route_id='$route_id' AND direction_id='$going_to_town';");
		while($row = mysqli_fetch_array($queryf)) {
			$trip_id = $row["trip_id"];
			//Getting stop id in sequence of stop_sequence 
			$query = mysqli_query($con, "SELECT arrival_time, stop_id, stop_sequence FROM stop_times WHERE trip_id='$trip_id' ORDER BY stop_sequence ASC;");
			while($rows = mysqli_fetch_array($query)) {
				$sarray["trip_id"] = $trip_id ;
				//Getting details of each stop id
				$stop_id = $rows["stop_id"];
				$sarray["arrival_time"] = $rows["arrival_time"];
				$sarray["seq"] = $rows["stop_sequence"];
				
				$queryData = mysqli_query($con, "SELECT stop_lat, stop_lon, stop_name FROM stops WHERE stop_id='$stop_id';");
				$rowData = mysqli_fetch_array($queryData);
				$sarray["stop_name"] = $rowData["stop_name"];
				$sarray["stop_lon"] = $rowData["stop_lon"];
				$sarray["stop_lat"] = $rowData["stop_lat"];
				if(!in_array($sarray, $return_array)){
					array_push($return_array, $sarray);
				}
			}
		}
		$json = json_encode($return_array);
		check($json);
	}
?>