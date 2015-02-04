<?php

session_start();

if (!isset($_SESSION['user'])) {
  header('location: index.php');
}

require 'header.php';

$error = "";
$not_sent = "";
$correct = "";

@$story = (int)$_GET['story'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // collect all input and trim to remove leading and trailing whitespaces
    $words = sqlEscape($_POST['words']);

    if (strlen($words) < 10) {
      $error = "Texten måste vara minst 10 tecken";
    }
    if (strlen($words) >= 10) {

$sql1 = sqlInsert('INSERT INTO row (user_id, words, story_id, date) VALUES (' . $_SESSION['user_id'] . ', "' . $words . '", ' . $story . ', now());');

$sql_last_id = sqlSelect('SELECT MAX(row_id) AS last_id FROM `row` WHERE story_id = ' . $story . ';');

$sql2 = sqlInsert('UPDATE `story_writers` SET `on_turn` = 1 WHERE `id` IN (SELECT MIN(id) FROM (SELECT * FROM `story_writers`) AS id WHERE story_id = ' . $story . ' AND on_turn = 0 ORDER BY latest_row);');


$sql3 = sqlInsert('UPDATE `story_writers` SET `latest_row` = ' . $sql_last_id[0]['last_id'] . ', `on_turn` = 0 WHERE story_id = ' . $story . ' AND user_id = ' . $_SESSION['user_id'] . ';');

        //$sql = sqlInsert("INSERT INTO `row` (row_id, user_id, words, story_id, date) VALUES (NULL, " . $_SESSION['user_id'] . ", '$words', {$story}, now());");

      if ($error == 0) {
          $correct = "<script src='js/noty_row_inserted.js'></script>";
      } 

      if ($error == 1) {
        $not_sent = "Något gick fel. Försök igen.";
          //echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
}

?>

<!-- CHARACTER COUNTER -->
<script src="js/char-left.js"></script>
<!-- SPOILER FUNCTION -->
<script src="js/spoiler.js"></script>

<div id="continue-story">
    
  <form action="" method="post" id="trueStory">
          <?php echo @$not_sent; ?>
          <div id="charCounter">
            <span id="charLeft">50</span> Tecken kvar
          </div>
          <br />
          <a href="settings" class="spoilerButton">
            <h2><span class="ion-information-circled"></span>Senaste<h2>
          </a>
          <br />
          <div id="settings" class="spoiler">
            <div id="info">
               <?php require 'functions/select_latest.php'; ?>
               <?php require 'functions/select_rows_left.php'; ?>
            </div> <!-- END #INFO -->
          </div>
          <textarea id="app" name="words" rows="10" cols="50" placeholder="Write something..."></textarea><br/>
          <div id="charError"><?php echo $error; ?></div><br />
          <input type="submit" name="send_row" value="Skicka">
          <div id="charCorrect"><?php echo $correct; ?></div><br />
      
      </form>

  </div> <!-- END #CONTINUE-STORY-MOBILE -->

  <div id="existing-stories">

    <h2>Pågående stories</h2>

    <?php require 'functions/current_stories.php'; ?>

  </div> <!-- END #EXISTING-STORIES -->

</div> <!-- END #WRAPPER -->

</body>
</html>