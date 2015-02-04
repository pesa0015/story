<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'header.php';

?>

<h1>Profil</h1>

<h3><a href="profile_edit.php">Redigera</a></h3>

<?php

$width_height = 'width="100" height="100"';

$sql_img = sqlSelect('SELECT profile_img FROM `users` WHERE user_id = ' . $_SESSION['user_id'] . ';');

if ($sql_img) {
	foreach ($sql_img as $img) {
		if (empty($img['profile_img'])) {
			echo '<img src="profile/user_img/default.png" ' . $width_height . ' alt="Profilbild">';
		}
		if (!empty($img['profile_img'])) {
			echo '<img src="profile/user_img/' . $img['profile_img'] . '" ' . $width_height . ' alt="Profilbild">';
		}
	}
}

?>

<h2>Stories jag gillar</h2>

<?

$sql_stories = sqlSelect('SELECT story_id FROM `thumbs_up` WHERE user_id = ' . $_SESSION['user_id'] . ';');

if ($sql_stories) {
	
	foreach ($sql_stories as $story_id) { ?>
		<a href="story.php?story=<?=$story_id['story_id']; ?>"><?=$story_id['story_id']; ?></a><a href="functions/remove_thumbs_up.php?story=<?=$story_id['story_id']; ?>&user_id=<?=$_SESSION['user_id']; ?>"> Sluta gilla</a>
	<? }
}

?>

<h2>Personlig text</h2>

	<?

	$sql_text = sqlSelect('SELECT personal_text FROM `users` WHERE user_id = "' . $_SESSION['user_id'] . '"');

			if ($sql_text) {
				foreach ($sql_text as $text) {
					echo htmlspecialchars($text['personal_text']);
				}
			}

			?>

<?php require 'footer.php'; ?>