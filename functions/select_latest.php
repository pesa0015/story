<?php

@$story = (int)$_GET['story'];

// Display LATEST row from table
$sql_latest = sqlSelect("SELECT words FROM `row` WHERE story_id = {$story} ORDER BY row_id DESC LIMIT 1;");

if ($sql_latest) {
	foreach ($sql_latest as $row) {
		echo '<div id="recent-row">' . htmlspecialchars($row["words"]) . '<br /></div>';
	}
}

?>