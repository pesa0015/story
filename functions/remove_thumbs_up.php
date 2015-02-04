<?php

require 'sql_helpers2.php';

@$story = (int)$_GET['story'];
@$user_id = (int)$_GET['user_id'];

$sql_thumbs_down = sqlDelete("DELETE FROM `thumbs_up` WHERE story_id = " . $story . " AND user_id = " . $user_id . ";");

header('Location: ' . $_SERVER['HTTP_REFERER']); 

?>