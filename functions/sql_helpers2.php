<?php

// For main pages, outside the functions folder

require 'connect.php';

$error = 0;

function sqlSelect($query) {

	// Create connection
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$conn->set_charset('utf8mb4');

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
		echo $query . '<br />' . mysqli_error($conn);
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
		echo "Failed: " . mysqli_error($conn) . '<br />';
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
    	array_push($errors, 'Fel användarnamn');
    	return $errors;
  	}
    
  	if ($result->num_rows == 1) {
    	$row = mysqli_fetch_array($result);
    	$pwd = $row['password'];
    
    	if (password_verify($password, $pwd)) {
    		$_SESSION['user_id'] = $row['user_id'];
		    $_SESSION['user'] = $row['username'];

		    sqlInsert('INSERT INTO users_activity (id, user_id, login) VALUES (NULL, ' . $_SESSION['user_id'] . ', now());');

		    if (isset($_GET['story'])) {
		    	header('location: story.php?story=' . $_GET['story']);
		    }

		    else {
		    	header('location: home.php');
			}
    	}
    
    	else {
    		array_push($errors, 'Fel lösenord');
    		return $errors;
    	}
    }
}

function last_id() {

	// Create connection
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	return $conn->insert_id;

}

?>