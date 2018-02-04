<?php
	ini_set('max_execution_time', 80); //Sets that maximum execution time of the database to 80 sec
	include "config.php"; //Contains the part of the code that connects the page to the database
	include "yourDest.php"; //Contains the part of the code that takes in a district name and gets all available buses to the area
	include "timeManagement.php"; //Contains part or the code that gets the start times and end times of each trip & sorts out the time in Ascending order
	include "mapsProcess.php"; //Contains the part of the code that gives all the names of the bus stop information according to the selected bus
	include "getTravelTimes.php"; //Get travel times of a specific trip id
	include "getShapes.php"; //Contains the part of the code that sends the shapes file corresponding to the selected bus
	mysqli_close($con); //Closes the mysqli connection
	
	
	
	/*
			 ______________________________
	       //		                      \\
	       ||   _____________________      ||
	       ||  |_________   _________|     ||
	       ||	 	     | |               ||
	       ||            | |               ||
	       ||            | |   ______      ||
	       ||            | |  | ____ |     ||
	       ||            | |  | |  | |     ||
	       ||            | |  | |__| |     ||
	       ||            | |  | _____|     ||
	       ||            | |  | |          ||
	       ||            |_|  |_|          ||
	       ||                              ||
	       \\______________________________//
	       
	           MADE BY: ThePhoneix Ajaba
	
	*/
?>