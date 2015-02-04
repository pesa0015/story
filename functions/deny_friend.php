<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'connect.php';

$id = (int)$_GET['friend_request_id'];

if ($id) {
	$sql_deny = 'DELETE FROM `story_creator`.`friends` WHERE friend_request_id = "' . $id . '";';

	if ($conn->query($sql_deny) === TRUE) {
		header("Refresh:0; url=../friends.php");
	} 

	else {
	    echo "Error: " . $sql_deny . "<br>" . $conn->error;
	}
}

?>