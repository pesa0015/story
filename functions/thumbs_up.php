<?php

require 'sql_helpers2.php';

@$story = (int)$_GET['story'];
@$user_id = (int)$_GET['user_id'];

if (@$_GET['id']) {
	sqlDelete("DELETE FROM `thumbs_down` WHERE id = " . $_GET['id'] . ";");
}

$sql_thumbs_down = sqlInsert("INSERT INTO `thumbs_up` (story_id, user_id) VALUES (" . $story . ", " . $user_id . ");");

header('Location: ' . $_SERVER['HTTP_REFERER']); 

?>