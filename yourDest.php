<?php
	$long = "";
	$lat = "";
	$dest = "";
	$data = array();
	$result = array();
	if(isset($_GET["dest"]) && isset($_GET["day"]) && isset($_GET["goTown"])) {
		$dest = $_GET["dest"];
		$day = $_GET["day"];
		$gotown = $_GET["goTown"];
		//$gotown = 1;
		//check what service_id to use on a particular day
		$service = mysqli_query($con, "SELECT service_id FROM calendar WHERE $day=1;");
		while($serve = mysqli_fetch_array($service)) {
			$service_id = $serve["service_id"];
			
			//Search for the route long name in stops, stop_name
			$query = mysqli_query($con, "SELECT stop_id FROM stops WHERE stop_name LIKE '%$dest%';");
			//Check if the number of rows in the recieved query is greater than 1
			if(mysqli_num_rows($query) > 0) {
				while($row = mysqli_fetch_array($query)) {
					$stop_id = $row["stop_id"];
					//for each stop_id, you get the trip_id from stop_times
					$query2 = mysqli_query($con, "SELECT trip_id FROM stop_times WHERE stop_id='$stop_id';");
					//for each trip_id, you get the route_id from trips
					while($row2 = mysqli_fetch_array($query2)) {
						$trip_id = $row2["trip_id"];
						// AND direction_id=1 AND service_id='$service_id'
						$query3 = mysqli_query($con, "SELECT route_id FROM trips WHERE trip_id='$trip_id' AND direction_id='$gotown' AND service_id='$service_id';");
						//For each route_id, get a route long name from routes
						while($row3 = mysqli_fetch_array($query3)) {
							$route_id = $row3["route_id"];
							$query4 = mysqli_query($con, "SELECT DISTINCT route_long_name, route_short_name FROM routes WHERE route_id='$route_id';");
							//for each route long name add to fetch
							while($row4 = mysqli_fetch_array($query4)) {
								$data["route_long_name"] = $row4["route_long_name"];
								$data["route_short_name"] = $row4["route_short_name"];
								if(!in_array($data, $result)) {
									array_push($result, $data);
								}
							}
						}
					}
				}
			}
		}
		
		//Check if the number of contents in the result array is larger than 0
		if(count($result) > 0) {
			echo json_encode($result);
		} else {
			echo "Location not found";
		}
	}
?>