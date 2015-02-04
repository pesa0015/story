<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'sql_helpers2.php';

$id = (int)$_GET['friend_request_id'];

if ($id) {
	sqlDelete('DELETE FROM `friends` WHERE friend_request_id = "' . $id . '";');
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

?>