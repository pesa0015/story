<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'header.php';

?>

<style>
	ul#friends {
		list-style: none;
	}
	ul#friends li:hover {
		background: #485563;
	}
</style>

<?

$sql_friends = sqlSelect('SELECT friends.friend_request_id, users.user_id, users.username 
	FROM users 
	INNER JOIN 
		( 
			SELECT friends.friend_request_id, 
			CASE WHEN friends.user_id = "' . $_SESSION['user_id'] . '" THEN friends.friend_user_id 
			ELSE friends.user_id END person_id 
			FROM friends 
			WHERE (friends.user_id = "' . $_SESSION['user_id'] . '" 
			OR friends.friend_user_id = "' . $_SESSION['user_id'] . '") 
			AND pending = 1 
		)	friends ON users.user_id = friends.person_id;');

?>

<h1>Mina stories</h1>

<div>Välj stories där:</div>

<ul style="list-style: none; line-height: 150%;">
	<li><a href="my_stories.php?mode=one_admin">endast jag är admin</a></li>
	<li><a href="my_stories.php?mode=one_admin&story=not_flexible">endast jag är admin <span style="font-weight: 700;">och</span> storyn inte är flexibel</a></li>
	<li><a href="my_stories.php?mode=one_admin&story=flexible">endast jag är admin <span style="font-weight: 700;">och</span> storyn är flexibel</a></li>
	<li><a href="my_stories.php?mode=multiple_admins">alla är admins</a></li>
	<li><a href="my_stories.php?mode=multiple_admins&story=not_flexible">alla är admins <span style="font-weight: 700;">och</span> storyn inte är flexibel</a></li>
	<li><a href="my_stories.php?mode=multiple_admins&story=flexible">alla är admins <span style="font-weight: 700;">och</span> storyn är flexibel</a></li>
	<li><a href="my_stories.php?story=flexible">storyn är flexibel</a></li>
	<li><a href="my_stories.php?story=not_flexible">storyn inte är flexibel</a></li>
</ul>

<?

if (isset($_GET['mode']) || isset($_GET['story'])) {
	if (@$_GET['mode'] == 'one_admin') {
		$sql_stories = sqlSelect(
		'SELECT story.story_id 
		FROM `story` 
		INNER JOIN story_writers 
		ON story.story_id = story_writers.story_id 
		WHERE story_writers.user_id = "' . $_SESSION['user_id'] . '" 
		AND story.admin = "' . $_SESSION['user_id'] . '";'
		);
	}

	else if (@$_GET['mode'] == 'one_admin' && @$_GET['story'] == 'not_flexible') {
		$sql_stories = sqlSelect(
		'SELECT story.story_id 
		FROM `story` 
		INNER JOIN story_writers 
		ON story.story_id = story_writers.story_id 
		WHERE story_writers.user_id = "' . $_SESSION['user_id'] . '"
		AND story.admin = "' . $_SESSION['user_id'] . '"
	    AND story.flexible = "No";'
		);
	}

	else if (@$_GET['mode'] == 'one_admin' && @$_GET['story'] == 'flexible') {
		$sql_stories = sqlSelect(
		'SELECT story.story_id 
		FROM `story` 
		INNER JOIN story_writers 
		ON story.story_id = story_writers.story_id 
		WHERE story_writers.user_id = "' . $_SESSION['user_id'] . '"
		AND story.admin = "' . $_SESSION['user_id'] . '"
	    AND story.flexible = "Yes";'
		);
	}

	else if (@$_GET['mode'] == 'multiple_admin') {
		$sql_stories = sqlSelect(
		'SELECT story.story_id 
		FROM `story` 
		INNER JOIN story_writers 
		ON story.story_id = story_writers.story_id 
		WHERE story_writers.user_id = "' . $_SESSION['user_id'] . '"
		AND story.admin IS NULL;'
		);
	}

	else if (@$_GET['mode'] == 'multiple_admin' && @$_GET['story'] == 'not_flexible') {
		$sql_stories = sqlSelect(
		'SELECT story.story_id 
		FROM `story` 
		INNER JOIN story_writers 
		ON story.story_id = story_writers.story_id 
		WHERE story_writers.user_id = "' . $_SESSION['user_id'] . '" 
		AND story.admin IS NULL
		AND story.flexible = "No";'
		);
	}

	else if (@$_GET['mode'] == 'multiple_admin' && @$_GET['story'] == 'flexible') {
		$sql_stories = sqlSelect(
		'SELECT story.story_id 
		FROM `story` 
		INNER JOIN story_writers 
		ON story.story_id = story_writers.story_id 
		WHERE story_writers.user_id = "' . $_SESSION['user_id'] . '" 
		AND story.admin IS NULL
		AND story.flexible = "Yes";'
		);
	}

	else if (@$_GET['story'] == 'not_flexible') {
		$sql_stories = sqlSelect(
		'SELECT story.story_id 
		FROM `story` 
		INNER JOIN story_writers 
		ON story.story_id = story_writers.story_id 
		WHERE story_writers.user_id = "' . $_SESSION['user_id'] . '" 
		AND story.flexible = "No";'
		);
	}

	else if (@$_GET['story'] == 'flexible') {
		$sql_stories = sqlSelect(
		'SELECT story.story_id 
		FROM `story` 
		INNER JOIN story_writers 
		ON story.story_id = story_writers.story_id 
		WHERE story_writers.user_id = "' . $_SESSION['user_id'] . '" 
		AND story.flexible = "Yes";'
		);
	}
}

else {
	$sql_stories = sqlSelect(
		'SELECT story.story_id 
		FROM `story` 
		INNER JOIN story_writers 
		ON story.story_id = story_writers.story_id 
		WHERE story_writers.user_id = "' . $_SESSION['user_id'] . '";' 
		);
}

if (@$sql_stories) {
	echo '<ul>';
	foreach ($sql_stories as $story_id) { 
		?>
		<div style="margin-bottom: 30px;"><div>No. <?=$story_id['story_id']; ?> - <?
		$sql_subject = sqlSelect(
		'SELECT subjects.subject 
		FROM subjects 
		INNER JOIN story 
		ON subjects.id = story.subject 
		WHERE story_id = "' . $story_id['story_id'] . '"'
		); ?><?=@$sql_subject[0]['subject'];
		?>
		</div>
		<?
		$sql_rows_left = sqlSelect(
			'SELECT max_rows, total_rows, max_rows-total_rows AS rows_left 
			FROM story 
			WHERE story_id = "' . $story_id['story_id'] . '"'
			);
		?>
		<div><?=$sql_rows_left[0]['max_rows'] . '/' . $sql_rows_left[0]['total_rows'] . ' = ' . $sql_rows_left[0]['rows_left'] . ' rader kvar.</div>';
		$sql_story_writers = sqlSelect(
			'SELECT DISTINCT(users.username) 
			FROM `users` 
			WHERE users.user_id 
				IN (
					SELECT story_writers.user_id 
					FROM story_writers 
					WHERE story_writers.story_id = "' . $story_id['story_id'] . '"
					) 
		AND users.user_id != "' . $_SESSION['user_id'] . '"');
		foreach ($sql_story_writers as $writers) {
			?>
			<div><?=$writers['username']; ?></div>
			<?
		}
		$sql_latest = sqlSelect(
			'SELECT words 
			FROM `row` 
			WHERE story_id = "' . $story_id['story_id'] . '" 
			ORDER BY row_id DESC LIMIT 1;'
			);
			?>
			<div><?=$sql_latest[0]['words']; ?></div>
			<?
		$date = sqlSelect(
			'SELECT date 
			FROM row 
			WHERE story_id = "' . $story_id['story_id'] . '" 
			ORDER BY row_id DESC LIMIT 1;'
			);

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
			?>
			<div><?=$day_name; ?></div>
			<div><a href="invite_<?=$story_id['story_id']; ?>" class="spoilerButton" onClick="selectTextarea(event);">Bjud in andra<span class="caret"></span></a>
			</div>
				<div id="invite_<?=$story_id['story_id']; ?>" style="display: none;">
							<textarea rows="2" class="textarea invite_<?=$story_id['story_id']; ?>" name="users" autocomplete="off" placeholder="Bjud in författare..." value="" style="resize: vertical;"></textarea><br />
							<div><a href="choose_friends_<?=$story_id['story_id']; ?>" class="spoilerButton">Välj bland vänner<span class="caret"></span></a></div>
							<div id="choose_friends_<?=$story_id['story_id']; ?>" style="display: none;">
								<?
								if ($sql_friends) {
									echo '<ul id="friends" class="list-group" onclick="selectFriend(event);">';
									foreach ($sql_friends as $friend) { 
										echo '<li class="list-group-item invite_' . $story_id['story_id'] . '" style="cursor: pointer;">' . $friend['username'] . '</li>';
									}
									echo '</ul>';
								}
								?>
						</div>
				</div>
		</div>
		<?
	}
	echo '</ul>';
}

else {
	echo 'Det finns inga stories att visa :(';
}

?>

<!-- JQUERY -->
<script src="vendor/js/jquery-1.11.1.min.js"></script>
<!-- BOOTSTRAP -->
<script src="vendor/js/bootstrap.min.js"></script>
<!-- NOTY - A JQUERY NOTIFICATION PLUGIN -->
<script src="vendor/js/jquery.noty.packaged.min.js"></script>
<!-- SPOILER FUNCTION -->
<script src="js/spoiler.js"></script>

<script>
	function selectTextarea(event) {
		return event.target;
	}
</script>
<script>
			    function selectFriend(event) {
			    	var textarea = document.getElementsByClass("textarea" + selectTextarea(event));
			    	var li_result = document.getElementsByClassName("list-group-item" + selectTextarea(event));
			        var target = event.target || event.srcElement;
			        if (target) {
			        	if (target.value == 1) {
			        		document.getElementsByClass("textarea" + selectTextarea()).value = textarea.value.replace(target.innerText + '; ', '');
			        		var span_ion = document.getElementsByClassName('ion-close-round ' + target.innerText); 
			        		span_ion[0].parentNode.removeChild(span_ion[0]);
			        		target.value = 0;
			        		
			        	} 
			        	else {
			        		textarea.value += target.innerHTML + '; ';
			        		target.innerHTML += '<span class="ion-close-round ' + target.innerText + '" style="font-size: 1em; color: #CD3700; float: right;"></span>';
			        		target.value = 1;
			        	}
			        }
			    }
			    </script>

<?

require 'footer.php';

?>