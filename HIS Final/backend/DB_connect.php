<?php

function dbconnection()
{
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "campusconnect";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection Failed due to ->" . $conn->connect_error);
	}
	return $conn;
}
