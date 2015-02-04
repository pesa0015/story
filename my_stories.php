<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'header.php';

$sql_stories = sqlSelect('SELECT story_id FROM `story` WHERE admin = "' . $_SESSION['user_id'] . '"');

if ($sql_stories) {
	foreach ($sql_stories as $story_id) {
		echo '<div style="margin-bottom: 30px;"><div>No. ' . $story_id['story_id'] . '</div>';
		$sql_rows_left = sqlSelect('SELECT max_rows, total_rows, max_rows-total_rows AS rows_left FROM story WHERE story_id = "' . $story_id['story_id'] . '"');
		echo '<div>' . $sql_rows_left[0]['max_rows'] . '/' . $sql_rows_left[0]['total_rows'] . ' = ' . $sql_rows_left[0]['rows_left'] . ' rader kvar.</div>';
		$sql_story_writers = sqlSelect('SELECT DISTINCT(users.username) FROM `users` WHERE users.user_id IN (SELECT story_writers.user_id FROM story_writers WHERE story_writers.story_id = "' . $story_id['story_id'] . '") AND users.user_id != "' . $_SESSION['user_id'] . '"');
		foreach ($sql_story_writers as $writers) {
			echo '<div>' . $writers['username'] . '</div>';
		}
		$sql_latest = sqlSelect('SELECT words FROM `row` WHERE story_id = "' . $story_id['story_id'] . '" ORDER BY row_id DESC LIMIT 1;');
		foreach ($sql_latest as $latest) {
			echo '<div>' . $latest['words'] . '</div>';
		}
		$date = sqlSelect('SELECT date FROM row WHERE story_id = "' . $story_id['story_id'] . '" ORDER BY row_id DESC LIMIT 1;');

		foreach ($date as $row) {
		 	$date = new DateTime($row['date']);

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

			echo '<div>' . $day_name . '</div>';
		}

		echo '</div>';
	}
}

require 'footer.php';

?>