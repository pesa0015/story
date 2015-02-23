<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$current = sqlEscape($_POST['current_pwd']);
	$new = sqlEscape($_POST['new_pwd']);

	if (strlen($current) > 3 && strlen($new) > 3) {
		$password = sqlSelect('SELECT password FROM users WHERE user_id = ' . $_SESSION['user_id']);
		if (password_verify($current, $password[0]['password'])) {
			$pass = password_hash($new, PASSWORD_DEFAULT);
			sqlUpdate('UPDATE users SET password = "' . $pass . '" WHERE user_id = ' . $_SESSION['user_id']); 
			echo 'Lösenordet har ändrats.';
		}
	}
}

?>

<h1>Ändra lösenord</h1>

<form action="" method="post">
	Nuvarande lösenord:<br />
	<input type="password" name="current_pwd"><br />
	Nytt lösenord:<br />
	<input type="password" name="new_pwd"><br />
	<input type="submit" name="submit" value="Spara"><br />
</form>

<?php

require 'footer.php';

?>