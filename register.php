<?php

require 'functions/sql_helpers.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>True Story</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="vendor/css/bootstrap.min.css">
  <link rel="shortcut icon" href="img/Story-favicon-3.png">
  <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css">
  <link href='http://fonts.googleapis.com/css?family=Eagle+Lake|Courgette|Berkshire+Swash+Lato' rel='stylesheet' type='text/css'>

  <!-- JQUERY -->
  <script src="vendor/js/jquery-1.11.1.min.js"></script>
  <!-- NOTY - A JQUERY NOTIFICATION PLUGIN -->
  <script src="vendor/js/jquery.noty.packaged.min.js"></script>
  <!-- BOOTSTRAP -->
  <script src="vendor/js/bootstrap.min.js"></script>

</head>
<body>

	<div id="wrapper">

		<h1 id="page-logo-login-register">Great nonsens</h1>

    <div id="login-register-container">

		<form action="" method="post">
			<input type="text" id="user" name="user" placeholder="Användarnamn" oninput="inputUser();" value="<?php if(isset($errors)){ echo $_POST['user']; } ?>"><br />
      <div id="user_exists"></div>
			<input type="password" id="password" name="password" placeholder="Lösenord" oninput="inputPassword();" value="<?php if(isset($errors)){ echo $_POST['password']; } ?>"><br />
      <input type="password" id="password_repeat" name="password_repeat" oninput="inputPasswordRepeat();" placeholder="Upprepa lösenord" value="<?php if(isset($errors)){ echo $_POST['password_repeat']; } ?>"><br />
      <input type="email" id="email" name="email" placeholder="E-postadress" oninput="inputEmail();" value="<?php if(isset($errors)){ echo $_POST['email']; } ?>"><br />
      <div id="email_exists"></div>
      <?= @$errorEmail; ?>
			<input type="submit" name="submit" id="submit" onmouseover="checkAllInputs();" value="Skapa konto"><br />
		</form>

    <?php require 'functions/create_user.php'; ?>

    <a href="index.php" id="login-register-link">Logga in.</a>

    </div> <!-- END #LOGIN-REGISTER-CONTAINER -->

	</div> <!-- END #WRAPPER -->

  <script src="js/register.js"></script>
	
</body>
</html>