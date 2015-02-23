<?php

$finished_stories = sqlSelect("SELECT DISTINCT(story.story_id) FROM `story` INNER JOIN story_writers WHERE story.total_rows = story.max_rows AND story_writers.user_id = {$_SESSION['user_id']};");

if ($finished_stories) {
	foreach ($finished_stories as $row) {
		echo '<div><a href="story.php?story=' . htmlspecialchars($row['story_id']) . '">No ' . htmlspecialchars($row['story_id']) . '</a></div>';
		// echo '<div><a href="story/' . htmlspecialchars($row['story_id']) . '">No ' . htmlspecialchars($row['story_id']) . '</a></div>';

		$views = sqlSelect(
			'SELECT views
			FROM `story` 
			WHERE story_id = "' . $row['story_id'] . '";');
		echo '<div>' . $views[0]['views'] . ' visningar</div>';

		$thumbs_up = sqlSelect('SELECT COUNT(user_id) FROM `thumbs_up` WHERE story_id = "' . $row['story_id'] . '"');
		$thumbs_down = sqlSelect('SELECT COUNT(user_id) FROM `thumbs_down` WHERE story_id = "' . $row['story_id'] . '"');

		echo '<div><span class="ion-thumbsup" style="font-size: 1.5em;"></span>      ' . $thumbs_up[0]['COUNT(user_id)'] . '     <span class="ion-thumbsdown" style="font-size: 1.5em;"></span>     ' . $thumbs_down[0]['COUNT(user_id)'] . '</div>';
	}
} 

else {
    echo '<div>Ingen story är färdig ännu.</div>';
}

?>