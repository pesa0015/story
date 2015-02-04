<?php

@$story = (int)$_GET['story'];

// Display LATEST row from table
// $sql_left = "SELECT COUNT(row_id) as total FROM `row`";
// $sql_left = "SELECT story.num_of_rows - COUNT(row.row_id) AS rows_left FROM `story`, `row`";
// SELECT DISTINCT(story.story_id) FROM `story` INNER JOIN `row` WHERE story.max_rows IN (SELECT COUNT(row.row_id) FROM `row` GROUP BY row.story_id);
$sql_rows_left = sqlSelect("SELECT max_rows - total_rows AS rows_left FROM `story` WHERE story_id = {$story}");

	if ($sql_rows_left) {
		foreach ($sql_rows_left as $row) {
			echo htmlspecialchars($row['rows_left']) . " rader kvar";
		}
	}

?>