<?php

if (isset($_POST['edit_text'])) {

	$text = sqlEscape($_POST['update']);

	sqlUpdate('UPDATE users SET personal_text = "' . $text . '" WHERE user_id = "' . $_SESSION['user_id'] . '";');
	echo '<script>window.location.replace("profile_view.php");</script>';
}

?>