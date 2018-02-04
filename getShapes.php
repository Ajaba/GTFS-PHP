<?php
	if(isset($_GET["getShape"])) {
		$result = array();
		$data = array();
		//get the trip_id from users
		$trip_id = $_GET["getShape"];
		//Get shape_id from database based on the trip_id
		$query = mysqli_query($con, "SELECT shape_id, direction_id FROM trips WHERE trip_id='$trip_id';");
		$row = mysqli_fetch_array($query);
		$shape_id = $row["shape_id"];
		$direction_id = $row["direction_id"];
		if($direction_id == 0) {
			$direction_id = "DESC";
		} else {
			$direction_id  = "ASC";
		}
		//get shape_pt_lat & shape_pt_lon from database based on shape_id
		$query = mysqli_query($con, "SELECT DISTINCT shape_pt_lat, shape_pt_lon FROM shapes WHERE shape_id='$shape_id' ORDER BY shape_pt_sequence $direction_id;");
		while($row = mysqli_fetch_array($query)) {
			$data["long"] = $row["shape_pt_lon"];
			$data["lat"] = $row["shape_pt_lat"];
			array_push($result, $data);
		}
		echo json_encode($result);
	}
?>