<?php

require 'connect.php';

$sql_delete = "DELETE FROM `story`;";

if ($conn->query($sql_delete) === TRUE) {
	$sql_update = "ALTER TABLE `story` AUTO_INCREMENT = 1;";
	if ($conn->query($sql_update) === TRUE) {
		header('location: ../app');
	}
	else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

	}

?>