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
	$user = sqlEscape($_POST['user']);
	$pass = sqlEscape($_POST['password']);
	$pass_repeat = sqlEscape($_POST['password_repeat']);
	$email = sqlEscape($_POST['email']);

	$errors = array();

	/*

	if (strlen($user) >= 4) {
		$sql_username = sqlSelect("SELECT username FROM `users` WHERE username = '$user';");
		
		if (!empty($sql_username[0]['username'])) {
			array_push($errors, "Användarnamnet är upptaget");
		}

  	}

	if (strlen($_POST['password']) < 3) {
		array_push($errors, "Lösenordet är för kort");
	}

	if ($_POST['password'] != $_POST['password_repeat']) {
		$errorPasswordRepeat = "Lösenordet matchar inte";
	}

	*/

	if (strlen($user) >= 3 && strlen($pass) >= 3 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
  		$pass = password_hash($pass, PASSWORD_DEFAULT);
		$sql = sqlInsert("INSERT INTO users (user_id, username, password, email, registration_date) VALUES (NULL, '$user', '$pass', '$email', now());");

		echo '<span class="ion-checkmark-circled"></span><p>Nytt konto skapat!</p>';

  	}

	//Prepare errors for output
  	foreach($errors as $val) {
    	$output .= "<p class='ion-thumbsdown'> $val</p>";
    	$error = "<div id='error'>" . @$output . "</div><br />";
  	}

}

?>