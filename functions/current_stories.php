<?php

	function stories() {

	return sqlSelect("SELECT DISTINCT(story_writers.story_id) 
		FROM `story_writers` 
		INNER JOIN story 
		WHERE story_writers.user_id = '" . $_SESSION['user_id'] . "' 
		AND story_writers.on_turn = 1 
		AND story.total_rows < story.max_rows;");

}

foreach (stories() as $row) {
	echo '<div><a href="app.php?story=' . $row['story_id'] . '">No ' . $row['story_id'] . '<br />';

	$writers = sqlSelect(
		"SELECT users.user_id, users.username 
		FROM users 
		INNER JOIN story_writers 
		WHERE users.user_id 
		IN (
			SELECT story_writers.user_id 
			FROM story_writers 
			WHERE story_writers.story_id = '" . $row['story_id'] . "' 
			AND story_writers.user_id != '" . $_SESSION['user_id'] . "'
			)
		GROUP BY user_id;");
	$num_of_writers = count($writers);
	$i = 0;

	foreach ($writers as $writers2) {
		if (++$i === $num_of_writers) {
			echo '<a href="player_info.php?user_id=' . $writers2['user_id'] . '">' . htmlspecialchars($writers2['username']) . '</a><br />';
		}
		else {
			echo '<a href="player_info.php?user_id=' . $writers2['user_id'] . '">' . htmlspecialchars($writers2['username']) . '</a>, ';
		}
	}

	$words = sqlSelect("SELECT words FROM row WHERE story_id = " . $row['story_id'] . " ORDER BY row_id DESC LIMIT 1;");

	echo htmlspecialchars($words[0]['words']) . '</a><br />';

	$date = sqlSelect("SELECT date FROM row WHERE story_id = " . $row['story_id'] . " ORDER BY row_id DESC LIMIT 1;");

	$date = new DateTime($date[0]['date']);

	$today = new DateTime();
	$yesterday = new DateTime('-1day');
	$this_year = new DateTime();

	switch(TRUE) {

		case $today->format('m-d') === $date->format('m-d'):
			$day_name = 'Idag ' . $date->format('H:i') . '';
		break;

		case $yesterday->format('m-d') === $date->format('m-d'):
			$day_name = 'Igår ' . $date->format('H:i') . '';
		break;

		case $this_year->format('Y') === $date->format('Y'):
			$day_name = $date->format('m/d H:i') . '';
		break;

		default:
			$day_name = $date->format('Y-m-d H:i');
	}
	
	echo "$day_name</div><br />"; 
}

?>