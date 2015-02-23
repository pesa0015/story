<?php

require 'sql_helpers2.php';

// Get Search
@$search_string = $_GET['email'];

// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	// Build Query
	$query = sqlSelect('SELECT email FROM users WHERE email = "' . $search_string . '" LIMIT 1');

	echo $query[0]['email'];
}

?>