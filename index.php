<?php

session_start();

require 'functions/sql_helpers.php';

require 'functions/login.php';

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

  <script src="js/typed.js"></script>
  <script>
    $(function(){

        $("#typed").typed({
            strings: [
                      "Lorem ipsum dolor sit amet,", 
                      "consectetur adipiscing elit. Phasellus sodales", 
                      "lorem a faucibus vulputate. Morbi in ligula", 
                      "vitae eros ornare aliquam vitae eu dolor."
                      ],
            typeSpeed: 30,
            backDelay: 1500,
            loop: false,
            contentType: 'html', // or text
            // defaults to false for infinite loop
            loopCount: false,
            callback: function(){ foo(); },
            resetCallback: function() { newTyped(); }
        });

        $(".reset").click(function(){
            $("#typed").typed('reset');
        });

    });

    function newTyped(){ /* A new typed object */ }

    function foo(){ console.log("Callback"); }

    </script>

	<div id="wrapper">

		<h1 id="page-logo-login-register">Great nonsens</h1>
    <h4 style="text-align: center; margin-bottom: 50px;">Skriv några ord. Låt en vän fortsätta.</h4>

    <div id="login-register-container">

      <!--<div class="type-wrap">
        <span id="typed"></span>
      </div>-->

      <h5 style="text-align: center;"><a href="register.php" id="login-register-link">Skapa gratis konto</a><br />eller logga in:</h5>
  		
  		<form action="" method="post" id="login-form">
        <?php if (isset($check)) { echo $check[0]; } ?>
  			<input type="text" id="user" name="user" placeholder="Användarnamn" value=""><br />
  			<input type="password" id="password" name="password" placeholder="Lösenord" value=""><br />
  			<input type="submit" name="submit" id="submit" value="Logga in"><br />
  		</form>

      <a href="forgot_password.php">Glömt lösenord?</a>

    </div> <!-- END #LOGIN-REGISTER-CONTAINER -->

	</div> <!-- END #WRAPPER -->
	
</body>
</html>