<?php

require 'sql_helpers2.php';

// Get Search
@$search_string = $_GET['username'];

// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	// Build Query
	$query = sqlSelect('SELECT user_id, username FROM users WHERE username LIKE "%' . $search_string . '%" LIMIT 5');

	foreach ($query as $result) {
		echo '<li class="result"><a href="player_info.php?user_id=' . $result['user_id'] . '">' . htmlspecialchars($result['username']) . '</a></li>';
	}
}

?>