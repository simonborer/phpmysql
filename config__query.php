<?php

	// You can change the string in quotes to whatever query
	// you'd like to run against your tables

	$sqlEmployees = "SELECT employee_id, CONCAT(first_name, ' ', last_name) AS name FROM employees";
	$sqlLocations = "SELECT * FROM locations";
	$sqlTimeTable = "SELECT * FROM employee_schedule";

?>