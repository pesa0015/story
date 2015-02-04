<?php

require 'sql_helpers2.php';

// Get Search
@$search_string = $_GET['subject'];

// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	// Build Query
	$query = sqlSelect('SELECT id, subject FROM subjects WHERE subject LIKE "%' . $search_string . '%" LIMIT 5');

	foreach ($query as $result) {
		echo '<li id="' . $result['id'] . '" class="result">' . htmlspecialchars($result['subject']) . '</li>';
	}
}

?>