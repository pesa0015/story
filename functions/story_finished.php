<?php

$finished_stories = sqlSelect("SELECT story.story_id FROM `story` WHERE story.total_rows = story.max_rows;");

if ($finished_stories) {
	foreach ($finished_stories as $row) {
		echo '<div><a href="story.php?story=' . htmlspecialchars($row['story_id']) . '">No ' . htmlspecialchars($row['story_id']) . '</a></div><br />';
	}
} 

else {
    echo '<div>Ingen story är färdig ännu.</div>';
}

?>