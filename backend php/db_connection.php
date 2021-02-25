<?php
	
	require 'db_config.php';

	$conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);

	if($conn->connect_error){

		die("connection failed <p>" . $conn->connect_error ."</p>");

	}

?>