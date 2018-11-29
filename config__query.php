<?php

	// You can change the string in quotes to whatever query
	// you'd like to run against your tables

	$sqlEmployees = "SELECT employee_id, CONCAT(first_name, ' ', last_name) AS name FROM bakery_employees";
	$sqlLocations = "SELECT * FROM bakery_locations";
	$sqlTimeTable = "SELECT * FROM schedule";

?>