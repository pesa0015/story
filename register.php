<?php

// require 'functions/connect.php';

require '../connect_localhost.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>True Story</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="shortcut icon" href="img/Story-favicon-3.png">
  <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css">
  <link href='http://fonts.googleapis.com/css?family=Eagle+Lake|Courgette|Berkshire+Swash+Lato' rel='stylesheet' type='text/css'>

  <!-- JQUERY -->
  <script src="js/jquery-1.11.1.min.js"></script>
  <!-- NOTY - A JQUERY NOTIFICATION PLUGIN -->
  <script src="js/jquery.noty.packaged.min.js"></script>
  <!-- BOOTSTRAP -->
  <script src="js/bootstrap.min.js"></script>

</head>
<body>

	<div id="wrapper">

		<h1 id="page-logo-login-register">True Story</h1>

    <div id="login-register-container">

		<form action="" method="post">
      <?= @$error; ?>
			<input type="text" id="user" name="user" placeholder="Användarnamn" value="<?php if(isset($errors)){ echo $_POST['user']; } ?>"><br />
			<input type="password" id="password" name="password" placeholder="Lösenord" value="<?php if(isset($errors)){ echo $_POST['password']; } ?>"><br />
      <input type="password" id="password_repeat" name="password_repeat" placeholder="Upprepa lösenord" value="<?php if(isset($errors)){ echo $_POST['password_repeat']; } ?>"><br />
      <?= @$errorPasswordRepeat; ?>
      <input type="email" id="email" name="email" placeholder="E-postadress" value="<?php if(isset($errors)){ echo $_POST['email']; } ?>"><br />
      <?= @$errorEmail; ?>
			<input type="submit" name="submit" id="submit" value="Skapa konto"><br />
		</form>

    <?php require 'functions/create_user.php'; ?>

    <a href="index.php" id="login-register-link">Logga in.</a>

    </div> <!-- END #LOGIN-REGISTER-CONTAINER -->

	</div> <!-- END #WRAPPER -->
	
</body>
</html>