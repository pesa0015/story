<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'header.php';

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="js/profile_live_update.js"></script>

<h1>Profil</h1>

<?php

require 'functions/upload_profile_img.php';

require 'functions/upload_and_replace_profile_img.php';

require 'functions/delete_profile_img.php';

require 'functions/profile_update.php';

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

	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" id="fileToUpload" name="fileToUpload"><br />
		<? 
		// User have profile image
		if (!empty($img['profile_img'])) { ?>
		<input type="hidden" name="hidden" value="<?php echo $img['profile_img']; ?>">
		<input type="submit" name="upload_and_replace" value="Ladda upp bild"><br />	
		<? }
		// User doesn't have profile image
		if (empty($img['profile_img'])) { ?>
    	<input type="submit" name="upload_new" value="Ladda upp bild"><br />
    	<? } ?>
    	<input type="hidden" name="hidden_delete" value="<?php echo $img['profile_img']; ?>">
    	<input type="submit" name="delete" value="Ta bort bild"><br />
	</form>

	<?

	$sql_text = sqlSelect('SELECT personal_text FROM `users` WHERE user_id = "' . $_SESSION['user_id'] . '"');

	?>

	<form action="" method="post">
		Personlig text
		<textarea rows="5" id="update" name="update" autocomplete="off" style="resize: vertical;"><?

			if ($sql_text) {
				foreach ($sql_text as $text) {
					echo htmlspecialchars($text['personal_text']);
				}
			}

			?>
		</textarea><br />
		<input type="submit" name="edit_text" value="Spara"><br />
	</form>

<?php require 'footer.php'; ?>