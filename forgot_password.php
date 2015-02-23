<?php

// echo phpinfo();

require 'functions/sql_helpers.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$user = sqlEscape($_POST['user']);
		$search_user = sqlSelect('SELECT user_id, username, email FROM users WHERE username = "' . $user . '" OR email = "' . $user . '"');
		if ($search_user) {

$to      = "$search_user[0]['email']";
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

      $to = $search_user[0]['email'];
      $subject = 'Glömt lösenord';
      $message = '<h1>Hej' . $search_user[0]['username'] . '</h1>';
      $message .= '<div>Du verkar ha glömt bort ditt lösenord. Klicka på länken nedanför för att återställa det.</div>';
      $message .= '<p><a href="#">Återställ lösenord.</a></p>';
      $from = 'Great nonsens <noreply@example.com>';
      if (mail($to, $subject, $message, $from)) {
        echo '<div>Du får snart ett mail.</div>';
      }
			//header('location: reset_password.php?user=' . $search_user[0]['user_id']);
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>True Story</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="vendor/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/css/ionicons.min.css">
  <link rel="shortcut icon" href="img/Story-favicon-3.png">
  <link href='http://fonts.googleapis.com/css?family=Courgette|Berkshire+Swash+Lato' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Cinzel+Decorative' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
  <link href="http://fonts.googleapis.com/css?family=Tangerine" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Niconne' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Damion' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Norican' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Meddon' rel='stylesheet' type='text/css'>

  <!-- JQUERY -->
  <script src="js/jquery-1.11.1.min.js"></script>

</head>
<body>

	<div id="wrapper">
		<form action="" method="post">
			Användarnamn eller email:<br />
			<input type="text" name="user"><br />
			<input type="submit" name="Skicka">
		</form>
		<a href="index.php">Avbryt</a>
	</div>

</body>
</html>