<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'header.php';

if (isset($_POST['invite'])) {
		echo 'test';
	
	//sqlInsert('INSERT INTO `story_writers` (`id`, `story_id`, `user_id`) VALUES (NULL, '34', '10');');
}

@$user_id = (int)$_GET['user_id'];

$sql_user = sqlSelect('SELECT username FROM `users` WHERE user_id = "' . $user_id . '";');

?>

<h1><?=$sql_user[0]['username']; ?></h1>

<?php

$width_height = 'width="100" height="100"';

$sql_img = sqlSelect('SELECT profile_img FROM `users` WHERE user_id = "' . $user_id . '";');

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

$sql_friend = sqlSelect('SELECT friend_request_id, user_id, friend_user_id, pending FROM `friends` WHERE user_id = "' . $_SESSION['user_id'] . '" AND friend_user_id = "' . $user_id . '" OR user_id = "' . $user_id . '" AND friend_user_id = "' . $_SESSION['user_id'] . '";');

if (@$sql_friend[0]['user_id'] == $_SESSION['user_id'] && $sql_friend[0]['friend_user_id'] == $user_id && $sql_friend[0]['pending'] == 0) {
	?>
	<h3>Vänförfrågan skickad. <a href="functions/delete_friend.php?friend_request_id=<?=$sql_friend[0]['friend_request_id']; ?>">Ångra</a></h3>
	<?
}

if (@$sql_friend[0]['user_id'] == $user_id && $sql_friend[0]['friend_user_id'] == $_SESSION['user_id'] && $sql_friend[0]['pending'] == 0) {
	?>
	<h3>Acceptera vänförfrågan</h3><h3><a href="functions/delete_friend.php?friend_request_id=<?=$sql_friend[0]['friend_request_id']; ?>">Ignorera</a></h3>
	<?
}

if (@empty($sql_friend[0]['user_id']) && empty($sql_friend[0]['friend_user_id'])) {
	?>
	<h3><a href="functions/add_friend.php?me=<?=$_SESSION['user_id']; ?>&friend=<?=$user_id; ?>">Skicka vänförfrågan</a></h3>
	<?
}

if ($sql_friend[0]['pending'] == 1) { ?>
	<h3>Vänner <span class="ion-checkmark-round" style="font-size: 1em;"></span></h3>
	<? } ?>
	<h3>Bjud in <?=$sql_user[0]['username']; ?> till story:</h3> 
		
			<?

			$sql_invite_story = sqlSelect(
				'SELECT DISTINCT(story_id) 
				FROM story_writers 
				WHERE user_id = "' . $_SESSION['user_id'] . '" 
				AND story_id NOT IN (
					SELECT story_id 
					FROM `story_writers` 
					WHERE user_id = "' . $user_id . '");');
			foreach ($sql_invite_story as $story) {
				echo '<input type="checkbox" name="invite" value="' . $story['story_id'] . '"> ' . $story['story_id'] . '<br />';
			}

			?>

<h2>Personlig text</h2>

<?

$sql_text = sqlSelect('SELECT personal_text FROM `users` WHERE user_id = "' . $user_id . '";');

if ($sql_text) {
	foreach ($sql_text as $text) {
		echo htmlspecialchars($text['personal_text']);
	}
}

?>

<?php require 'footer.php'; ?>