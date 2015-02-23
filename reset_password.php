<?php

require 'functions/sql_helpers.php';

$user = sqlSelect('SELECT username FROM users WHERE user_id = ' . $_GET['user']);

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
		<?=$user[0]['username']; ?>
		<form action="" method="post">
			<input type="password"><br />
			<input type="submit" name="submit" value="Ändra lösenord">
		</form>
		<a href="index.php">Avbryt</a>
	</div>
</body>
</html>