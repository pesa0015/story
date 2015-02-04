<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'sql_helpers2.php';

$id = (int)$_GET['friend_request_id'];

if ($id) {

	sqlUpdate('UPDATE `friends` SET `pending` = 1 WHERE `friend_request_id` = "' . $id . '";');
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>