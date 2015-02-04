<?php

require '../functions/connect.php';

$error = 0;

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

function sqlEscape($string) {

	// Create connection
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$escaped_string = mysqli_real_escape_string($conn, $string);

	// Check connection
	if (mysqli_errno($conn)) {
		echo "Failed: " . mysqli_error($conn);
	}

	return $escaped_string;

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
		echo "Failed: " . mysqli_error($conn);
		$error = 1;
	}

}

function sqlUpdate($query) {

	// Create connection
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	mysqli_query($conn, $query);

	// Check connection
	if (mysqli_errno($conn)) {
		echo "Failed: " . mysqli_error($conn);
		$error = 1;
	}

}

function sqlDelete($query) {

	// Create connection
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	mysqli_query($conn, $query);

	// Check connection
	if (mysqli_errno($conn)) {
		echo "Failed: " . mysqli_error($conn);
		$error = 1;
	}

}

function login($user, $password) {

	// Create connection
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$user = sqlEscape($_POST['user']);
  	$password = sqlEscape($_POST['password']);

  	$sql = "SELECT user_id, username, password FROM `users` WHERE username = '$user';";

  	$result = mysqli_query($conn, $sql);
  
  	$errors = array();
  
  	if ($result->num_rows == 0) {
    	$userError = 'Fel användarnamn';
  	}
    
  	if ($result->num_rows == 1) {
    	$row = mysqli_fetch_array($result);
    	$pwd = $row['password'];
    
    	if (password_verify($password, $pwd)) {
    		$_SESSION['user_id'] = $row['user_id'];
    $_SESSION['user'] = $user;
    header('location: home.php'); 
    	}
    
    	else {
      		$passwordError = 'Fel lösenord';
    	}
    }
}

?>