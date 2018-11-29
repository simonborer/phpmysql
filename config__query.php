<?php

	// You can change the string in quotes to whatever query
	// you'd like to run against your tables

	$sqlEmployees = "SELECT employee_id, CONCAT(employee_fname, ' ', employee_lname) AS name FROM bakery_employees";
	$sqlLocations = "SELECT * FROM bakery_stores";
	$sqlTimeTable = "SELECT * FROM schedule";
	$sqlBakeryMenu = "SELECT food_name as \"Item Name\",
	    	food_type as Type,
	    	ROUND(sell_price, 2) as Cost
	    FROM food_items";
?>