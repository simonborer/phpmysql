<?php

	// You can change the string in quotes to whatever query
	// you'd like to run against your tables

	$sqlEmployees = "SELECT employee_id, CONCAT(employee_first_name, ' ', employee_last_name) AS name FROM employee";
	$sqlLocations = "SELECT * FROM bakery";
	$sqlTimeTable = "SELECT * FROM weekly_schedule";

?>
