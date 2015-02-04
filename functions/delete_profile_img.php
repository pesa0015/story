<?php

if (isset($_POST["delete"])) {

	$current_img = sqlEscape($_POST['hidden_delete']);

	if (!empty($current_img)) {

		unlink('profile/user_img/' . $current_img);
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "profile/user_img/" . "$_SESSION[user_id]" . ".$imageFileType");
		sqlUpdate('UPDATE users SET profile_img = "" WHERE user_id = "' . $_SESSION['user_id'] . '";');
		echo '<script>function test() { window.location.reload(); }</script>';
	}

	else {
		echo "<script>alert('Det finns ingen bild att ta bort.');</script>";
	}
}

?>