<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'header.php';

$sql_subjects = sqlSelect('SELECT subject FROM subjects');

if ($sql_subjects) {
	foreach ($sql_subjects as $subject) {
		echo '<div>' . $subject['subject'] . '</div>';
	}
}

?>