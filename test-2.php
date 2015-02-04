<?php

define ('DB_HOST', 'localhost');
define ('DB_USER', 'root');
define ('DB_PASSWORD', 'root');
define ('DB_NAME', 'test');

// Create connection
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

function sqlSelect($query) {

	// Create connection
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$result = mysqli_query($conn, $query);

	// Check connection
	if (mysqli_errno($conn)) {
		echo "Failed: " . mysqli_error($conn);
	}

	$resultArray = array();

	if ($result) { 

		while ($row = mysqli_fetch_array($result)) {
			$resultArray[] = $row;
		}
	}

	return $resultArray;

}

function sqlInsert($query) {

	// Create connection
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	mysqli_query($conn, $query);

	// Check connection
	if (mysqli_errno($conn)) {
		echo $query . '<br />' . mysqli_error($conn);
		$error = 1;
	}

}

function last_id() {

	// Create connection
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	return $id;

}

$query = "INSERT INTO table_1 (id) VALUES (NULL);";

mysqli_query($conn, $query);

printf ("New Record has id %d.\n", $conn->insert_id);

?>