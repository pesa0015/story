<?php

session_start();

if (!isset($_SESSION['user'])) {
	header('location: index.php');
}

require 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$pwd = sqlEscape($_POST['pwd']);

	if (strlen($pwd) > 3) {
		$password = sqlSelect('SELECT password FROM users WHERE user_id = ' . $_SESSION['user_id']);
		if (password_verify($pwd, $password[0]['password'])) {
			//sqlDelete('DELETE FROM users WHERE user_id = ' . $_SESSION['user_id']); 
			echo 'Kontot kommer att tas bort inom kort.';
		}
	}
}

?>

<h1>Ta bort konto</h1>

<form action="" method="post">
	Lösenord:<br />
	<input type="password" name="pwd"><br />
	<input type="submit" name="submit" value="Ta bort konto"><br />
</form>

<?php

require 'footer.php';

?>