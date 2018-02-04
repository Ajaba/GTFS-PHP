<?php
	function check($json) {
		$data = array();
		$result = array();
		$obj = json_decode($json);
		$num = count($obj);
		$prev = "";
		$veryfirsttime = true;
		$getStartTime = true;
		for($i = 0; $i < $num; $i++) {
			$trip = $obj[$i]->trip_id;
			//echo $trip . "<br />";
			if($veryfirsttime == true) {
				$prev = $obj[$i]->trip_id;
				$veryfirsttime = false;
			}
			if(($trip == $prev) && ($getStartTime == true)) {
				$data["trip_id"] = $trip;
				$data["start_time"] = $obj[$i]->arrival_time; 
				//echo $trip . ", " . $obj[$i]->arrival_time ."<br />";
				$prev = $trip;
				$getStartTime = false;
				//echo $i . "<br />";
			} else if(($trip != $prev) && ($getStartTime == false)) {
				$prev = $trip;
				$i--;
				//echo $prev . ", " . $obj[$i]->arrival_time ."<br />";
				$data["end_time"] = $obj[$i]->arrival_time;
				array_push($result, $data);
				$getStartTime = true;
			}
		}
		$json = json_encode($result);
		//echo $json;
		arrangeTime($json);
	}
	
	function arrangeTime($json) {
		$obj = json_decode($json);
		$nums = count($obj);
		$times = array();
		$adding = array();
		$results = array();
		for($i = 0; $i < $nums; $i++) {
			if(!in_array($obj[$i]->start_time, $times)) {
				array_push($times, $obj[$i]->start_time);
			}
		}
		sort($times);
		$num = count($times);
		$checkTimesForDup = array();
		for($i = 0; $i < $num; $i++) {
			for($y = 0; $y < $nums; $y++) {
				if($obj[$y]->start_time == $times[$i]) {
					if(!in_array($obj[$y]->start_time, $checkTimesForDup)) {
						array_push($checkTimesForDup, $obj[$y]->start_time);
						$adding["trip_id"] = $obj[$y]->trip_id;
						$adding["start_time"] = $obj[$y]->start_time;
						$adding["end_time"] = $obj[$y]->end_time;
						if(!in_array($adding, $results)) {
							array_push($results, $adding);
						}
					}
				}
			}
		}
		
		echo json_encode($results);
	}
?>