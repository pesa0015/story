<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'sql_helpers2.php';

$me = (int)$_GET['me'];
$friend = (int)$_GET['friend'];

sqlInsert("INSERT INTO `friends` (`friend_request_id`, `user_id`, `friend_user_id`, `pending`) VALUES (NULL, '" . $me . "', '" . $friend . "', '0');");
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>