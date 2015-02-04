<?php

$user = '';
$pass = '';
$pass_repeat = '';
$email = '';
$output = '';
$error = '';
$errorEmail = '';
$errorPasswordRepeat = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$user = mysqli_real_escape_string($conn, $_POST['user']);
	$pass = mysqli_real_escape_string($conn, $_POST['password']);
	$pass_repeat = mysqli_real_escape_string($conn, $_POST['password_repeat']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);

	$errors = array();

	if (strlen($user) >= 4) {
		$sql_username = "SELECT username FROM `users` WHERE username = '$user'";
		$result_username = mysqli_query($conn, $sql_username);
		$username = mysqli_fetch_array($result_username);
		if (!empty($username['username'])) {
			array_push($errors, "Användarnamnet är upptaget");
		}

  	}

	if (strlen($_POST['password']) < 3) {
		array_push($errors, "Lösenordet är för kort");
	}

	if ($_POST['password'] != $_POST['password_repeat']) {
		$errorPasswordRepeat = "Lösenordet matchar inte";
	}

	if (count($errors) == 0) {
  		$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$sql = "INSERT INTO `story_creator`.`users` (`user_id`, `username`, `password`, `email`) VALUES (NULL, '$user', '$pass', '$email');";

		if ($conn->query($sql) === TRUE) {
			echo '<span class="ion-checkmark-circled"></span><p>Nytt konto skapat!</p>';
		}

  	}

	//Prepare errors for output
  	foreach($errors as $val) {
    	$output .= "<p class='ion-thumbsdown'> $val</p>";
    	$error = "<div id='error'>" . @$output . "</div><br />";
  	}

}

?>