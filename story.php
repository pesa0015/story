<?php

require 'functions/sql_helpers.php';

session_start();

@$story = (int)$_GET['story'];

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
  <script src="js/jquery.confirm.min.js"></script>

  <style>
  a {
  	color: #959EA7;
  }
  a:hover {
  	color: #959EA7;
  }
  </style>

</head>
<body>

	<?php if (isset($_SESSION['user_id'])) {
		require 'nav.php';
	}

	else { ?>
		<div id="nav" class="navbar navbar-default">
		  <div class="navbar-header">
		    <ul class="nav navbar-nav" style="text-align: center;">
		      <li style="display: inline-block;"><a href="return.php?story=<?=$story; ?>">Logga in</a></li>
		      <li style="display: inline-block; padding-top: 11px;">|</li>
		      <li style="display: inline-block;"><a href="register.php">Registrera</a></li>
		      <span class="ion-close-round" onClick="close_nav();" style="font-size: 1.5em; display: inline-block; margin-left: 100px; cursor: pointer;"></span>
		    </ul>
		  </div>
		  
		</div>
	<? } ?>

	<div id="wrapper">

		<h1 id="page-logo">T</h1>

			<hr />

			<div id="story-content">

				<?php

				$sql_words = sqlSelect("SELECT words FROM `row` WHERE story_id = {$story}");

				foreach ($sql_words as $row) {
					echo $row['words'] . ' ';
				} 

				?>

			</div> <!-- END #STORY-CONTENT -->

			<hr />

			<?

				$thumbs_up = sqlSelect("SELECT COUNT(user_id) AS thumbs_up FROM `thumbs_up` WHERE story_id = {$story}");
				$thumbs_down = sqlSelect("SELECT COUNT(user_id) AS thumbs_down FROM `thumbs_down` WHERE story_id = {$story}");

				if (isset($_SESSION['user_id'])) { 
					$sql_if_thumbs_up = sqlSelect("SELECT id FROM `thumbs_up` WHERE user_id = '" . $_SESSION['user_id'] . "' AND story_id = {$story};");
					$sql_if_thumbs_down = sqlSelect("SELECT id FROM `thumbs_down` WHERE user_id = '" . $_SESSION['user_id'] . "' AND story_id = {$story};");
					if ($sql_if_thumbs_up) { ?>
						<a href="functions/remove_thumbs_up.php?story=<?=$story; ?>&user_id=<?=$_SESSION['user_id']; ?>"><span id="thumbsup" class="ion-thumbsup" style="cursor: pointer;"></span></a>
					<? }
					else { 
						if (@!$sql_if_thumbs_down) { ?>
							<a href="functions/thumbs_up.php?story=<?=$story; ?>&user_id=<?=$_SESSION['user_id']; ?>"><span class="ion-thumbsup" style="cursor: pointer;"></span></a>
					<?	}
						if (@$sql_if_thumbs_down) { ?>
							<a href="functions/thumbs_up.php?story=<?=$story; ?>&user_id=<?=$_SESSION['user_id']; ?>&id=<?=$sql_if_thumbs_down[0]['id']; ?>"><span class="ion-thumbsup" style="cursor: pointer;"></span></a>
					<? } } 
				}
				if (!isset($_SESSION['user_id'])) { ?>
					<span class="ion-thumbsup complexConfirm" style="cursor: pointer;"></span>
				<? } ?>
					<span>
						<?
						if (@$thumbs_up[0]['thumbs_up'] == 0) {
						 	echo 'Ingen gillar den här storyn just nu :(';
						}
						else if (@$thumbs_up[0]['thumbs_up'] == 1 && @$sql_if_thumbs_up) {
						 	echo 'Du gillar den här storyn';
						} 
						else {
							if (@!$sql_if_thumbs_up) {
								echo $thumbs_up[0]['thumbs_up'] . ' gillar den här storyn.';
							}
							if (@$sql_if_thumbs_up) {
								echo 'Du och ' . $thumbs_up[0]['thumbs_up'] . ' andra gillar den här storyn.'; 
							}
						} ?>
					</span>
					<br />
				<?
				if (isset($_SESSION['user_id'])) { 
					if ($sql_if_thumbs_down) { ?>
						<a href="functions/remove_thumbs_down.php?story=<?=$story; ?>&user_id=<?=$_SESSION['user_id']; ?>"><span id="thumbsdown" class="ion-thumbsdown" style="cursor: pointer;"></span></a>
					<? }
					else { 
						if (@!$sql_if_thumbs_up) { ?>
							<a href="functions/thumbs_down.php?story=<?=$story; ?>&user_id=<?=$_SESSION['user_id']; ?>"><span class="ion-thumbsdown" style="cursor: pointer;"></span></a>
					<?	}
						if (@$sql_if_thumbs_up) { ?>
						<a href="functions/thumbs_down.php?story=<?=$story; ?>&user_id=<?=$_SESSION['user_id']; ?>&id=<?=$sql_if_thumbs_up[0]['id']; ?>"><span class="ion-thumbsdown" style="cursor: pointer;"></span></a>
					<? }
					}
				}
				if (!isset($_SESSION['user_id'])) { ?>
					<span class="ion-thumbsdown complexConfirm" style="cursor: pointer;"></span>
				<? } ?>
					<span>
						<?
						if (@$thumbs_down[0]['thumbs_down'] == 0) {
						 	echo 'Ingen är missnöjd den här storyn just nu.';
						}
						else if (@$thumbs_down[0]['thumbs_down'] == 1 && @$sql_if_thumbs_down) {
						 	echo 'Du gillar inte den här storyn.';
						}  
						else {
							if (@!$sql_if_thumbs_down) {
								echo $thumbs_down[0]['thumbs_down'] . ' gillar inte den här storyn.';
							}
							if (@$sql_if_thumbs_down) {
								echo 'Du och ' . $thumbs_down[0]['thumbs_down'] . ' andra gillar inte den här storyn.'; 
							}
						} ?>
					</span>
				
			
			</div> <!-- END #STORY-CONTENT -->

			<script>
			$(".complexConfirm").confirm({
    title:"Du är inte inloggad",
    text:"Du måste logga in för att kunna göra din röst hörd :)",
    confirm: function(button) {
        window.location.replace("return.php?story=<?=$story; ?>");
    },
    confirmButton: "Logga in",
    cancelButton: "Avbryt"
});
			</script>

			<script>
				function close_nav() {
					var nav = document.getElementById('nav');
					nav.parentNode.removeChild(nav);
				}
			</script>
			<!-- BOOTSTRAP -->
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

<?php require 'footer.php'; ?>